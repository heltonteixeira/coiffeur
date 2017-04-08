@extends('layouts.dashboard')

@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
              <ol class="breadcrumb breadcrumb-bg-red">
                  <li><a href="{{ route('dashboard') }}"><i class="material-icons">home</i> Home</a></li>
                  <li><a href="{{ route('reports.index') }}"><i class="material-icons">insert_chart</i> Reports</a></li>
                  <li class="active"><i class="material-icons">show_chart</i> {{ $service->name ?? 'All Jobs Report' }}</li>
              </ol>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            @if ($service->name)
                                Monthly Report for {{ $service->name }} at period of {{ $start->format('F / Y') }}
                            @else
                                Monthly Report for the period of {{ $start->format('F / Y') }}
                            @endif
                            
                            @if ($jobs->count())
                              <span class="pull-right m-r-20">
                                <small>
                                  Showing {{ $jobs->firstItem() }} - {{ $jobs->lastItem() }} (Total: {{ $jobs->total() }})
                                </small>
                              </span>
                            @endif

                            <small>Monthly report for all jobs done{{ $service->name ? ' for this service' : '' }} in the selected period.</small>
                        </h2>
                    </div>
                    <div class="body table-responsive">
                        @if ($jobs->count())
                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Client</th>
                                        <th>Service</th>
                                        <th>Accomplished At</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jobs as $job)
                                        <tr>
                                            <td>
                                                <a href="{{ route('jobs.show', $job) }}">{{ $job->id }}</a>
                                            </td>
                                            <td>{{ $job->clientName() }}</td>
                                            <td>{{ $job->serviceName() }}</td>
                                            <td>{{ $job->accomplishedAtDate() }}</td>
                                            <td>{{ $job->price() }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3"></th>
                                        <th>TOTAL</th>
                                        <th>{{ price($total) }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="text-center">{{ $jobs->links() }}</div>
                        @else
                            <p>There are not enough jobs in the period to generate a report.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection