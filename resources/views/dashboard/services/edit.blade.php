@extends('layouts.dashboard')

@section('title', "Editing Service: $service->name")

@section('content')

<section class="content">
  <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
          <ol class="breadcrumb breadcrumb-bg-red">
              <li><a href="{{ route('dashboard') }}"><i class="material-icons">home</i> Home</a></li>
              <li><a href="{{ route('services.index') }}"><i class="material-icons">local_offer</i> Services</a></li>
              <li class="active"><i class="material-icons">mode_edit</i> Editing Service</li>
          </ol>
        </div>

        <div class="col-md-12">

          <div class="card">
            <div class="header">
                <h2>
                  EDITING SERVICE: {{ $service->name }}
                    <small><em>Service name and base cost</em> are required.</small>
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
              <div class="row clearfix">
                  <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">
                    <form action="{{ route('services.update', $service) }}" method="POST" autocomplete="off" id="service_form">
                      {{ csrf_field() }}
                      {{ method_field('PATCH') }}

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <div class="form-line{{ $errors->has('name') ? ' error' : '' }}">
                              <input type="text" id="name" name="name" class="form-control" placeholder="Service Name" value="{{ old('name', $service->name ?? '') }}" required>
                            </div>
                            @if ($errors->has('name'))
                              <label id="name-error" class="error" for="name">{{ $errors->first('name') }}</label>
                            @endif
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">attach_money</i>
                            </span>
                            <div class="form-line{{ $errors->has('base_cost') ? ' error' : '' }}">
                              <input type="text" id="base_cost" name="base_cost" class="form-control" placeholder="Service Base Cost" value="{{ old('base_cost', $service->base_cost ?? '') }}" required>
                            </div>
                            @if ($errors->has('base_cost'))
                              <label id="base-cost-error" class="error" for="base_cost">{{ $errors->first('base_cost') }}</label>
                            @endif
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div class="form-group">
                            <div class="form-line{{ $errors->has('description') ? ' error' : '' }}">
                              <textarea name="description" id="description" class="form-control" placeholder="Service Description" rows="4">{{ old('description', $service->description ?? '') }}</textarea>
                            </div>
                            @if ($errors->has('description'))
                              <label id="description-error" class="error" for="description">{{ $errors->first('description') }}</label>
                            @endif
                          </div>
                        </div>

                        <div class="col-md-12">
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
    </div>
  </div>
</section>
@endsection

@section('scripts')
  
  <!-- Jquery Validation Plugin Css -->
  <script src="{{ asset('plugins/jquery-validation/jquery.validate.js') }}"></script>

  <!-- Custom Create Form Js -->
  <script src="{{ asset('js/services-form.js') }}"></script>

@endsection