@extends('layouts.templateMap')

@section('scriptMap')
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/map-assets/map-css.css">
<script src="{{URL::to('/')}}/map-assets/map-api-edit.js?v={!!str_random(15)!!}"></script>
<script src="{{URL::to('/')}}/js/multi.js"></script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCrmVnM6kACq75FBLoOUlG-VsW1hzf8n1s&libraries=places&callback=initMap">
    </script>
    <script type="text/javascript">getUrlEdit("{{URL::to('/')}}");</script>
<link href="{{URL::to('/')}}/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/css/multi.css">
@endsection

@section('titrePage') Mapper/ Modifier la map @endsection

@section('indices')
<div class="btn-group">
  <button class="btn btn-secondary btn-sm dropdown-toggle hvr-icon-down" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Indices
  </button>
  <div class="dropdown-menu">
      <p>&diams;&ensp;<img src="https://icons.iconarchive.com/icons/icons-land/vista-map-markers/32/Map-Marker-Marker-Outside-Chartreuse-icon.png">Nouveau</p>
      <p>&diams;&ensp;<img src="https://icons.iconarchive.com/icons/icons-land/vista-map-markers/32/Map-Marker-Marker-Outside-Azure-icon.png">Ancien</p>
  </div>
</div>
@endsection

@section('content')
  <!--************** MAP ***************-->  
    <input id="pac-input" class="controls" type="text" placeholder="Recherchez un endroit">
      <div id="map"></div>
@endsection

@section('modalAdd')

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
        
        <button id="btnModalSupp" type="button" class="btn btn-danger" data-toggle="modal">Supprimer l'emplacement</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Nouveau emplacement</h4>
      </div>
      <div class="modal-body">
              
<div class="tab"> <!--**** tab 1 ****-->
  <b><p style="text-align: center; " id="coordonees"></p></b>
      <b><p style="text-align: center; " id="addresse_click"></p></b>
    {{ Form::open(['route' => 'edit.store', 'method'=>'post', 'id'=>'formStoreMarker']) }}
      <div class="form-group">
        {!! Form::hidden('lat', null , ['id' => 'lat']) !!}
        {!! Form::hidden('lng', null , ['id' => 'lng']) !!}
        {!! Form::hidden('etat', 0 ) !!}
      </div>
      <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">Identifiant:</span>
        {!! Form::text('adrReg', null , ['placeholder' => 'Adresse' , 'class' => 'form-control', 'id'=>'adrReg']) !!}
        {!! Form::text('nom', null , ['placeholder' => 'Identifiant' , 'class' => 'form-control', 'id'=>'nomM']) !!}
        </div>
      </div>
      <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon">Type:</span>
          <select class="form-control" name="type" style="width: 100%" id="type" required>
            <option value="" disabled selected>Selectionez le type de l'emplacement</option>
              @foreach ($types as $type)
                <option value="{!! $type->id !!}">{!! $type->intitule !!}</option>
              @endforeach
          </select>
        </div>
      </div>

      <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon">Wilaya:</span>
          <select class="form-control" name="wilaya" style="width: 100%" id="wilaya" required>
            <option value="" disabled selected>Selectionez la wilaya</option>
                <option value="Alger">Alger</option>
                <option value="Oran">Oran</option>
                <option value="Tlemcen">Tlemcen</option>
          </select>
        </div>
      </div>

      <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon">Nombre de faces:</span>
          <input type="number" class="form-control" id="nbr_faces" name="nbr_faces" min="1" max="10" value="1">
        </div>
      </div>
      <div style="overflow:auto;">
        <button class="hvr-icon-up btn btn-perso" type="submit" value="Submit" style="float:right;">Ajouter</button>
      </div>
    {!! Form::close() !!}
    
</div>

<div class="tab"><!--**** tab 2 ****-->
  <b><p style="text-align: center;">Vous pouvez ajouter une photo de l'emplacement !</p></b>
    {{ Form::open(['route' => 'photo.store', 'method'=>'post','files' => true, 'id'=>'formImage']) }}

      <div class="form-group">
        <input type="file" name="image" id="image" accept="image/*">
      </div>
      <input type="hidden" name="id_empl_photo" id="id_empl_photo">
      <div style="overflow:auto;">
        <button class="hvr-icon-up btn btn-perso" type="submit" value="submit" style="float:right;">Suivant</button>
      </div>
  {!! Form::close() !!}
</div>

<div class="tab"><!--**** tab 3 ****-->
  <b><p style="text-align: center;">Veuillez indiqué le type du support de chaque face</p></b> <br>
  {{ Form::open(['route' => 'faces.store', 'method'=>'post', 'id'=>'formStoreFace']) }}

  <div id="formInput"><!--*****--></div>
    <input type="hidden" name="id_emplacement" id="id_emplacement">
    <input type="hidden" name="nbr" id="nbr">
    <br>
  <div style="overflow:auto;">
    <button class="hvr-icon-up btn btn-perso" type="submit" value="Submit" style="float:right;">Ajouter</button>
  </div>
    {!! Form::close() !!}
</div>

<div class="tab"><!--**** tab 4 ****-->
  <b><p style="text-align: center;">Veuillez indiqué le pourcentage de majoration pour chaque face a chaque horaire</p></b> <br>
{{ Form::open(['route' => 'tarif.store', 'method'=>'post', 'id'=>'formStoreTarif']) }}
  <div id="formInput_T"><!--*****--></div>
    <input type="hidden" name="nbr_face" id="nbr_face">
    <br>
  <div style="overflow:auto;">
    <button class="hvr-icon-up btn btn-perso" type="submit" value="Submit" style="float:right;">Ajouter</button>
  </div>
{!! Form::close() !!}
</div>

      </div>
      <div class="modal-footer">
          <div style="text-align:center;">
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
          </div>
      </div>
    </div>
  </div>
</div>




<!-- Modal supp -->
  <div id="ModalFacesSupp" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body">
          <p style="text-align:center;"><img src="{{URL::to('/')}}/images/danger.png"></p>
          <p style="text-align:center;" id="markerSupp">Voulez vous vraiment supprimer cette face ?</p>
          <p style="text-align:center; color: #c50606; padding-top: 6px; font-size: 20px;"><b>Veuillez verifier si la face n'est pas loué !!</b></p>
        </div>
        <div class="modal-footer">           
        <div id="divFaceSupp"><!--***--></div>
        <p style="text-align:center;">
          <form id="formSuppFace" method="post">
            {{ method_field('DELETE') }}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="button" class="btn btn-light" data-dismiss="modal">Annuler</button>
            <button type="submit" class="hvr-icon-sink-away btn btn-danger">Supprimer</button>
          </form>
        </p>
        
        </div>
      </div>
    </div>
  </div>

@endsection

@section('modalSupp')
@foreach ($markers as $marker)
  <!-- Modal supp -->
  <div id="myModalsupp{!! $marker->id!!}" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body">
          <p style="text-align:center;"><img src="{{URL::to('/')}}/images/danger.png"></p>
          <p style="text-align:center;" id="markerSupp">Voulez vous vraiment supprimer <b><i>{!! $marker->name!!}</i></b> ?</p>
          <p style="text-align:center; color: #c50606; padding-top: 6px; font-size: 20px;"><b>Veuillez verifier si auccune de ses faces n'est loué !!</b></p>
	      </div>
	      <div class="modal-footer">           
			  {{ Form::open(['method' => 'DELETE', 'id'=>'formDel', 'route' => ['edit.destroy', $marker->id]]) }}
        <input type="hidden" name="delMark" id="delMark">
        <p style="text-align:center;">
          <button type="button" class="btn btn-light" data-dismiss="modal">Annuler</button>
          <button type="submit" class="hvr-icon-sink-away btn btn-danger">Supprimer</button>
        </p>
			  {{Form::close()}}
	      </div>
	    </div>
	  </div>
	</div>
	 @endforeach
@endsection

@section('scriptAjax')
<script src="{{URL::to('/')}}/js/select2.min.js"></script>
 <script type="text/javascript">
  var oob = {!!$supports!!};
  var horaires = {!!$horaires!!};
  var nbr;

    $(document).on('submit', '#formDel', function (event) {
          event.preventDefault();
          $this = $(this);
          var idd = document.getElementById("delMark").value;
          var idModal = "#myModalsupp"+idd;
        $(idModal).modal('hide');  // hide modal
        $("#ModalFaces").modal('hide'); // hide modal
          setNull(idd);
          $.ajax({
              url: $this.attr('action'),
              type: $this.attr('method'),
              dataType: 'json',
              data: $this.serialize()
          }).done(function (data) {

          }).fail(function (data) {

          });
      });
    
    $(document).on('submit', '#formSuppFace', function (event) {
          event.preventDefault();
          $this = $(this);
            $("#ModalFacesSupp").modal('hide'); // hide modal
            $("#ModalFaces").modal('hide'); // hide modal
          $.ajax({
              url: $this.attr('action'),
              type: $this.attr('method'),
              dataType: 'json',
              data: $this.serialize()
          }).done(function (data) {

          }).fail(function (data) {

          });
      });

   /* $(document).on('submit', '#formSuppFace', function (event) {
          event.preventDefault();
          $this = $(this);

            $("#ModalFacesSupp").modal('hide'); // hide modal            
          $.ajax({
              url: $this.attr('action'),
              type: $this.attr('method'),
              dataType: 'json',
              data: $this.serialize()
          }).done(function (data) {
 
          }).fail(function (data) {

          });*/

    $(document).on('submit', '#formStoreMarker', function (event) {
          event.preventDefault();
          $this = $(this);
           nbr = document.getElementById('nbr_faces').value;
          var e = document.getElementById("type");
          var typeId = e.options[e.selectedIndex].value;
            
          $.ajax({
              url: $this.attr('action'),
              type: $this.attr('method'),
              dataType: 'json',
              data: $this.serialize()
          }).done(function (data) {
              $("#id_emplacement").val(data.last_id);
              $("#id_empl_photo").val(data.last_id);
              nextPrev(1); // **** fct next ****
              document.getElementById("formStoreMarker").reset(); 
          }).fail(function (data) {

          });

          $.ajax({
              url: 'lastId/'+typeId,
              type: 'GET',
              dataType: 'json',
              data: null,
              success: function(response)
              {
                //console.log(response.id);
                generateForm(response);
              },
              error:function(){
                console.log("response == error ");
              }
            });
      });

    $(document).on('submit', '#formImage', function (event) {
          event.preventDefault();
          $this = $(this);
          //var formData = new FormData($this);

        var formData = new FormData(this);

        $.ajax({
            type:'POST',
            url: $(this).attr('action'),
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
              success: function(response)
              {
                nextPrev(1); // *** fct next **
                document.getElementById("formImage").reset(); 
              },
              error:function(xhr, status, error) {
                console.log("faill....");
                alert("xhr: "+xhr.responseText+" -stat: "+status+" -errr: "+error);
              }
            });
      });


    $(document).on('submit', '#formStoreFace', function (event) {
          event.preventDefault();
          $this = $(this);
        
          $.ajax({
              url: $this.attr('action'),
              type: $this.attr('method'),
              dataType: 'json',
              data: $this.serialize()
          }).done(function (data) {

              generateFormTarif(data.faces);

              document.getElementById("formStoreFace").reset();
              nextPrev(1); // *** fct next **
          }).fail(function (data) {

          });
      });

    $(document).on('submit', '#formStoreTarif', function (event) {
          event.preventDefault();
          $this = $(this);
        $("#myModal").modal('hide'); // hide modal
          $.ajax({
              url: $this.attr('action'),
              type: $this.attr('method'),
              dataType: 'json',
              data: $this.serialize()
          }).done(function (data) {
              document.getElementById("formStoreTarif").reset(); 
              console.log("doooneee tarif");
          }).fail(function (data) {
              console.log("faiill tariiiifff");
          });
      });

function generateForm(resp){
  document.getElementById("formInput").innerHTML ="";
  document.getElementById("nbr").value= nbr;
  var idd= resp.id;
  var unite= resp.unite;
  var unite_val= resp.unite_val;

  for(var i=1; i<=nbr; i++)
  {  
    var cod = idd+i;
    var codd = 1000 + parseInt(cod);
    var l = String.fromCharCode(64+i);
    if(nbr == 1){var codiff = "GP-"+codd;}
    else {var codiff = "GP-"+codd+"-"+l;}
     var div = document.createElement("div");
     var id_div = "id_support"+i;
     div.id = id_div;
     div.className = "form-group";

     var div_group = document.createElement("div");
     var id_div_group = "group"+i;
     div_group.id = id_div_group;
     div_group.className = "input-group";

     var name_input = "codif"+i;
     var input = document.createElement("input");
     input.setAttribute('type','hidden');
     input.setAttribute('name',name_input);
     input.setAttribute('value',codiff);

     var input1 = document.createElement("input");
     input1.setAttribute('type','number');
     input1.setAttribute('name','tarif'+i);
     input1.setAttribute('placeholder','Tarif');
     input1.setAttribute('id','tarif'+i);
     input1.className = "form-control";
     input1.setAttribute("style", "width: 73%;");

     var label1 = document.createElement("label");
     label1.innerHTML = '  /'+unite_val+' '+unite;
     label1.setAttribute('for','tarif'+i);

     var span = document.createElement("span");
     span.className ="input-group-addon";
     span.innerHTML = "Face "+i+": "+codiff;

     document.getElementById("formInput").append(div);
     document.getElementById(id_div).append(div_group);
     var name = 'id_support'+i;
     var sel = document.createElement("select");
     sel.name = name;
     sel.className= 'form-control';
     sel.setAttribute("style", "width: 100%;");
     
     for(var j=0 ; j<oob.length ; j++)
     {
      sel.options[sel.options.length] = new Option(oob[j].intitule,oob[j].id);
     }

     document.getElementById(id_div_group).append(span,input1,label1,sel,input);
  }
}

function generateFormTarif(faces){
  document.getElementById("formInput_T").innerHTML ="";
  document.getElementById("nbr_face").value= faces.length;

  for(var i=0; i<faces.length;i++) {

     var span = document.createElement("span");
     span.className ="input-group-addon";
     span.innerHTML = "<b>Face "+(i+1)+": "+faces[i].codif+"</b>";
     span.setAttribute("style", "background-color: #dddddd;");

     $('#formInput_T').append(span);

var inputt2 = document.createElement("input");
     inputt2.setAttribute('type','hidden');
     inputt2.setAttribute('value',faces[i].id);
     inputt2.setAttribute('name','face'+i);

$('#formInput_T').append(inputt2);

    nestedForm(i);

$('#formInput_T').append('<br>');
  }
}


function nestedForm(ii){
var lab = document.createElement("label");
     lab.innerHTML = '<b> %</b>';

  for(var j=0; j<horaires.length;j++) {
      hor = horaires[j];
        var idhh = hor.id;
     var div_group = document.createElement("div");
     div_group.className = "input-group";

     var sp = document.createElement("span");
     sp.className ="input-group-addon";
     sp.innerHTML = hor.debut+' - '+hor.fin;

     var spp = document.createElement("span");
     spp.className ="input-group-addon";
     spp.innerHTML = '%';

     var name_input = "hor"+idhh+ii;
     console.log("name input: "+name_input);
     var inputt = document.createElement("input");
     inputt.className = "form-control";
     inputt.setAttribute('type','number');
     inputt.setAttribute('name',name_input);
     inputt.setAttribute('placeholder','Pourcentage de majoration '+hor.debut+' - '+hor.fin);

     div_group.append(sp,inputt,spp);
     document.getElementById("formInput_T").append(div_group);
    }
}
</script>
@endsection
