@extends('layouts.dashboard')

@section('title', "Client: $client->name")

@section('content')

<section class="content">
  <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
          <ol class="breadcrumb breadcrumb-bg-red">
              <li><a href="{{ route('dashboard') }}"><i class="material-icons">home</i> Home</a></li>
              <li><a href="{{ route('clients.index') }}"><i class="material-icons">group</i> Clients</a></li>
              <li class="active"><i class="material-icons">face</i> {{ $client->name }}</li>
          </ol>
        </div>

        <div class="col-md-12">

          <div class="card">
            <div class="header">
                <h2>
                    {{ $client->name }}

                    @if ($client->nickname)
                      <span class="col-grey">({{ $client->nickname }})</span>
                    @endif
                    
                    <small>{{ $client->lastService() }}</small>
                </h2>
                <ul class="header-dropdown m-r--5">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">more_vert</i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li>
                              <a href="{{ route('clients.edit', $client) }}" class="waves-effect waves-block">Edit</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                              <a href="{{ route('clients.destroy', $client) }}"
                                  onclick="event.preventDefault();
                                           document.getElementById('client-destroy').submit();">
                                  Delete
                              </a>
                              <form id="client-destroy" action="{{ route('clients.destroy', $client) }}" method="POST" style="display: none;">
                                  {{ csrf_field() }}
                                  {{ method_field('DELETE') }}
                              </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="body">
              <ul class="list-unstyled">
                @foreach ($client->formdata() as $attr => $data)
                  <li><strong>{{ title_case(str_replace('_', ' ', $attr)) }}:</strong> {!! $data !!}</li>
                @endforeach
              </ul>
            </div>
          </div>

          @if ($jobs->count())
            <div class="card">
              <div class="header">
                <h2>
                  Realized Jobs
                  <span class="pull-right"><small>Showing {{ $jobs->firstItem() }} - {{ $jobs->lastItem() }} (Total: {{ $jobs->total() }})</small></span>
                </h2>
              </div>
              <div class="body table-responsive">
                  <table class="table table-bordered table-condensed">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Service</th>
                        <th>Accomplisehd At</th>
                        <th>Value</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($jobs as $job)
                        <tr>
                          <td><a href="{{ route('jobs.show', $job) }}">{{ $job->id }}</a></td>
                          <td>{{ $job->serviceName() }}</td>
                          <td>{{ $job->accomplishedAtDate() }}</td>
                          <td>{{ $job->price() }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                  <div class="text-center">{{ $jobs->links() }}</div>
              </div>
            </div>
          @endif

          <div class="card">
            <div class="body">
              <div class="row">

                <div class="col-lg-4 col-md-4 m-b-0">
                  <a href="tel:{{ $client->cellphone }}" target="_blank" class="btn btn-lg btn-block bg-grey waves-effect">
                    <i class="fa fa-mobile"></i> Call to {{ $client->cellphone() }}
                  </a>
                </div>

                @if ($client->phone)
                  <div class="col-lg-4 col-md-4 m-b-0">
                    <a href="tel:{{ $client->phone }}" target="_blank" class="btn btn-lg btn-block bg-blue-grey waves-effect">
                      <i class="fa fa-phone"></i> Call to {{ $client->phone() }}
                    </a>
                  </div>
                @endif

                @if ($client->facebook)
                  <div class="col-lg-4 col-md-4 m-b-0">
                    <a href="{{ $client->messengerLink() }}" target="_blank" class="btn btn-lg btn-block bg-blue waves-effect">
                      <i class="fa fa-facebook-official"></i> Send a Messenger message
                    </a>
                  </div>
                @endif

                @if ($client->whatsapp)
                  <div class="hidden-lg col-lg-4 col-md-4 m-b-0">
                    <a href="{{ $client->whatsappLink() }}" target="_blank" class="btn btn-lg btn-block bg-green waves-effect">
                      <i class="fa fa-whatsapp"></i> Send a Whatsapp message
                    </a>
                  </div>
                @endif

                @if ($client->instagram)
                  <div class="col-lg-4 col-md-4 m-b-0">
                    <a href="{{ $client->instagramLink() }}" target="_blank" class="btn btn-lg btn-block bg-deep-orange waves-effect">
                      <i class="fa fa-instagram"></i> View Instagram profile
                    </a>
                  </div>
                @endif

              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
</section>

@endsection

