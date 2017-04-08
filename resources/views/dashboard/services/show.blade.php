@extends('layouts.dashboard')

@section('title', "Service: $service->name")

@section('content')

<section class="content">
  <div class="container-fluid">
    <div class="row clearfix">
        <div class="col-md-12">
          <ol class="breadcrumb breadcrumb-bg-red">
              <li><a href="{{ route('dashboard') }}"><i class="material-icons">home</i> Home</a></li>
              <li><a href="{{ route('services.index') }}"><i class="material-icons">local_offer</i> Services</a></li>
              <li class="active"><i class="material-icons">label_outline</i> {{ $service->name }}</li>
          </ol>
        </div>

        <div class="col-md-12">

          <div class="card">
            <div class="header">
                <h2>
                    {{ $service->name }}
                    
                    @if ($jobs->count())
                      <span class="pull-right m-r-20">
                        <small>
                          Showing {{ $jobs->firstItem() }} - {{ $jobs->lastItem() }} (Total: {{ $jobs->total() }})
                        </small>
                      </span>
                    @endif
                    {{-- <small>Last Job for this Service {{ $service->jobaccomplished_at->diffForHumans() }}</small> --}}
                </h2>
                <ul class="header-dropdown m-r--5">
                  <li class="dropdown">
                      <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                          <i class="material-icons">more_vert</i>
                      </a>
                      <ul class="dropdown-menu pull-right">
                          <li>
                            <a href="{{ route('services.edit', $service) }}" class="waves-effect waves-block">Edit</a>
                          </li>
                          <li class="divider"></li>
                          <li>
                            <a href="{{ route('services.destroy', $service) }}"
                                onclick="event.preventDefault();
                                         document.getElementById('service-destroy').submit();">
                                Delete
                            </a>
                            <form id="service-destroy" action="{{ route('services.destroy', $service) }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            </form>
                          </li>
                      </ul>
                  </li>
                </ul>
            </div>
            <div class="body table-responsive">
              @if ($jobs->count())
                <table class="table table-bordered table-condensed">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Client</th>
                      <th>Accomplished At</th>
                      <th>Value</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($jobs as $job)
                      <tr>
                        <td>
                          <a href="{{ route('jobs.show', $job) }}">{{ $job->id }}</a>
                        </td>
                        <td>{{ $job->clientName() }}</td>
                        <td>{{ $job->accomplishedAtDate() }}</td>
                        <td>{{ $job->price() }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="text-center">{{ $jobs->links() }}</div>
              @else
                <p class="text-muted">There are no jobs performed for this service.</p>
              @endif
            </div>
          </div>

        </div>
    </div>
    @if ($jobs->count())
      <div class="row clearfix">
        <div class="col-md-3">
          <div class="info-box-3 bg-blue-grey hover-zoom-effect">
            <div class="icon">
              <i class="material-icons">today</i>
            </div>
            <div class="content">
              <div class="text">EARNED THIS WEEK</div>
              <div class="number">{{ price($service->totalEarnedThisWeek()) }}</div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="info-box-3 bg-cyan hover-zoom-effect">
            <div class="icon">
              <i class="material-icons">date_range</i>
            </div>
            <div class="content">
              <div class="text">EARNED LAST WEEK</div>
              <div class="number">{{ price($service->totalEarnedLastWeek()) }}</div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="info-box-3 bg-light-blue hover-zoom-effect">
            <div class="icon">
              <i class="material-icons">update</i>
            </div>
            <div class="content">
              <div class="text">EARNED LAST MONTH</div>
              <div class="number">{{ price($service->totalEarnedLastMonth()) }}</div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="info-box-3 bg-indigo hover-zoom-effect">
            <div class="icon">
              <i class="material-icons">attach_money</i>
            </div>
            <div class="content">
              <div class="text">TOTAL EARNED</div>
              <div class="number">{{ price($service->totalEarned()) }}</div>
            </div>
          </div>
        </div>
      </div>
    @endif
  </div>
</section>

@endsection

