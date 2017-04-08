@extends('layouts.dashboard')

@section('title', "Job #$job->id")

@section('content')

<section class="content">
  <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
          <ol class="breadcrumb breadcrumb-bg-red">
              <li><a href="{{ route('dashboard') }}"><i class="material-icons">home</i> Home</a></li>
              <li><a href="{{ route('jobs.index') }}"><i class="material-icons">business_center</i> Jobs</a></li>
              <li class="active"><i class="material-icons">assignment</i> Job #{{ $job->id }}</li>
          </ol>
        </div>

        <div class="col-md-12">

          <div class="card">
            <div class="header">
                <h2>
                    #{{ $job->id }} - {{ $job->serviceName() }}

                    <small>Job Accomplished at {{ $job->accomplished_at->diffForHumans() }}</small>
                </h2>
                <ul class="header-dropdown m-r--5">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">more_vert</i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li>
                              <a href="{{ route('jobs.edit', $job) }}" class="waves-effect waves-block">Edit</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                              <a href="{{ route('jobs.destroy', $job) }}"
                                  onclick="event.preventDefault();
                                           document.getElementById('job-destroy').submit();">
                                  Delete
                              </a>
                              <form id="job-destroy" action="{{ route('jobs.destroy', $job) }}" method="POST" style="display: none;">
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
                <li>
                  <strong>Client:</strong> <a href="{{ route('clients.show', $job->client) }}">{{ $job->clientName() }}</a>
                </li>
                <li>
                  <strong>Service:</strong> <a href="{{ route('services.show', $job->service) }}">{{ $job->serviceName() }}</a>
                </li>
                <li>
                  <strong>Accomplished At:</strong> {{ $job->formattedAccomplishedAt() }}
                </li>
                <li>
                  <strong>Price:</strong> {{ $job->price() }} / {{ $job->paymentMethod() }}
                </li>
                @if ($job->observation)
                  <li>
                    <p><strong>Observation:</strong> {{ $job->observation }}</p>
                  </li>
                @endif
              </ul>
            </div>
          </div>

        </div>
    </div>
  </div>
</section>

@endsection

