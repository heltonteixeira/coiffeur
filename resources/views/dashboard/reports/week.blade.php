@extends('layouts.dashboard')

@section('title', 'Last Week Report')

@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
              <ol class="breadcrumb breadcrumb-bg-red">
                  <li><a href="{{ route('dashboard') }}"><i class="material-icons">home</i> Home</a></li>
                  <li><a href="{{ route('reports.index') }}"><i class="material-icons">insert_chart</i> Reports</a></li>
                  <li class="active"><i class="material-icons">show_chart</i> Weekly Report</li>
              </ol>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Weekly Report
                            <small>Report for last week and this week.</small>
                        </h2>
                    </div>
                    <div class="body table-responsive">
                      @if ($services->count())
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Total Earned Last Week</th>
                                    <th>Total Earned This Week</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach ($services as $service)
                                <tr>
                                  <td>{{ $service->id }}</td>
                                  <td>
                                    <a href="{{ route('services.show', $service) }}">{{ $service->name }}</a>
                                  </td>
                                  <td>{{ price($service->totalEarnedLastWeek()) }}</td>
                                  <td>{{ price($service->totalEarnedThisWeek()) }}</td>
                                </tr>
                              @endforeach
                              <tr>
                                <td>-</td>
                                <td>Total</td>
                                <td>{{ price($totalLastWeek) }}</td>
                                <td>{{ price($totalThisWeek) }}</td>
                              </tr>
                            </tbody>
                        </table>
                        <div class="text-center">{{ $services->links() }}</div>
                      @else
                        <p>There is no jobs done in the last two weeks.</p>
                      @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
