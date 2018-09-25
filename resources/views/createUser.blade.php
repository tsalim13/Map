@extends('layouts.templateMap')

@section('titrePage') Mapper/ Ajouter un utilisateur @endsection

@section('content')
<br>

<div class="container">
	<div class="panel panel-danger">
	    <div class="panel-heading">Formulaire d'adhésion</div>
	        <div class=" panel-body">

			    {{ Form::open(['route' => 'user-edit.store', 'method'=>'post']) }}

			        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nom de l\'utilisateur') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" placeholder="Nom de l'utilisateur" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

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
                                <input id="email" type="email" placeholder="Adresse email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

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
                                <input id="tel" type="text" placeholder="Numéro de téléphone" class="form-control{{ $errors->has('tel') ? ' is-invalid' : '' }}" name="tel" value="{{ old('tel') }}" >

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
                                	<option value="admin">Administrateur</option>
                                	<option value="secretaire">Secretaire</option>
                                </select>
                                @if ($errors->has('role'))
                                    <span class="invalid-feedback">
                                        <small class="text-danger">{{ $errors->first('role') }}</small>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Mot de passe') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" placeholder="Mot de passe" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <small class="text-danger">{{ $errors->first('password') }}</small>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmer le mot de passe') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" placeholder="Confirmer le mot de passe" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

			        <div class="col-md-4 col-md-offset-4">
			        <button class="hvr-icon-fade btn btn-perso btn-block" type="submit" value="Submit">Ajouter</button>
			    	</div>
					{!! Form::close() !!}

	  		  </div>
	  	
	</div>
</div>
@endsection


