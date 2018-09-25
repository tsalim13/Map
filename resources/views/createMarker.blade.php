@extends('layouts.templateMap')

@section('titrePage') Mapper/ Ajouter un emplacement @endsection

@section('content')
<br>

<div class="container">
	<div class="panel panel-danger">
	    <div class="panel-heading">Formulaire d'ajout</div>
	        <div class=" panel-body">

			    {{ Form::open(['route' => 'MarkerList.store', 'method'=>'post']) }}

			        <div class="form-group row">
                            <label for="identifiant" class="col-md-4 col-form-label text-md-right">{{ __('Identifiant') }}</label>

                            <div class="col-md-6">
                                <input id="identifiant" type="text" placeholder="Identifier l'emplacement" class="form-control{{ $errors->has('identifiant') ? ' is-invalid' : '' }}" name="nom" value="{{ old('nom') }}" required autofocus>

                                @if ($errors->has('identifiant'))
                                    <span class="invalid-feedback">
                                        <small class="text-danger">{{ $errors->first('identifiant') }}</small>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Latitude') }}</label>

                            <div class="col-md-6">
                                <input id="lat" type="text" placeholder="Coordonnées géographique (Lat)" class="form-control{{ $errors->has('lat') ? ' is-invalid' : '' }}" name="lat" value="{{ old('lat') }}" required>

                                @if ($errors->has('lat'))
                                    <span class="invalid-feedback">
                                       <small class="text-danger">{{ $errors->first('lat') }}</small>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tel" class="col-md-4 col-form-label text-md-right">{{ __('Longitude') }}</label>

                            <div class="col-md-6">
                                <input id="lng" type="text" placeholder="Coordonnées géographique (Lng)" class="form-control{{ $errors->has('lng') ? ' is-invalid' : '' }}" name="lng" value="{{ old('lng') }}" >

                                @if ($errors->has('lng'))
                                    <span class="invalid-feedback">
                                        <small class="text-danger">{{ $errors->first('lng') }}</small>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Type') }}</label>

                            <div class="col-md-6">
                                <select name="type" class="form-control">
                                	<option value="" disabled selected>Selectionez le type de l'emplacement</option>
                                	<option value="panneau">Panneau</option>
                                	<option value="plaque">Plaque</option>
                                    <option value="abrisdebus">Abris de bus</option>
                                </select>
                                @if ($errors->has('type'))
                                    <span class="invalid-feedback">
                                        <small class="text-danger">{{ $errors->first('type') }}</small>
                                    </span>
                                @endif
                            </div>
                        </div>

			        <div class="col-md-4 col-md-offset-4">
			        <button class="hvr-icon-fade btn btn-perso btn-block" type="submit" value="Submit">Ajouter</button>
			    	</div>
                    <input type="hidden" name="etat" value="0">
					{!! Form::close() !!}
	  		  </div>
	</div>
</div>
@endsection


