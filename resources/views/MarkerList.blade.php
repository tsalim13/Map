@extends('layouts.templateMap')
@section('scriptMap')
  <link rel="stylesheet" href="{{URL::to('/')}}/datatable/css/jquery.dataTables.min.css"/>
  <link rel="stylesheet" href="{{URL::to('/')}}/datatable/css/buttons.dataTables.min.css"/>
  <link href="{{URL::to('/')}}/css/select2.min.css" rel="stylesheet" />
@endsection
@section('titrePage') Mapper/ Liste des emplacements @endsection
@section('indices')
<div class="btn-group">
  <button class="btn btn-secondary btn-sm dropdown-toggle hvr-icon-down" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Indices
  </button>
  <div class="dropdown-menu">
      <p>&diams;&ensp; En cliquant sur l'entête d'une colonne, le tableau seras trier par rapport au contenu de cette derniére. </p>
  </div>
</div>
@endsection
@section('content')
<br>
	<div class="panel panel-widget">
      <div class="form-three widget-shadow">
        <div class=" panel-body-inputin">
      {!! link_to_route('MarkerList.create', 'Ajouter un emplacement', [], ['class' => 'hvr-icon-float-away btn btn-perso']) !!}
                <br>
      <button style="margin-top: 15px;" class="hvr-icon-forward btn btn-info" data-toggle="modal" data-target="#ModalPdf" id="openMod">Document personnalisé</button>
                <br><br>

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

<!--***************** Modal ********************-->
<div id="ModalPdf" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Document personnalisé</h4>
      </div>
      <div class="modal-body">
        
      <form role="form" id="formPdf" method="post" action="{{action('ExportPdfController@export_pdf')}}">
              {{csrf_field()}}
          <div id="formInput"></div>

        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon">Type:</span>
            <select class="form-control" name="typeP" style="width: 100%;" id="typeP">
              <option value="" disabled selected>Selectionez le type de l'emplacement</option>
                @foreach ($types as $type)
                  <option value="{!!$type->intitule!!}">{!! $type->intitule !!}</option>
                @endforeach
            </select>
          </div>
        </div>

        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon">Wilaya:</span>
            <select class="form-control" name="wilaya" style="width: 100%;" id="wilaya">
              <option value="" disabled selected>Selectionez la wilaya</option>
                  <option value="Alger">Alger</option>
                  <option value="Oran">Oran</option>
                  <option value="Tlemcen">Tlemcen</option>
            </select>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
          <button type="submit" id="subS" class="btn btn-perso">Export PDF</button>
          </form>
      </div>
    </div>
  </div>
</div>

  <div class="row">
  <div id="tableau">
   <table id="example" class="table table-striped table-bordered" style="width:100%">
      <thead>
        <tr>
          <th id="name" style="vertical-align: middle;" role="gridcell" rowspan="2"><i class="glyphicon glyphicon-pushpin"></i>&ensp;Identifiant</th>
          <th id="email" style="vertical-align: middle;" role="gridcell" rowspan="2"><i class="glyphicon glyphicon-map-marker"></i>&ensp;Adresse</th>
          <th id="name" style="vertical-align: middle;" role="gridcell" rowspan="2"><i class="glyphicon glyphicon-pushpin"></i>&ensp;Wilaya</th>
          <th id="tel" style="vertical-align: middle;" role="gridcell" rowspan="2"><i class="glyphicon glyphicon-map-marker"></i>&ensp;Coordonées</th>
          <th id="adresse" style="vertical-align: middle;" role="gridcell" rowspan="2"><i class="glyphicon glyphicon-tag"></i>&ensp;Type</th>
          <th id="etat" role="gridcell" colspan="3"><i class="fa fa-check-square"></i>&ensp;Faces</th>
          <th id="action" style="vertical-align: middle; width: 160px;" role="gridcell" rowspan="2">Actions</th>
        </tr>
        <tr>
          <th>Codif</th>
          <th>Support</th>
          <th>Etat</th>
        </tr>
      </thead>
      <tbody>

        @foreach ($collection as $marker)
          <tr>
            <td id="name" role="gridcell">{!! $marker['name']!!}</td>
            <td id="email" role="gridcell">{!!  $marker['adrReg'] !!}</td>
            <td id="email" role="gridcell">{!!  $marker['wilaya'] !!}</td>
            <td id="tel" role="gridcell" >{!! $marker['coord'] !!}</td>
            <td id="adresse" role="gridcell" >{!! $marker['type'] !!}</td>
            
            <td role="gridcell">
              <table>
                @foreach ($marker['faces'] as $fac)
                  <tr>
                    <td>
                      @if($fac['etat'] == 0)
                        <a onclick="setIdFace({!!$fac['id_face']!!})" data-target="#ModalLouer" data-toggle="modal" class="MainNavText" 
                        href="#ModalLouer" id="faceCodif{!!$fac['id_face']!!}">{!! $fac['codif'] !!}</a>
                      @endif
                      @if($fac['etat'] == 1)
                        {!! $fac['codif'] !!}
                      @endif
                    </td>
                  </tr>
                @endforeach
              </table>
            </td>
            <td role="gridcell">
              <table>
                @foreach ($marker['faces'] as $fac)
                  <tr>
                    <td>{!! $fac['support'] !!}</td>
                  </tr>
                @endforeach
              </table>
            </td> 
            <td role="gridcell">
              <table>
                @foreach ($marker['faces'] as $fac)
                  <tr>
                    <td id="faceEtat{!!$fac['id_face']!!}">
                      @if($fac['etat'] == 1)
                        <span class="label label-primary">Loué</span>
                      @endif
                      @if($fac['etat'] == 0)
                        <span class="label label-success">libre</span>
                      @endif
                    </td>
                  </tr>
                @endforeach
              </table>
            </td>  
            
            <td id="action" role="gridcell" }">
              <button type="button" class="btn btn-light" id="btn_photo" value="{!!$marker['photo']!!}" onclick="getphoto(this.value)"><i class="fa fa-navicon"></i></button>&emsp;
              <a href="{{ route('MarkerList.edit', ['id' => $marker['id'] ]) }}" class="btn btn-light"><img src="{{URL::to('/')}}/icones/edit.ico"></a>
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ModalSuppMarker{!!$marker['id']!!}"><img src="{{URL::to('/')}}/icones/trash.ico"></button>
            </td>
            
          </tr>
          
<!-- ********** Modal Supp Client ********** -->
<div id="ModalSuppMarker{!!$marker['id']!!}" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
            
            <div class="modal-body"><!-- ** body **-->
              <p style="text-align:center;"><img src="{{URL::to('/')}}/images/danger.png"></p>
              <p style="text-align:center;">Voulez vous vraiment supprimer l'emplacement <b>{!! $marker['name'] !!}</b> ?</p><p style="text-align:center; color: #c50606; padding-top: 6px; font-size: 20px;"><b>Veuillez verifier s'il n'est pas attribuer!!</b></p>
            </div>
            <div class="modal-footer"><!-- ** footer **--><p style="text-align:center;">
              {!! Form::open(['method' => 'DELETE', 'route' => ['MarkerList.destroy', $marker['id']]]) !!}
                <button type="button" class="btn btn-light" data-dismiss="modal">Annuler</button>
									{!! Form::submit('Confirmer', ['class' => 'hvr-icon-sink-away btn btn-danger']) !!}
							{!! Form::close() !!}</p>
            </div>
        </div>
    </div>
</div>
       
        @endforeach


      </tbody>
    </table>

    <!-- Modal -->
    <div id="ModalVoir" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" id="hc"></h4>
          </div>
          <div class="modal-body" id="histBody">
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->
  <div id="ModalLouer" class="modal fade" role="dialog">
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
</div>
</div>
</div>
</div>
@endsection
@section('scriptAjax')
<!-- *************************************** DATATABLE ************************************ -->
<script src="{{URL::to('/')}}/datatable/js/jquery.dataTables.min.js"></script>
<script src="{{URL::to('/')}}/datatable/js/dataTables.buttons.min.js"></script>
<script src="{{URL::to('/')}}/datatable/js/jszip.min.js"></script>
<script src="{{URL::to('/')}}/datatable/js/pdfmake.min.js"></script>
<script src="{{URL::to('/')}}/datatable/js/vfs_fonts.js"></script>
<script src="{{URL::to('/')}}/datatable/js/buttons.html5.min.js"></script>

<script src="{{URL::to('/')}}/datatable/js/buttons.colVis.min.js"></script>

<script src="{{URL::to('/')}}/js/select2.min.js"></script>
<script type="text/javascript">
var type = {!!$types!!};

$("#subS").click(function(){
    $('#ModalPdf').modal('hide');
});

$(document).ready(function() {
      $(".js-example-theme-single").select2({
      theme: "classic"
    });
  });

$(document).on('submit', '#formLouer', function (event) {
          event.preventDefault();
          $this = $(this);
          var idFace = document.getElementById("idFace").value;
          setTdInner(idFace);
       $('#ModalLouer').modal('hide');// hide modal
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

function setTdInner(id)
{
  console.log("id = "+id);
  var tdEtat = "faceEtat"+id;
  var tdCodif = "faceCodif"+id;
  document.getElementById(tdEtat).innerHTML='<span class="label label-primary">Loué</span>';
  //document.getElementById("tdCodif").innerHTML='';
  document.getElementById(tdCodif).disabled = true;

}

function getphoto(img){
   var link = "{{URL::to('/')}}/uploads/"+img;
   console.log(link);
    document.getElementById("body_photo").innerHTML ='<img style="max-width: 100%;" src="'+link+'">';
    $('#ModalPhoto').modal('show');
}

$("#openMod").click(function(){
  document.getElementById("formPdf").reset(); 
});

var coll = {!!$collection!!};

  $.ajaxSetup({
    timeout: 10000
  });


//********************* PDF MAKE ***********************
  $(document).ready(function() {
    var now = new Date();
    var jsDate = now.getDate()+'-'+(now.getMonth()+1)+'-'+now.getFullYear();
    $('#example').DataTable({
        dom: 'Bfrtip',
        responsive: {
            details: {
                type: 'column'
            }
        },
        columnDefs: [
        { "orderable": false, "targets": 8 }],
        buttons: [
        'colvis',
            'copyHtml5',
            {
                extend: 'csvHtml5',
                filename: '*_Liste_Emplacement_'+jsDate,
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5]
                }
            },
            {
                extend: 'excelHtml5',
                title: 'Liste des emplacements '+jsDate,
                filename: '*_Liste_Emplacement_'+jsDate,
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5]
                }
            },
            {
                extend: 'pdfHtml5',
                title: 'Liste des emplacements ',
                filename: '*_Liste_Emplacement_'+jsDate,
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5]
                },
                pageSize: 'A4',
                customize: function ( doc ) {
                  doc.content[1].table.widths = [
                  '25%',
                  '11%',
                  '11%',
                  '11%',
                  '10%',
                  '10%'
                  ];
                  doc.styles.tableHeader.fillColor  = '#dddddd';
                  doc.styles.tableHeader.color = '#000000';
                  doc.pageMargins = [30, 80, 30, 40 ];//left,top,right
                  var objLayout = {};
                  objLayout['hLineWidth'] = function(i) { return .5; };
                  objLayout['vLineWidth'] = function(i) { return .5; };
                  objLayout['hLineColor'] = function(i) { return '#444444'; };
                  objLayout['vLineColor'] = function(i) { return '#444444'; };
                  objLayout['paddingLeft'] = function(i) { return 4; };
                  objLayout['paddingRight'] = function(i) { return 4; };
                  objLayout['paddingTop'] = function(i) { return 4; };
                  objLayout['paddingBottom'] = function(i) { return 4; };
                  doc.content[1].layout = objLayout;
var logo = 'data:image/png;base64,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';
                  doc['header']=(function() {
                      return {
                        columns: [
                          {
                            image: logo,
                            width: 75
                          },
                          {
                            alignment: 'right',
                            fontSize: 12,
                            italics: true,
                            text: 'Un partenaire sûr pour vos affichages',
                            //'<?php //foreach ($clients as $client): print $client->name; endforeach?>'
                             margin: [10,25]
                          }
                        ],
                        margin: [40,15]
                      }
                    });
                  doc['footer']=(function(page, pages) {
                      return {
                        columns: [
                          {
                            alignment: 'left',
                            text: ['Créer le: ', { text: jsDate.toString() }]
                          },
                          {
                            alignment: 'right',
                            text: ['page ', { text: page.toString() },  ' sur ', { text: pages.toString() }]
                          }
                        ],
                        margin: [20,10]  }
                    });
                }//customize
            }
        ]
    } );
} );
</script>
@endsection