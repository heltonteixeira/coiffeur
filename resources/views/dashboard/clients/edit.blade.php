@extends('layouts.dashboard')

@section('title', "Editing Client: $client->name")

@section('styles')
  
    <!-- Wait Me Css -->
    <link href="{{ asset('plugins/waitme/waitMe.css') }}" rel="stylesheet">

    <!-- Bootstrap Select Css -->
    <link href="{{ asset('plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet">

  <!-- Multi Select Css -->
  <link href="{{ asset('plugins/multi-select/css/multi-select.css') }}" rel="stylesheet">

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
                <li><a href="{{ route('clients.index') }}"><i class="material-icons">group</i> Clients</a></li>
                <li class="active"><i class="material-icons">mode_edit</i> Editing</li>
            </ol>
          </div>

          <div class="col-md-12">
            <div class="card">
              <div class="header">
                  <h2>
                      EDITING: {{ $client->name }}
                      <small>The <em>basic info section</em> is required.</small>
                  </h2>
                  <ul class="header-dropdown m-r--5">
                      <li class="dropdown">
                          <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                              <i class="material-icons">more_vert</i>
                          </a>
                          <ul class="dropdown-menu pull-right">
                              <li><a href="javascript:void(0);" id="reset_form_link" class="waves-effect waves-block">Clear Form</a></li>
                          </ul>
                      </li>
                  </ul>
              </div>
              <div class="body">
                <div class="row clearfix">
                    <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">
                      <form action="{{ route('clients.update', $client) }}" method="POST" autocomplete="off" id="client_form">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs tab-nav-right{{ $errors->count() ? ' tab-col-pink' : '' }}" role="tablist">
                          <li role="presentation" class="active">
                            <a href="#basic_info" data-toggle="tab" aria-expanded="true">BASIC INFO</a>
                          </li>
                          <li role="presentation" class="">
                            <a href="#contact_info" data-toggle="tab" aria-expanded="false">CONTACT INFO</a>
                          </li>
                          <li role="presentation" class="">
                            <a href="#complementar_info" data-toggle="tab" aria-expanded="false">COMPLEMENTAR INFO</a>
                          </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                          <div role="tabpanel" class="tab-pane fade active in" id="basic_info">
                            <div class="row clearfix">

                              <div class="col-md-12 m-b-0">
                                <div class="form-group">
                                  <div class="form-line{{ $errors->has('name') ? ' focused error' : '' }}">
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Name" value="{{ old('name', $client->name ?? '') }}" required>
                                  </div>
                                  @if ($errors->has('name'))
                                  <label id="name-error" class="error" for="name">{{ $errors->first('name') }}</label>
                                  @endif
                                </div>
                              </div>

                              <div class="col-md-10 m-b-0">
                                <div class="form-group">
                                  <div class="form-line{{ $errors->has('cellphone') ? ' focused error' : '' }}">
                                    <input type="tel" id="cellphone" name="cellphone" class="form-control cellphone" placeholder="Cellphone"  value="{{ old('cellphone', $client->cellphone ?? '') }}" required>
                                  </div>
                                  @if ($errors->has('cellphone'))
                                  <label id="cellphone-error" class="error" for="cellphone">{{ $errors->first('cellphone') }}</label>
                                  @endif
                                </div>
                              </div>

                              <div class="col-md-2 m-b-0">
                                <div class="form-group">
                                  <input type="checkbox" id="whatsapp" name="whatsapp" class="filled-in"{{ old('whatsapp', $client->whatsapp ?? '') ? ' checked' : '' }}>
                                  <label for="whatsapp">Whatsapp</label>
                                  @if ($errors->has('whatsapp'))
                                  <label id="whatsapp-error" class="error" for="whatsapp">{{ $errors->first('whatsapp') }}</label>
                                  @endif
                                </div>
                              </div>

                            </div>
                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="contact_info">
                            <div class="row clearfix">

                              <div class="col-md-6 m-b-0">
                                <div class="form-group">
                                  <div class="form-line{{ $errors->has('phone') ? ' focused error' : '' }}">
                                    <input type="text" id="phone" name="phone" class="form-control phone" placeholder="Phone" value="{{ old('phone', $client->phone ?? '') }}">
                                  </div>
                                  @if ($errors->has('phone'))
                                  <label id="phone-error" class="error" for="phone">{{ $errors->first('phone') }}</label>
                                  @endif
                                </div>
                              </div>

                              <div class="col-md-6 m-b-0">
                                <div class="form-group">
                                  <div class="form-line{{ $errors->has('email') ? ' focused error' : '' }}">
                                    <input type="text" id="email" name="email" class="form-control email" placeholder="Email Address" value="{{ old('email', $client->email ?? '') }}">
                                  </div>
                                  @if ($errors->has('email'))
                                  <label id="email-error" class="error" for="email">{{ $errors->first('email') }}</label>
                                  @endif
                                </div>
                              </div>

                              <div class="col-md-6 m-b-0">
                                <div class="form-group">
                                  <div class="form-line{{ $errors->has('facebook') ? ' focused error' : '' }}">
                                    <input type="text" id="facebook" name="facebook" class="form-control" placeholder="Facebook account name" value="{{ old('facebook', $client->facebook ?? '') }}">
                                  </div>
                                  @if ($errors->has('facebook'))
                                  <label id="facebook-error" class="error" for="facebook">{{ $errors->first('facebook') }}</label>
                                  @endif
                                </div>
                              </div>

                              <div class="col-md-6 m-b-0">
                                <div class="form-group">
                                  <div class="form-line{{ $errors->has('instagram') ? ' focused error' : '' }}">
                                    <input type="text" id="instagram" name="instagram" class="form-control" placeholder="Instagram account name" value="{{ old('instagram', $client->instagram ?? '') }}">
                                  </div>
                                  @if ($errors->has('instagram'))
                                  <label id="instagram-error" class="error" for="instagram">{{ $errors->first('instagram') }}</label>
                                  @endif
                                </div>
                              </div>

                              <div class="col-md-12 m-b-0">
                                <div class="form-group">
                                  <div class="form-line{{ $errors->has('address') ? ' focused error' : '' }}">
                                    <input type="text" id="address" name="address" class="form-control" placeholder="Address" value="{{ old('address', $client->address ?? '') }}">
                                  </div>
                                  @if ($errors->has('address'))
                                  <label id="address-error" class="error" for="address">{{ $errors->first('address') }}</label>
                                  @endif
                                </div>
                              </div>

                              <div class="col-md-5 m-b-0">
                                <div class="form-group">
                                  <div class="form-line{{ $errors->has('neighborhood') ? ' focused error' : '' }}">
                                    <input type="text" id="neighborhood" name="neighborhood" class="form-control" placeholder="Neighborhood" value="{{ old('neighborhood', $client->neighborhood ?? '') }}">
                                  </div>
                                  @if ($errors->has('neighborhood'))
                                  <label id="neighborhood-error" class="error" for="neighborhood">{{ $errors->first('neighborhood') }}</label>
                                  @endif
                                </div>
                              </div>

                              <div class="col-md-5 m-b-0">
                                <div class="form-group">
                                  <div class="form-line{{ $errors->has('city') ? ' focused error' : '' }}">
                                    <input type="text" id="city" name="city" class="form-control" placeholder="City" value="{{ old('city', $client->city ?? '') }}">
                                  </div>
                                  @if ($errors->has('city'))
                                  <label id="city-error" class="error" for="city">{{ $errors->first('city') }}</label>
                                  @endif
                                </div>
                              </div>

                              <div class="col-md-2 m-b-0">
                                <div class="form-group">
                                  <div class="form-line{{ $errors->has('state') ? ' focused error' : '' }}">
                                    <input type="text" id="state" name="state" class="form-control" placeholder="State" value="{{ old('state', $client->state ?? '') }}">
                                  </div>
                                  @if ($errors->has('state'))
                                  <label id="state-error" class="error" for="state">{{ $errors->first('state') }}</label>
                                  @endif
                                </div>
                              </div>

                            </div>
                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="complementar_info">
                            <div class="row clearfix">

                              <div class="col-md-12 m-b-0">
                                <div class="form-group">
                                  <div class="form-line{{ $errors->has('nickname') ? ' focused error' : '' }}">
                                    <input type="text" id="nickname" name="nickname" class="form-control" placeholder="Nickname" value="{{ old('nickname', $client->nickname ?? '') }}">
                                  </div>
                                  @if ($errors->has('nickname'))
                                  <label id="nickname-error" class="error" for="nickname">{{ $errors->first('nickname') }}</label>
                                  @endif
                                </div>
                              </div>

                              <div class="col-md-6 m-b-0">
                                <div class="form-group">
                                  <div class="bootstrap-select form-control">
                                    <select class="form-control show-tick" name="gender">
                                      <option selected disabled>Select a Gender</option>
                                      <option value="female"{{ old('gender', $client->gender ?? '') == 'female' ? ' selected' : '' }}>Female</option>
                                      <option value="male"{{ old('gender', $client->gender ?? '') == 'male' ? ' selected' : '' }}>Male</option>
                                      <option value="other"{{ old('gender', $client->gender ?? '') == 'other' ? ' selected' : '' }}>Other</option>
                                    </select>
                                  </div>
                                  @if ($errors->has('gender'))
                                  <label id="gender-error" class="error" for="gender">{{ $errors->first('gender') }}</label>
                                  @endif
                                </div>
                              </div>

                              <div class="col-md-6 m-b-0">
                                <div class="form-group">
                                  <div class="form-line{{ $errors->has('birthday') ? ' focused error' : '' }}">
                                    <input type="text" id="birthday" name="birthday" class="form-control flatpickr" placeholder="Birthday" 
                                    data-default-date="{{ old('birthday', $client->birthday ?? '') }}"
                                    >
                                  </div>
                                  @if ($errors->has('birthday'))
                                  <label id="birthday-error" class="error" for="birthday">{{ $errors->first('birthday') }}</label>
                                  @endif
                                </div>
                              </div>

                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg">UPDATE</button>
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
  
  <!-- Select Plugin Js -->
  <script src="{{ asset('plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
  
  <!-- DateTime Picker Plugin Js -->
  <script src="{{ asset('plugins/flatpickr/flatpickr.min.js') }}"></script>

  <!-- Jquery Spinner Plugin Js -->
  <script src="{{ asset('plugins/jquery-spinner/js/jquery.spinner.js') }}"></script>

  <!-- Input Mask Plugin Js -->
  <script src="{{ asset('plugins/jquery-inputmask/jquery.inputmask.bundle.js') }}"></script>

  <!-- Jquery Validation Plugin Css -->
  <script src="{{ asset('plugins/jquery-validation/jquery.validate.js') }}"></script>

  <!-- Custom Create Form Js -->
  <script src="{{ asset('js/clients-form.js') }}"></script>

@endsection