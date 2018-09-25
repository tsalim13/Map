@extends('layouts.templateMap')

@section('scriptMap')
<!--************ SCRIPT MAP **************-->
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/map-assets/map-css.css">
<script src="{{URL::to('/')}}/map-assets/map-api.js?v={!!str_random(15)!!}"></script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCrmVnM6kACq75FBLoOUlG-VsW1hzf8n1s&libraries=places&callback=initMap">
    </script>
<script type="text/javascript">getUrl("{{URL::to('/')}}");</script>
<link href="{{URL::to('/')}}/css/select2.min.css" rel="stylesheet" />
@endsection

@section('titrePage') Mapper/ Louer emplacement @endsection

@section('indices')
<div class="btn-group">
  <button class="btn btn-secondary btn-sm dropdown-toggle hvr-icon-down" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Indices
  </button>
  <div class="dropdown-menu">
      <p>&diams;&ensp;<img src="https://icons.iconarchive.com/icons/icons-land/vista-map-markers/32/Map-Marker-Push-Pin-1-Chartreuse-icon.png">Disponible</p>
      <p>&diams;&ensp;<img src="https://icons.iconarchive.com/icons/icons-land/vista-map-markers/32/Map-Marker-Push-Pin-1-Pink-icon.png">Verrouillé</p>
  </div>
</div>
@endsection

@section('content')
  <!--*************** MAP ****************-->  
    <input id="pac-input" class="controls" type="text" placeholder="Recherchez un endroit">
    <input id="searchMarker" class="controls" type="text" placeholder="Recherchez un emplacement">
    <button id="btnMarker" class="controls">Ok</button>
    <div id="map"></div>
@endsection

@section('modalAdd')
<!--******************* Modal*************** -->
<div id="ModalPhoto" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body" id="body_photo">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
      </div>
    </div>

  </div>
</div>


<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="titreModal">Formulaire de location</h4>
      </div>
      <div class="modal-body">
          <b><p style="text-align: center;" id="coordonees"></p></b>
      {{ Form::open(['route' => 'map-client.store', 'method'=>'post', 'id'=>'formLouer']) }}
        <div class="form-group">
          {!! Form::hidden('idFace', null , ['id' => 'idFace']) !!}
        </div>
        <div class="form-group col-md-6">
          <div class="input-group">
          	<span class="input-group-addon">Du:</span>
          	{!! Form::date('dateDebut' ,\Carbon\Carbon::now(), ['class'=>'form-control']);!!}
      	  </div>
        </div>
        <div class="form-group col-md-6">
          <div class="input-group">
          	<span class="input-group-addon">Jusqu'au:</span>
          	{!! Form::date('dateFin' ,null, ['class'=>'form-control']);!!}
        	</div>
        </div>  <br><br><br>
        <div class="form-group">
        	<div class="input-group">
        		<span class="input-group-addon">Pour le client:</span>
  	     	<select class="js-example-theme-single" name="idClient" style="width: 100%">
  	     	  @foreach ($clients as $client)
  	  			<option value="{!! $client->id !!}">{!! $client->name !!}</option>
  	  		  @endforeach
  			</select>
  		</div>
  	  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
        <button class="hvr-icon-up btn btn-perso" type="submit" value="Submit">Louer</button>
		 {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>


<div id="ModalFaces" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="titreModalFace"></h4>
      </div>
      <div class="modal-body">
        <div id="ModalFacesBody"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
        <a data-toggle="modal" href="#ModalPhoto" class="btn btn-perso">Photo</a>
      </div>
    </div>
  </div>
</div>


<div id="ModalVerouiller" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <p style="text-align:center;"><img src="{{URL::to('/')}}/images/alert.png"></p><br>
        <b><p style="text-align: center; " id="verou">Emplacement Verrouillé</p></b>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Ok</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scriptAjax')
<script src="{{URL::to('/')}}/js/select2.min.js"></script>
<script type="text/javascript">
$('.modal').on('show.bs.modal', function(event) {
    var idx = $('.modal:visible').length;
    $(this).css('z-index', 1040 + (10 * idx));
});
$('.modal').on('shown.bs.modal', function(event) {
    var idx = ($('.modal:visible').length) -1; // raise backdrop after animation.
    $('.modal-backdrop').not('.stacked').css('z-index', 1039 + (10 * idx));
    $('.modal-backdrop').not('.stacked').addClass('stacked');
});

function getphoto(img){
   var link = "{{URL::to('/')}}/uploads/"+img;
   console.log(link);
    document.getElementById("body_photo").innerHTML ='<img style="max-width: 100%;" src="'+link+'">';
    $('#ModalPhoto').modal('show');
}


	$(document).ready(function() {
	    $(".js-example-theme-single").select2({
		  theme: "classic"
		});
	});
	 $(document).on('submit', '#formLouer', function (event) {
	        event.preventDefault();
	        $this = $(this);
	     $('#myModal').modal('hide');// hide modal
	        $.ajax({
	            url: $this.attr('action'),
	            type: $this.attr('method'),
	            dataType: 'json',
	            data: $this.serialize()
	        }).done(function (data) {

	        }).fail(function (data) {

	        });
	    });


function setIdFace(id)
{
  document.getElementById("idFace").value= id;
}

</script>
@endsection
