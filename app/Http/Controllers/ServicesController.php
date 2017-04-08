<?php

namespace App\Http\Controllers;

use App\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ServicesController extends Controller
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
        $services = Service::orderBy('name', 'asc')
            ->withCount(['jobs' => function ($query) {
                $query->where('accomplished_at', '>', Carbon::parse('last day last month'));
            }])->paginate(12);

        return view('dashboard.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.services.create');
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
            'base_cost' => 'required|numeric',
        ]);

        Service::create([
            'name' => $request->name,
            'base_cost' => $request->base_cost,
            'description' => $request->description,
        ]);

        Session::flash('success', 'Service saved.');

        return redirect()->route('services.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        $jobs = $service->jobs()->latest('accomplished_at')->paginate(10);
        
        return view('dashboard.services.show', compact('service', 'jobs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        return view('dashboard.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $this->validate($request, [
            'name' => 'required',
            'base_cost' => 'required|numeric',
        ]);

        $service->update([
            'name' => $request->name,
            'base_cost' => $request->base_cost,
            'description' => $request->description,
        ]);

        Session::flash('success', "Service: {$service->name}, updated.");

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        if ($service->jobs->count() > 0) {
            Session::flash('info', 'Can not remove a service with registered jobs.');

            return redirect()->route('services.show', $service);
        }
        
        $service->delete();

        Session::flash('success', 'Service removed.');

        return redirect()->route('services.index');
    }
}
