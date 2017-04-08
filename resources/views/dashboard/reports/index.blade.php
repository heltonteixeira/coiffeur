@extends('layouts.dashboard')

@section('title', 'Reports')

@section('styles')

  <!-- Bootstrap Select Css -->
  <link href="{{ asset('plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet">

@endsection

@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
              <ol class="breadcrumb breadcrumb-bg-red">
                  <li><a href="{{ route('dashboard') }}"><i class="material-icons">home</i> Home</a></li>
                  <li class="active"><i class="material-icons">insert_chart</i> Reports</li>
              </ol>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            GENERATE A MONTH REPORT
                            <small>Select a month and year to generate a report, optionally you can select a service.</small>
                        </h2>
                    </div>
                    <div class="body">
                      @if ($years->count())
                        <div class="row clearfix">
                            <form action="{{ route('reports.generate') }}" method="POST" autocomplete="off">
                                {{ csrf_field() }}
                                <div class="column col-md-5">
                                    <div class="form-group">
                                      <div class="bootstrap-select form-control">
                                        <select class="form-control show-tick selectpicker" data-live-search="true" name="service_id">
                                            <option value="" selected>All Services</option>
                                            @foreach ($services as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                      </div>
                                      @if ($errors->has('service_id'))
                                        <label id="service_id-error" class="error" for="service_id">{{ $errors->first('service_id') }}</label>
                                      @endif
                                    </div>
                                </div>

                                <div class="column col-md-2">
                                    <div class="form-group">
                                      <div class="bootstrap-select form-control">
                                        <select class="form-control show-tick selectpicker" data-live-search="true" name="year">
                                            @foreach ($years as $year)
                                                <option value="{{ $year }}">{{ $year }}</option>
                                            @endforeach
                                        </select>
                                      </div>
                                      @if ($errors->has('year'))
                                        <label id="year-error" class="error" for="year">{{ $errors->first('year') }}</label>
                                      @endif
                                    </div>
                                </div>

                                <div class="column col-md-3">
                                    <div class="form-group">
                                      <div class="bootstrap-select form-control">
                                        <select class="form-control show-tick selectpicker" data-live-search="true" name="month">
                                            <option value="01">Janeiro</option>
                                            <option value="02">Fevereiro</option>
                                            <option value="03">Março</option>
                                            <option value="04">Abril</option>
                                            <option value="05">Maio</option>
                                            <option value="06">Junho</option>
                                            <option value="07">Julho</option>
                                            <option value="08">Agosto</option>
                                            <option value="09">Setembro</option>
                                            <option value="10">Outrubro</option>
                                            <option value="11">Novembro</option>
                                            <option value="12">Dezembro</option>
                                        </select>
                                      </div>
                                      @if ($errors->has('month'))
                                        <label id="month-error" class="error" for="month">{{ $errors->first('month') }}</label>
                                      @endif
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">VIEW REPORT</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                      @else
                        <p>There are not enough jobs to generate a report.</p>
                      @endif
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

@endsection