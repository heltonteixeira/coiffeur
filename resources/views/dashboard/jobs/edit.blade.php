@extends('layouts.dashboard')

@section('title', "Editing Job done at {$job->formattedAccomplishedAt()}")

@section('styles')

  <!-- Bootstrap Select Css -->
  <link href="{{ asset('plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet">

  <!-- Flatpickr Css -->
  <link href="{{ asset('plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet">
  <link href="{{ asset('plugins/flatpickr/themes/material_red.css') }}" rel="stylesheet">

@endsection

@section('content')

<section class="content">
  <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
          <ol class="breadcrumb breadcrumb-bg-red">
              <li><a href="{{ route('dashboard') }}"><i class="material-icons">home</i> Home</a></li>
              <li><a href="{{ route('jobs.index') }}"><i class="material-icons">business_center</i> Jobs</a></li>
              <li class="active"><i class="material-icons">mode_edit</i> Editing Job</li>
          </ol>
        </div>

        <div class="col-md-12">

          <div class="card">
            <div class="header">
                <h2>
                  EDITING JOB
                    <small>Job done at {{ $job->accomplishedAtDate() }} for {{ $job->clientName() }}</small>
                </h2>
                <ul class="header-dropdown m-r--5">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">more_vert</i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="#" id="reset_form_link" class="waves-effect waves-block">Clear Form</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="body">
              <form action="{{ route('jobs.update', $job) }}" method="POST" autocomplete="off" id="job_form">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                
                <div class="row clearfix">
                  <div class="col-md-6 m-b-0">
                    <div class="form-group">
                      <div class="bootstrap-select form-control">
                        <select class="form-control show-tick selectpicker" data-live-search="true" name="client_id" required>
                          <option selected disabled>Select a Client...</option>
                          @foreach ($clients as $client)
                            <option value="{{ $client->id }}"{{ old('client_id', $job->client->id ?? '') == $client->id ? ' selected' : '' }}>{{ $client->name }}</option>
                          @endforeach
                        </select>
                      </div>
                      @if ($errors->has('client_id'))
                        <label id="client-error" class="error" for="client_id">{{ $errors->first('client_id') }}</label>
                      @endif
                    </div>
                  </div>

                  <div class="col-md-6 m-b-0">
                    <div class="form-group">
                      <div class="bootstrap-select form-control">
                        <select class="form-control show-tick selectpicker" data-live-search="true" name="service_id" required>
                          <option selected disabled>Select a Service...</option>
                          @foreach ($services as $service)
                            <option value="{{ $service->id }}"
                              {{ old('service_id', $job->service->id ?? '') == $service->id ? ' selected' : '' }}
                              data-price="{{ $service->base_cost }}">{{ $service->name }}</option>
                          @endforeach
                        </select>
                      </div>
                      @if ($errors->has('service_id'))
                        <label id="service-error" class="error" for="service_id">{{ $errors->first('service_id') }}</label>
                      @endif
                    </div>
                  </div>
                </div>

                <div class="row clearfix">
                  <div class="col-md-6 m-b-0">
                    <div class="form-group">
                      <div class="bootstrap-select form-control">
                        <select class="form-control show-tick selectpicker" data-live-search="true" name="payment_method" required>
                          <option selected disabled>Select a Payment Method...</option>
                          <option value="0"{{ old('payment_method', $job->payment_method ?? '') == '0' ? ' selected' : '' }}>A Vista (Dinheiro)</option>
                          <option value="1"{{ old('payment_method', $job->payment_method ?? '') == '1' ? ' selected' : '' }}>A Vista (Débito)</option>
                          <option value="2"{{ old('payment_method', $job->payment_method ?? '') == '2' ? ' selected' : '' }}>A Vista (Crédito)</option>
                          <option value="3"{{ old('payment_method', $job->payment_method ?? '') == '3' ? ' selected' : '' }}>2x (Crédito)</option>
                          <option value="4"{{ old('payment_method', $job->payment_method ?? '') == '4' ? ' selected' : '' }}>3x (Crédito)</option>
                        </select>
                      </div>
                      @if ($errors->has('payment_method'))
                        <label id="service-error" class="error" for="payment_method">{{ $errors->first('payment_method') }}</label>
                      @endif
                    </div>
                  </div>

                  <div class="col-md-3 m-b-0">
                    <div class="input-group">
                      <span class="input-group-addon">
                          <i class="material-icons">attach_money</i>
                      </span>
                      <div class="form-line{{ $errors->has('total_cost') ? ' focused error' : '' }}">
                        <input type="text" id="total_cost" name="total_cost" class="form-control" placeholder="Total Cost" value="{{ old('total_cost', $job->total_cost ?? '') }}" required>
                      </div>
                      @if ($errors->has('total_cost'))
                        <label id="total_cost-error" class="error" for="total_cost">{{ $errors->first('total_cost') }}</label>
                      @endif
                    </div>
                  </div>

                  <div class="col-md-3 m-b-0">
                    <div class="form-group">
                      <div class="form-line{{ $errors->has('accomplished_at') ? ' focused error' : '' }}">
                        <input type="text" id="accomplished_at" name="accomplished_at" class="form-control flatpickr" placeholder="Accomplished at date and time" 
                        data-default-date="{{ old('accomplished_at', $job->accomplished_at ?? '') }}" 
                        required>
                      </div>
                      @if ($errors->has('accomplished_at'))
                        <label id="accomplished-at-error" class="error" for="accomplished_at">{{ $errors->first('accomplished_at') }}</label>
                      @endif
                    </div>
                  </div>
                </div>
                
                <div class="row clearfix">
                  <div class="col-md-12 m-b-0">
                    <div class="form-group">
                      <div class="form-line{{ $errors->has('observation') ? ' error' : '' }}">
                        <textarea name="observation" id="observation" class="form-control" placeholder="Observation" rows="4">{{ old('observation', $job->observation ?? '') }}</textarea>
                      </div>
                      @if ($errors->has('observation'))
                        <label id="observation-error" class="error" for="observation">{{ $errors->first('observation') }}</label>
                      @endif
                    </div>
                  </div>
                </div>
                
                <div class="row clearfix">
                  <div class="col-md-12 m-b-0">
                    <div class="form-group">
                      <button type="submit" name="submit" class="btn btn-primary m-t-15 waves-effect">UPDATE</button>
                    </div>
                  </div>
                </div>


              </form>
            </div>
          </div>
        </div>
    </div>
  </div>
</section>
@endsection

@section('scripts')

  <!-- Select Plugin Js -->
  <script src="{{ asset('plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>

  <!-- DateTime Picker Plugin Js -->
  <script src="{{ asset('plugins/flatpickr/flatpickr.min.js') }}"></script>
  
  <!-- Jquery Validation Plugin Css -->
  <script src="{{ asset('plugins/jquery-validation/jquery.validate.js') }}"></script>

  <!-- Custom Create Form Js -->
  <script src="{{ asset('js/jobs-form.js') }}"></script>

@endsection