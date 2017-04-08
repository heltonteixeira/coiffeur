@extends('layouts.dashboard')

@section('title', 'Manage Services')

@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
              <ol class="breadcrumb breadcrumb-bg-red">
                  <li><a href="{{ route('dashboard') }}"><i class="material-icons">home</i> Home</a></li>
                  <li class="active"><i class="material-icons">local_offer</i> Services</li>
              </ol>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            MANAGE REGISTERED SERVICES
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="{{ route('services.create') }}">New Service</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    @if ($services->count() > 0)
                        <div class="body">
                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Price Start At</th>
                                        <th>Jobs Last Month</th>
                                        <th>Total Earned Last Month</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($services as $service)
                                        <tr>
                                            <td>
                                                <a href="{{ route('services.show', $service) }}">{{ $service->name }}</a>
                                            </td>
                                            <td>{{ price($service->base_cost) }}</td>
                                            <td>{{ $service->totalJobsLastMonth() }}</td>
                                            <td>{{ price($service->totalEarnedLastMonth()) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="text-center">{{ $services->links() }}</div>

                        </div>
                    @else
                        <div class="panel-body">
                            <p class="text-muted">There are no services registered.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@endsection