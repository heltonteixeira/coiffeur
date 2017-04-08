<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;

class ClientsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::latest()->with(['jobs' => function ($query) {
            $query->latest('accomplished_at');
        }])->paginate(12);

        return view('dashboard.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'cellphone' => 'required',
            'gender' => 'in:female,male,other',
            'birthday' => 'nullable|date',
        ]);

        Client::create([
            'name' => $request->name,
            'cellphone' => $request->cellphone,
            'phone' => $request->phone,
            'whatsapp' => request()->has('whatsapp'),
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'email' => $request->email,
            'nickname' => $request->nickname,
            'gender' => $request->gender,
            'birthday' => $request->birthday,
            'address' => $request->address,
            'neighborhood' => $request->neighborhood,
            'city' => $request->city,
            'state' => $request->state,
        ]);

        Session::flash('success', 'Client Included.');

        return redirect()->route('clients.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        $jobs = $client->jobs()->latest('accomplished_at')->paginate(10);
        // $client->load(['jobs' => function ($query) {
        //     $query->latest('accomplished_at');
        // }]);

        return view('dashboard.clients.show', compact('client', 'jobs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('dashboard.clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $this->validate($request, [
            'name' => 'required',
            'cellphone' => 'required',
            'gender' => 'in:female,male,other',
            'birthday' => 'nullable|date',
        ]);

        $client->update([
            'name' => $request->name,
            'cellphone' => $request->cellphone,
            'phone' => $request->phone,
            'whatsapp' => request()->has('whatsapp'),
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'email' => $request->email,
            'nickname' => $request->nickname,
            'gender' => $request->gender,
            'birthday' => $request->birthday,
            'address' => $request->address,
            'neighborhood' => $request->neighborhood,
            'city' => $request->city,
            'state' => $request->state,
        ]);

        Session::flash('success', "Client: {$client->name}, Succesfully Updated.");

        return redirect()->route('clients.show', $client);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();

        Session::flash('success', "Client: {$client->name} Deleted.");

        return redirect()->route('clients.index');
    }
}
