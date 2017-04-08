@extends('layouts.dashboard')

@section('title', 'Manage Clients')

@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
              <ol class="breadcrumb breadcrumb-bg-red">
                  <li><a href="{{ route('dashboard') }}"><i class="material-icons">home</i> Home</a></li>
                  <li class="active"><i class="material-icons">group</i> Clients</li>
              </ol>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            MANAGE REGISTERED CLIENTS
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="{{ route('clients.create') }}">New Client</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    @if ($clients->count() > 0)
                        <div class="body table-responsive">
                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Cellphone</th>
                                        <th>Total Jobs</th>
                                        <th>Last Job</th>
                                        {{-- <th>Actions</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clients as $client)
                                        <tr>
                                            <td>
                                                <a href="{{ route('clients.show', $client) }}">{{ $client->name }}</a>
                                            </td>
                                            <td>{{ $client->cellphone() }}</td>
                                            <td>{{ $client->jobs->count() }}</td>
                                            <td>
                                                {{ $client->lastServiceName() }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="text-center">{{ $clients->links() }}</div>
                        </div>
                    @else
                        <div class="panel-body">
                            <p class="text-muted">There are no clients registered.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@endsection