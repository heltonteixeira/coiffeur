<?php

namespace App\Http\Controllers;

use App\Job;
use App\Client;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class JobsController extends Controller
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
        $jobs = Job::latest('accomplished_at')->paginate(10);

        return view('dashboard.jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Client::count() || !Service::count()) {
            Session::flash('info', 'You need to register clients and services first.');

            return redirect()->route('dashboard');
        }

        $clients =  Client::orderBy('name')->pluck('id', 'name');
        $services = Service::orderBy('name')->pluck('id', 'name');

        return view('dashboard.jobs.create', compact('clients', 'services'));
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
            'client_id' => 'required|exists:clients,id',
            'service_id' => 'required|exists:services,id',
            'payment_method' => 'required',
            'total_cost' => 'required|numeric',
            'accomplished_at' => 'required|date',
        ]);

        Job::create([
            'client_id' => $request->client_id,
            'service_id' => $request->service_id,
            'payment_method' => $request->payment_method,
            'total_cost' => $request->total_cost,
            'accomplished_at' => $request->accomplished_at,
            'observation' => $request->observation,
        ]);

        Session::flash('success', 'Job successfully included.');

        return redirect()->route('jobs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        $job->load('client');

        return view('dashboard.jobs.show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        $clients = Client::all();
        $services = Service::all();

        return view('dashboard.jobs.edit', compact('job', 'clients', 'services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {
        $this->validate($request, [
            'client_id' => 'required|exists:clients,id',
            'service_id' => 'required|exists:services,id',
            'payment_method' => 'required',
            'total_cost' => 'required|numeric',
            'accomplished_at' => 'required|date',
        ]);

        $job->update([
            'client_id' => $request->client_id,
            'service_id' => $request->service_id,
            'payment_method' => $request->payment_method,
            'total_cost' => $request->total_cost,
            'accomplished_at' => $request->accomplished_at,
            'observation' => $request->observation,
        ]);

        Session::flash('success', "Job #{$job->id} updated.");

        return redirect()->route('jobs.show', $job);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        $job->delete();

        Session::flash('success', 'Job deleted.');

        return redirect()->route('jobs.index');
    }
}
