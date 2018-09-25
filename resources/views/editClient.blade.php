@extends('layouts.templateMap')

@section('titrePage') Mapper/ Modifier client @endsection

@section('content')
<br>

<div class="container">
  <div class="panel panel-warning">
      <div class="panel-heading">Formulaire de modification du client {!! $client->name!!}</div>
          <div class=" panel-body">

          {!! Form::model($client, ['route' => ['client-edit.update', $client->id], 'method' => 'put'])!!}

              <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                  <label class="col-md-2 control-label">Nom:</label>
                    <div class="input-group">             
                      <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                      </span>
                      {!! Form::text('name', $client->name , ['placeholder' => 'Nom d\'entreprise ou personelle' , 'class' => 'form-control']) !!}
                    </div>&emsp;&emsp;&emsp;
                    <small class="text-danger">{{ $errors->first('name') }}</small>
              </div>

              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                  <label class="col-md-2 control-label">Email:</label>
                    <div class="input-group">             
                      <span class="input-group-addon">
                          <i class="fa fa-envelope-o"></i>
                      </span>
                      {!! Form::email('email',$client->email, ['placeholder' => 'Adresse email' , 'class' => 'form-control']) !!}
                    </div>&emsp;&emsp;&emsp;
                    <small class="text-danger">{{ $errors->first('email') }}</small>
              </div>

              <div class="form-group{{ $errors->has('tel') ? ' has-error' : '' }}">
                  <label class="col-md-2 control-label">Téléphone:</label>
                    <div class="input-group">             
                      <span class="input-group-addon">
                          <i class="fa fa-phone"></i>
                      </span>
                      {!! Form::text('tel', $client->tel , ['placeholder' => 'Numéro de téléphone' , 'class' => 'form-control']) !!}
                    </div>&emsp;&emsp;&emsp;
                    <small class="text-danger">{{ $errors->first('tel') }}</small>
              </div>

              <div class="form-group">
                  <label class="col-md-2 control-label">Adresse:</label>
                    <div class="input-group">             
                      <span class="input-group-addon">
                          <i class="glyphicon glyphicon-map-marker"></i>
                      </span>
                      {!! Form::text('adresse', $client->adresse , ['placeholder' => 'Adresse' , 'class' => 'form-control']) !!}
                    </div>
              </div>

              <div class="col-md-4 col-md-offset-4">
              {!! Form::submit('Modifier', ['class' => 'hvr-icon-fade btn btn-perso btn-block']) !!}
            </div>
          {!! Form::close() !!}

          </div>
      
  </div>
</div>
@endsection


