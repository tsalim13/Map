@extends('layouts.templateMap')

@section('scriptMap')
  <link rel="stylesheet" href="{{URL::to('/')}}/datatable/css/jquery.dataTables.min.css"/>
  <link rel="stylesheet" href="{{URL::to('/')}}/datatable/css/buttons.dataTables.min.css"/>
@endsection

@section('titrePage') Mapper/ Ajouter un utilisateur @endsection

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

<div class="panel panel-widget"> <!-- Panel widget-->
  <div class="form-three widget-shadow">
    <div class=" panel-body-inputin"><!-- Panel Body-->
      <div class="row">
<div class="col-lg-6"><!-- ******** Types ********-->
	       <button type="button" class="btn btn-perso" data-toggle="modal" data-target="#ModalAddType">Nouveau type d'emplacement</button><br><br>
    <table id="tabType" class="table table-striped table-bordered">
      <thead>
        <tr>
          <th id="name" role="gridcell"><i class="fa fa-user"></i>&ensp;Intitulé</th>
          <th id="name" role="gridcell"><i class="fa fa-user"></i>&ensp;Unité</th>
          <th id="action" role="gridcell" style="width: 160px; align-content: center;">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($types as $type)
          <tr>
            <td id="intitule" role="gridcell">{!! $type->intitule !!}</td>
            <td id="intitule" role="gridcell">{!!$type->unite_val!!} {!!$type->unite!!}</td>
            <td id="action" role="gridcell">
              <button type="button" class="btn btn-light"><i class="fa fa-navicon"></i></button>&emsp;
              <a href="{{ route('types.edit', ['id' => $type->id]) }}" class="btn btn-light"><img src="{{URL::to('/')}}/icones/edit.ico"></a>
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ModalSuppType{!!$type->id!!}"><img src="{{URL::to('/')}}/icones/trash.ico"></button>
            </td>
          </tr>
<div id="ModalSuppType{!!$type->id!!}" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body"><!-- ** body **-->
              <p style="text-align:center;"><img src="{{URL::to('/')}}/images/danger.png"></p>
              <p style="text-align:center;">Voulez vous vraiment supprimer le type <b>{!! $type->intitule !!}</b> ?</p><p style="text-align:center; color: #c50606; padding-top: 6px; font-size: 20px;"><b>Veuillez verifier s'il n'a pas d'emplacement louer !!</b></p>
            </div>
            <div class="modal-footer"><!-- ** footer **-->
                <p style="text-align:center;">
              {!! Form::open(['method' => 'DELETE', 'route' => ['types.destroy', $type->id]]) !!}
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
        </div><!-- ********* Fin Types ******* -->

        <div class="col-lg-6"><!-- Support-->
           <button type="button" class="btn btn-perso" data-toggle="modal" data-target="#ModalAddSupport">Nouveau type de support</button><br><br>
    <table id="tabSupport" class="table table-striped table-bordered">
      <thead>
        <tr>
          <th id="name" role="gridcell"><i class="fa fa-user"></i>&ensp;Intitulé</th>
          <th id="action" role="gridcell" style="width: 160px; align-content: center;">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($supports as $support)
          <tr>
            <td id="intitule" role="gridcell">{!! $support->intitule !!}</td>
            <td id="action" role="gridcell">
              <button type="button" class="btn btn-light"><i class="fa fa-navicon"></i></button>&emsp;
              <a href="{{ route('types.edit', ['id' => $support->id]) }}" class="btn btn-light"><img src="{{URL::to('/')}}/icones/edit.ico"></a>
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ModalSuppSupport{!!$support->id!!}"><img src="{{URL::to('/')}}/icones/trash.ico"></button>
            </td>
          </tr>
<div id="ModalSuppSupport{!!$support->id!!}" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body"><!-- ** body **-->
              <p style="text-align:center;"><img src="{{URL::to('/')}}/images/danger.png"></p>
              <p style="text-align:center;">Voulez vous vraiment supprimer le support <b>{!! $support->intitule !!}</b> ?</p><p style="text-align:center; color: #c50606; padding-top: 6px; font-size: 20px;"><b>Veuillez verifier s'il n'a pas d'emplacement louer !!</b></p>
            </div>
            <div class="modal-footer"><!-- ** footer **-->
                <p style="text-align:center;">
             
              <form role="form" id="formPdf" method="post" action="{{action('TypeEmplcController@destroyS')}}">
              {{csrf_field()}}
              <input type="hidden" name="supp" value="{!! $support->id !!} !!}">
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
        </div><!-- Fin Support-->
      </div>
<hr style="border-width: 7px; color: #d7d7dd;">

<div class="row">
  <div class="col-lg-6">
     <button type="button" class="btn btn-perso" data-toggle="modal" data-target="#ModalAddHor">Nouvel horaire</button><br><br>
    <table id="tabHor" class="table table-striped table-bordered">
      <thead>
        <tr>
          <th id="name" role="gridcell"><i class="fa fa-user"></i>&ensp;Début</th>
          <th id="name" role="gridcell"><i class="fa fa-user"></i>&ensp;Fin</th>
          <th id="action" role="gridcell" style="width: 160px; align-content: center;">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($horaires as $hor)
          <tr>
            <td id="debut" role="gridcell">{!! $hor->debut !!}</td>
            <td id="fin" role="gridcell">{!! $hor->fin !!}</td>
            <td id="action" role="gridcell">
              <button type="button" class="btn btn-light"><i class="fa fa-navicon"></i></button>&emsp;
              <a href="{{ route('types.edit', ['id' => $support->id]) }}" class="btn btn-light"><img src="{{URL::to('/')}}/icones/edit.ico"></a>
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ModalSuppSupport{!!$support->id!!}"><img src="{{URL::to('/')}}/icones/trash.ico"></button>
            </td>
          </tr>
<div id="ModalSuppHor{!!$hor->id!!}" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body"><!-- ** body **-->
              <p style="text-align:center;"><img src="{{URL::to('/')}}/images/danger.png"></p>
              <p style="text-align:center;">Voulez vous vraiment supprimer l'horaire <b>{!! $hor->debut !!} / {!! $hor->fin !!}</b> ?</p><p style="text-align:center; color: #c50606; padding-top: 6px; font-size: 20px;"><b>Veuillez verifier s'il n'a pas d'emplacement louer !!</b></p>
            </div>
            <div class="modal-footer"><!-- ** footer **-->
                <p style="text-align:center;">
              {!! Form::open(['method' => 'DELETE', 'route' => ['types.destroy', $hor->id]]) !!}
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
  </div>
  
</div>


    </div><!-- Fin Panel Body-->
  </div>
</div><!-- Fin Panel widget-->
    <!-- Modal -->
<div id="ModalAddType" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Nouveau type</h4>
      </div>
      <div class="modal-body">
        {{ Form::open(['route' => 'types.store','id'=>'addType', 'method'=>'post']) }}
            <div class="form-group row">
                <label for="type" class="col-md-3 col-form-label text-md-right">{{ __('Intitulé') }}</label>
                <div class="col-md-6">
                     <input id="type" type="text" placeholder="Intitulé" class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" name="type">
                    <span class="invalid-feedback">
                        <small id="type-error" class="text-danger"></small>
                    </span>
                </div>
            </div>

            <div class="form-group row">
              <label for="type" class="col-md-3 col-form-label text-md-right">{{ __('Unité') }}</label>
              <div class="col-md-4">
                <input type="number" class="form-control" id="nbr_faces" name="unite_val" min="1" max="60" value="1">
              </div>
              <div class="col-md-5">
                <input class="form-check-input" type="radio" name="unite" id="seconde" value="Seconde">
                <label class="form-check-label" for="seconde">
                  Seconde
                </label>

                <input class="form-check-input" type="radio" name="unite" id="heure" value="Heure">
                <label class="form-check-label" for="heure">
                  Heure
                </label>

                <input class="form-check-input" type="radio" name="unite" id="jour" value="Jour">
                <label class="form-check-label" for="jour">
                  Jour
                </label>

              </div>
            </div>
            <input type="hidden" name="formulaire" value="1">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
        <button class="hvr-icon-fade btn btn-perso" type="submit" value="Submit">Ajouter</button>
        {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>

      <!-- Modal -->
<div id="ModalAddHor" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Nouvel horaire</h4>
      </div>
      <div class="modal-body">
        {{ Form::open(['route' => 'types.store','id'=>'addHor', 'method'=>'post']) }}
            <div class="form-group row">
                <label for="horDebut" class="col-md-3 col-form-label text-md-right">{{ __('Début') }}</label>
                <div class="col-md-6">
                     <input id="horDebut" type="time" class="form-control" name="horDebut">
                </div>
            </div>
            <div class="form-group row">
                <label for="horFin" class="col-md-3 col-form-label text-md-right">{{ __('Fin') }}</label>
                <div class="col-md-6">
                     <input id="horFin" type="time" class="form-control" name="horFin">
                </div>
            </div>
            <input type="hidden" name="formulaire" value="3">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
        <button class="hvr-icon-fade btn btn-perso" type="submit" value="Submit">Ajouter</button>
        {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>


      <!-- Modal -->
<div id="ModalAddSupport" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Nouveau support</h4>
      </div>
      <div class="modal-body">
        {{ Form::open(['route' => 'types.store','id'=>'addSupport', 'method'=>'post']) }}
            <div class="form-group row">
                <label for="support" class="col-md-4 col-form-label text-md-right">{{ __('Intitulé') }}</label>
                <div class="col-md-6">
                     <input id="support" type="text" placeholder="Intitulé" class="form-control{{ $errors->has('support') ? ' is-invalid' : '' }}" name="support">
                    <span class="invalid-feedback">
                        <small id="support-error" class="text-danger"></small>
                    </span>
                </div>
            </div>
            <input type="hidden" name="formulaire" value="2">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
        <button class="hvr-icon-fade btn btn-perso" type="submit" value="Submit">Ajouter</button>
        {!! Form::close() !!}
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

 <script type="text/javascript">
$.ajaxSetup({
    timeout: 10000
});
      $(document).on('submit', '#addType', function (event) {
        $( '#type-error' ).html( "" );
        event.preventDefault();
          $this = $(this);
          $.ajax({
              url: $this.attr('action'),
              type: $this.attr('method'),
              dataType: 'json',
              data: $this.serialize()
              }).done(function (data) {
                    if(data.errors) {
                        if(data.errors.type){
                            $('#type-error').html( data.errors.type[0]);
                        }
                    }
                    else if(data.success) {
                         $('#ModalAddType').modal('hide');
                         $('#type').val('');
                    }
              }).fail(function (data) {
              // do what ever you want if the request is not ok
              });
            });//fin ajax

$(document).on('submit', '#addSupport', function (event) {
      $( '#support-error' ).html( "" );
        event.preventDefault();
          $this = $(this);
          $.ajax({
              url: $this.attr('action'),
              type: $this.attr('method'),
              dataType: 'json',
              data: $this.serialize()
              }).done(function (data) {
                    if(data.errors) {
                        if(data.errors.support){
                            $('#support-error').html( data.errors.support[0]);
                        }
                    }
                    else if(data.success) {
                         $('#ModalAddSupport').modal('hide');
                         $('#support').val('');
                    }
              }).fail(function (data) {
              // do what ever you want if the request is not ok
              });
            });//fin ajax

$(document).on('submit', '#addHor', function (event) {
        $( '#type-error' ).html( "" );
        event.preventDefault();
          $this = $(this);
          $.ajax({
              url: $this.attr('action'),
              type: $this.attr('method'),
              dataType: 'json',
              data: $this.serialize()
              }).done(function (data) {
                    if(data.errors) {
                        if(data.errors.type){
                            $('#type-error').html( data.errors.type[0]);
                        }
                    }
                    else if(data.success) {
                         $('#ModalAddHor').modal('hide');
                    }
              }).fail(function (data) {
              // do what ever you want if the request is not ok
              });
            });//fin ajax

//********************* PDF MAKE ***********************
var logo = 'data:image/png;base64,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';
  $(document).ready(function() {
    var now = new Date();
    var jsDate = now.getDate()+'-'+(now.getMonth()+1)+'-'+now.getFullYear();
    $('#tabType').DataTable( {
        dom: 'Bfrtip',
        columnDefs: [
        { "orderable": false, "targets": 1 }],
        buttons: [
            'copyHtml5',
            {
                extend: 'csvHtml5',
                filename: 'Type_Emplacements_'+jsDate,
                exportOptions: {
                    columns: [ 0 ]
                }
            },
            {
                extend: 'excelHtml5',
                title: 'Types des emplacements '+jsDate,
                filename: 'Type_Emplacements_'+jsDate,
                exportOptions: {
                    columns: [ 0 ]
                }
            },
            {
                extend: 'pdfHtml5',
                title: 'Types des emplacement ',
                filename: 'Type_Emplacements_'+jsDate,
                exportOptions: {
                    columns: [ 0 ]
                },
                pageSize: 'A4',
                customize: function ( doc ) {
                  doc.content[1].table.widths = [
                  '50%'
                  ];
                  doc.styles.tableHeader.fillColor  = '#dddddd';
                  doc.styles.tableHeader.color = '#000000';
                  doc.pageMargins = [30, 80, 30,40 ];//left,top,right
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
                  
                  doc['header']=(function() {
                      return {
                        columns: [
                          {
                            image: logo,
                            width: 140
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

// ************** pdf make support ***************
$(document).ready(function() {
    var now = new Date();
    var jsDate = now.getDate()+'-'+(now.getMonth()+1)+'-'+now.getFullYear();
    $('#tabSupport').DataTable( {
        dom: 'Bfrtip',
        columnDefs: [
        { "orderable": false, "targets": 1 }],
        buttons: [
            'copyHtml5',
            {
                extend: 'csvHtml5',
                filename: 'Type_Supports_'+jsDate,
                exportOptions: {
                    columns: [ 0 ]
                }
            },
            {
                extend: 'excelHtml5',
                title: 'Types des supports '+jsDate,
                filename: 'Type_Supports_'+jsDate,
                exportOptions: {
                    columns: [ 0 ]
                }
            },
            {
                extend: 'pdfHtml5',
                title: 'Types des supports ',
                filename: 'Type_Supports_'+jsDate,
                exportOptions: {
                    columns: [ 0 ]
                },
                pageSize: 'A4',
                customize: function ( doc ) {
                  doc.content[1].table.widths = [
                  '50%'
                  ];
                  doc.styles.tableHeader.fillColor  = '#dddddd';
                  doc.styles.tableHeader.color = '#000000';
                  doc.pageMargins = [30, 80, 30,40 ];//left,top,right
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

                  doc['header']=(function() {
                      return {
                        columns: [
                          {
                            image: logo,
                            width: 140
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
// ************** pdf make horaire ***************
$(document).ready(function() {
    var now = new Date();
    var jsDate = now.getDate()+'-'+(now.getMonth()+1)+'-'+now.getFullYear();
    $('#tabHor').DataTable( {
        dom: 'Bfrtip',
        columnDefs: [
        { "orderable": false, "targets": 2 }],
        buttons: [
            'copyHtml5',
            {
                extend: 'csvHtml5',
                filename: 'Type_Supports_'+jsDate,
                exportOptions: {
                    columns: [ 0 ]
                }
            },
            {
                extend: 'excelHtml5',
                title: 'Types des supports '+jsDate,
                filename: 'Type_Supports_'+jsDate,
                exportOptions: {
                    columns: [ 0 ]
                }
            },
            {
                extend: 'pdfHtml5',
                title: 'Types des supports ',
                filename: 'Type_Supports_'+jsDate,
                exportOptions: {
                    columns: [ 0 ]
                },
                pageSize: 'A4',
                customize: function ( doc ) {
                  doc.content[1].table.widths = [
                  '50%'
                  ];
                  doc.styles.tableHeader.fillColor  = '#dddddd';
                  doc.styles.tableHeader.color = '#000000';
                  doc.pageMargins = [30, 80, 30,40 ];//left,top,right
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

                  doc['header']=(function() {
                      return {
                        columns: [
                          {
                            image: logo,
                            width: 140
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
