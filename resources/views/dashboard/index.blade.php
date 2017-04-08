@extends('layouts.dashboard')

@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>DASHBOARD</h2>
        </div>

        <!-- Widgets -->
        <div class="row clearfix">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-pink hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">people</i>
                    </div>
                    <div class="content">
                        <div class="text">CLIENTS LAST MONTH</div>
                        <div class="number count-to" data-from="0" data-to="{{ $monthClientsCount }}" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-cyan hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">group_add</i>
                    </div>
                    <div class="content">
                        <div class="text">CLIENTS LAST WEEK</div>
                        <div class="number count-to" data-from="0" data-to="{{ $weekClientsCount }}" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-light-green hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">work</i>
                    </div>
                    <div class="content">
                        <div class="text">JOBS LAST MONTH</div>
                        <div class="number count-to" data-from="0" data-to="{{ $monthJobsCount }}" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-orange hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">date_range</i>
                    </div>
                    <div class="content">
                        <div class="text">JOBS LAST WEEK</div>
                        <div class="number count-to" data-from="0" data-to="{{ $weekJobsCount }}" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Widgets -->

        <div class="row clearfix">
            <!-- Latest Clients -->
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="header">
                        <h2>LATEST CLIENTS</h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="{{ route('clients.index') }}">Manage Clients</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        @if ($latestClients->count())
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Cellphone</th>
                                            <th># Services</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($latestClients as $client)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('clients.show', $client) }}">{{ $client->name }}</a>
                                                </td>
                                                <td>{{ $client->cellphone() }}</td>
                                                <td>{{ $client->jobs->count() }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p>No new clients in the last week.</p>
                        @endif
                    </div>
                </div>
            </div>
            <!-- #END# Latest Clients -->
            <!-- Latest Jobs -->
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="header">
                        <h2>LATEST JOBS</h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="{{ route('jobs.index') }}">Manage Jobs</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        @if ($latestJobs->count())
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Service</th>
                                            <th>Client</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($latestJobs as $job)
                                        <tr>
                                            <td>
                                                <a href="{{ route('jobs.show', $job) }}">
                                                    {{ $job->formattedAccomplishedAt() }}
                                                </a>
                                            </td>
                                            <td>{{ $job->serviceName() }}</td>
                                            <td>{{ $job->clientName() }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p>No new jobs registered in the last week.</p>
                        @endif
                    </div>
                </div>
            </div>
            <!-- #END# Latest Jobs -->
        </div>
    </div>
</section>

@endsection
