@extends('layouts.dashboard')

@section('title', 'Manage Jobs')

@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
              <ol class="breadcrumb breadcrumb-bg-red">
                  <li><a href="{{ route('dashboard') }}"><i class="material-icons">home</i> Home</a></li>
                  <li class="active"><i class="material-icons">business_center</i> Jobs</li>
              </ol>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            MANAGE JOBS DONE
                            @if ($jobs->count())
                                <span class="pull-right m-r-20">
                                    <small>
                                        Showing {{ $jobs->firstItem() }} - {{ $jobs->lastItem() }} (Total: {{ $jobs->total() }})
                                    </small>
                                </span>
                            @endif
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="{{ route('jobs.create') }}">New Job</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body table-responsive">
                        @if ($jobs->count() > 0)
                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Client</th>
                                        <th>Service</th>
                                        <th>Accomplished At</th>
                                        <th>Price</th>
                                        {{-- <th>Actions</th> --}}
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
                            </table>
                            <div class="text-center">{{ $jobs->links() }}</div>
                        @else
                            <p class="text-muted">There are no jobs registered.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection