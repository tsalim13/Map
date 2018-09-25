@extends('layouts.templateMap')

@section('titrePage') Mapper/ Ajouter un client @endsection

@section('content')
<br>

<div class="container">
	<div class="panel panel-danger">
	    <div class="panel-heading">Formulaire d'adhésion</div>
	        <div class=" panel-body">

			    {{ Form::open(['route' => 'client-edit.store', 'method'=>'post']) }}

			        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
			            <label class="col-md-2 control-label">Nom:</label>
			              <div class="input-group">             
			                <span class="input-group-addon">
			                    <i class="fa fa-user"></i>
			                </span>
			                {!! Form::text('name', null , ['placeholder' => 'Nom d\'entreprise ou personelle' , 'class' => 'form-control']) !!}
			              </div>&emsp;&emsp;&emsp;
			              <small class="text-danger">{{ $errors->first('name') }}</small>
			        </div>

			        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
			            <label class="col-md-2 control-label">Email:</label>
			              <div class="input-group">             
			                <span class="input-group-addon">
			                    <i class="fa fa-envelope-o"></i>
			                </span>
			                {!! Form::email('email',null, ['placeholder' => 'Adresse email' , 'class' => 'form-control']) !!}
			              </div>&emsp;&emsp;&emsp;
			              <small class="text-danger">{{ $errors->first('email') }}</small>
			        </div>

			        <div class="form-group{{ $errors->has('tel') ? ' has-error' : '' }}">
			            <label class="col-md-2 control-label">Téléphone:</label>
			              <div class="input-group">             
			                <span class="input-group-addon">
			                    <i class="fa fa-phone"></i>
			                </span>
			                {!! Form::text('tel', null , ['placeholder' => 'Numéro de téléphone' , 'class' => 'form-control']) !!}
			              </div>&emsp;&emsp;&emsp;
			              <small class="text-danger">{{ $errors->first('tel') }}</small>
			        </div>

			        <div class="form-group">
			            <label class="col-md-2 control-label">Adresse:</label>
			              <div class="input-group">             
			                <span class="input-group-addon">
			                    <i class="glyphicon glyphicon-map-marker"></i>
			                </span>
			                {!! Form::text('adresse', null , ['placeholder' => 'Adresse' , 'class' => 'form-control']) !!}
			              </div>
			        </div>

			        <div class="col-md-4 col-md-offset-4">
			        <button class="hvr-icon-fade btn btn-info btn-block" type="submit" value="Submit">Ajouter</button>
			    	</div>
					{!! Form::close() !!}

	  		  </div>
	  	
	</div>
</div>
@endsection


