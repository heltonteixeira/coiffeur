<?php

namespace App\Http\Controllers;

use App\Job;
use App\Client;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $monthClientsCount = Client::hasJobsAccomplished('last month')->count();
        $monthJobsCount = Job::accomplished('last month')->count();

        $weekClientsCount = Client::hasJobsAccomplished('last week')->count();
        $weekJobsCount = Job::accomplished('last week')->count();
        
        $latestClients = Client::latest()->where('created_at', '>', Carbon::parse('last week'))->take(5)->with('jobs')->get();
        $latestJobs = Job::latest('accomplished_at')->where('accomplished_at', '>', Carbon::parse('last week'))->take(5)->get();
        
        return view('dashboard.index', compact('monthClientsCount', 'weekClientsCount', 'latestClients', 'monthJobsCount', 'weekJobsCount', 'latestJobs'));
    }
}
