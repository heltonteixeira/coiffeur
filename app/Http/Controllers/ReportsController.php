<?php

namespace App\Http\Controllers;

use App\Job;
use App\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // $months = Job::get()
        //     ->groupBy(function ($job) {
        //         return Carbon::parse($job->accomplished_at)->format('F');
        //     });

        $years = Job::get()
            ->groupBy(function ($job) {
                return Carbon::parse($job->accomplished_at)->format('Y');
            });

        $years = $years->keys()->unique();

        $services = Service::whereHas('jobs')->orderBy('name')->pluck('name', 'id');

        return view('dashboard.reports.index', compact('years', 'services'));
    }

    public function generate(Request $request)
    {
        $slug = Service::find($request->service_id);

        return redirect()
            ->route(
                'reports.show',
                ['month' => $request->month, 'year' => $request->year, 'service' => $slug]
            );
    }

    public function show($year, $month, Service $service)
    {
        $date = Carbon::parse($year . '-' . $month);
        $start = $date->startOfMonth();
        $end = $date->endOfMonth();

        $latestJobs = Job::latest();

        $jobs = Job::latest()->accomplishedBetween($date);
        $total = $jobs->get()->sum('total_cost');
        
        if ($service->slug) {
            $jobs = $latestJobs->where('service_id', $service->id)->accomplishedBetween($date);
            $total = $jobs->get()->sum('total_cost');
        }

        $jobs = $jobs->paginate(10);

        return view('dashboard.reports.show', compact('start', 'end', 'jobs', 'service', 'total'));
    }

    public function month()
    {
        $services = Service::whereHas('jobs')->with('jobs')->orderBy('name')->paginate(15);

        $totalLastMonth = Job::accomplishedBetween('last month')->sum('total_cost');
        $totalThisMonth = Job::accomplishedBetween('this month')->sum('total_cost');

        return view('dashboard.reports.month', compact('services', 'totalThisMonth', 'totalLastMonth'));
    }

    public function week()
    {
        $services = Service::whereHas('jobs')->with('jobs')->orderBy('name')->paginate(15);

        $totalLastWeek = Job::accomplished('last week')->sum('total_cost');
        $totalThisWeek = Job::accomplished('this week')->sum('total_cost');

        return view('dashboard.reports.week', compact('services', 'totalThisWeek', 'totalLastWeek'));
    }
}
