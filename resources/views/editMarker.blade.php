@extends('layouts.templateMap')

@section('titrePage') Mapper/ Modifier un emplacement @endsection

@section('content')
<br>
<div class="container">
  <div class="panel panel-warning">
      <div class="panel-heading">Formulaire de modification {!! $marker->name!!}</div>
          <div class=" panel-body">
          {!! Form::model($marker, ['route' => ['MarkerList.update', $marker->id], 'method' => 'put'])!!}
              <div class="form-group row">
                            <label for="identifiant" class="col-md-3 col-form-label text-md-right">{{ __('Identifiant') }}</label>
                            <div class="col-md-6">
                                <input id="identifiant" type="text" placeholder="Identifier l'emplacement" class="form-control{{ $errors->has('nom') ? ' is-invalid' : '' }}" name="nom" value="{{$marker->name}}" required>
                                @if ($errors->has('nom'))
                                    <span class="invalid-feedback">
                                        <small class="text-danger">{{ $errors->first('identifiant') }}</small>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="adrReg" class="col-md-3 col-form-label text-md-right">{{ __('Adresse') }}</label>
                            <div class="col-md-6">
                                <input id="lat" type="text" placeholder="Adresse" class="form-control" name="adrReg" value="{{$marker->adrReg}}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="adrReg" class="col-md-3 col-form-label text-md-right">{{ __('Wilaya') }}</label>
                            <div class="col-md-6">
                              <select class="form-control" name="wilaya" style="width: 100%" id="wilaya" required>
                                <option value="Alger" {{ ( $marker->wilaya == 'Alger') ? 'selected' : '' }}>Alger</option>
                                <option value="Oran" {{ ( $marker->wilaya == 'Oran') ? 'selected' : '' }}>Oran</option>
                                <option value="Tlemcen" {{ ( $marker->wilaya == 'Tlemcen') ? 'selected' : '' }}>Tlemcen</option>
                              </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lat" class="col-md-3 col-form-label text-md-right">{{ __('Latitude') }}</label>
                            <div class="col-md-6">
                                <input id="lat" type="text" placeholder="Coordonnées géographique (Lat)" class="form-control{{ $errors->has('lat') ? ' is-invalid' : '' }}" name="lat" value="{{$marker->lat}}" required>
                                @if ($errors->has('lat'))
                                    <span class="invalid-feedback">
                                       <small class="text-danger">{{ $errors->first('lat') }}</small>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lng" class="col-md-3 col-form-label text-md-right">{{ __('Longitude') }}</label>
                            <div class="col-md-6">
                                <input id="lng" type="text" placeholder="Coordonnées géographique (Lng)" class="form-control{{ $errors->has('lng') ? ' is-invalid' : '' }}" name="lng" value="{{$marker->lng}}" required>
                                @if ($errors->has('lng'))
                                    <span class="invalid-feedback">
                                        <small class="text-danger">{{ $errors->first('lng') }}</small>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="role" class="col-md-3 col-form-label text-md-right">{{ __('Type') }}</label>
                            <div class="col-md-6">
                                <select name="type" class="form-control">
                                  @foreach($types as $type)
                                    <option value="{!!$type->id!!}" {{ ( $marker->type_id == $type->id) ? 'selected' : '' }}>{!!$type->intitule!!}</option>
                                  @endforeach
                                </select>
                                @if ($errors->has('type'))
                                    <span class="invalid-feedback">
                                        <small class="text-danger">{{ $errors->first('type') }}</small>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="role" class="col-md-3 col-form-label text-md-right">{{ __('Etat') }}</label>
                            <div class="col-md-6">

                                <input type="radio" name="etat" value="0" {{ ( $marker->etat == '0' ) ? 'checked' : '' }}>Disponible&ensp;
                                <input type="radio" name="etat" value="2" {{ ( $marker->etat == '2' ) ? 'checked' : '' }}>Verrouiller
                                @if ($errors->has('etat'))
                                    <span class="invalid-feedback">
                                        <small class="text-danger">{{ $errors->first('etat') }}</small>
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


    <div class="panel panel-warning">
      <div class="panel-heading">Formulaire de modification faces</div>
          <div class=" panel-body">
            @foreach($faces as $fac)
                {!! Form::model($fac, ['route' => ['faces.update', $fac->id], 'method' => 'put'])!!}
                    <div class="form-group row">
                        <label for="role" class="col-md-2  col-form-label text-md-right">{{ $fac->codif }}</label>
                        <div class="col-md-5">
                           <select name="support" class="form-control">
                             @foreach($support as $supp)
                               <option value="{!!$supp->id!!}" {{ ( $supp->id == $fac->id_support) ? 'selected' : '' }}>{!!$supp->intitule!!}</option>
                             @endforeach
                           </select>
                        </div>
                        <div class="col-md-3">
                          <button class="hvr-icon-fade btn btn-perso" type="submit" value="Submit">Modifier</button>
                        </div>
                    </div>
                {!! Form::close() !!}
                <br>
            @endforeach
          </div>
      </div>
    </div>

</div>
@endsection


