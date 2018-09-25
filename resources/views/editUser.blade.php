@extends('layouts.templateMap')

@section('titrePage') Mapper/ Modifier client @endsection

@section('content')
<br>
<div class="container">
  <div class="panel panel-warning">
      <div class="panel-heading">Formulaire de modification de l'utilisateur {!! $user->name!!}</div>
        <div class=" panel-body">
          {!! Form::model($user, ['route' => ['user-edit.update', $user->id], 'method' => 'put'])!!}
              <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nom de l\'utilisateur') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" value="{{$user->name}}" placeholder="Nom de l'utilisateur" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <small class="text-danger">{{ $errors->first('name') }}</small>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" value="{{$user->email}}" placeholder="Adresse email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" required>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                       <small class="text-danger">{{ $errors->first('email') }}</small>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tel" class="col-md-4 col-form-label text-md-right">{{ __('Téléphone') }}</label>
                            <div class="col-md-6">
                                <input id="tel" type="text" value="{{$user->tel}}" placeholder="Numéro de téléphone" class="form-control{{ $errors->has('tel') ? ' is-invalid' : '' }}" name="tel">

                                @if ($errors->has('tel'))
                                    <span class="invalid-feedback">
                                        <small class="text-danger">{{ $errors->first('tel') }}</small>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

                            <div class="col-md-6">
                                <select name="role" placeholder="Role de l'utilisateur" class="form-control">
                                  <option value="" disabled selected>Selectionez le role de l'utilisateur</option>
                                  <option value="admin" {{ ( $user->role == 'admin' ) ? 'selected' : '' }}>Administrateur</option>
                                  <option value="secretaire" {{ ( $user->role == 'secretaire' ) ? 'selected' : '' }}>Secretaire</option>
                                </select>
                                @if ($errors->has('role'))
                                    <span class="invalid-feedback">
                                        <small class="text-danger">{{ $errors->first('role') }}</small>
                                    </span>
                                @endif
                            </div>
                        </div>
              <div class="col-md-4 col-md-offset-4">
              <button class="hvr-icon-fade btn btn-perso btn-block" type="submit" value="Submit">Modifier</button>
              </div>
          {!! Form::close() !!}
        </div>
  </div>
</div>
@endsection