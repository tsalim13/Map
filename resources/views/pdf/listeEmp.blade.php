<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="{{URL::to('/')}}/css/bootstrap.css">
    <title>Liste</title>
    
  </head>
<body>
<table style="margin-top: 0; padding-top: 0; width:100%;">
  <tr>
    <td style="text-align: left; vertical-align: top;"><img src="{{URL::to('/')}}/130.png"></td>
    <td style="padding-right: 10px; text-align: center; vertical-align: middle"><h2>Liste des emplacements</h2></td>
    <td style="text-align: right; vertical-align: top;">{!!\Carbon\Carbon::now()!!}</td>
  </tr>  
</table>
<br>

<p><b>Requete:</b> {!!$req!!}</p>
<table class="table table-bordered">
      <thead style="background-color: #e1dede;">
        <tr>
          <th style="vertical-align: middle;text-align: center;" rowspan="2">Adresse</th>
          <th style="vertical-align: middle;text-align: center;" rowspan="2">Wilaya</th>
          <th style="width: 110px; vertical-align: middle;text-align: center;" rowspan="2">Coordonées</th>
          <th style="vertical-align: middle;text-align: center;" rowspan="2">Type</th>
          <th colspan="3" style="text-align: center;">Faces</th>
        </tr>
        <tr>
          <th style="width: 75px;text-align: center;">Code</th>
          <th style="width: 80px;text-align: center;">Support</th>
          <th style="width: 22px;text-align: center;">etat</th>
        </tr>
      </thead>
      <tbody>
       @foreach ($filtered as $marker)
          <tr>
            <td id="email" role="gridcell">{!!  $marker['adrReg'] !!}</td>
            <td id="email" role="gridcell">{!!  $marker['wilaya'] !!}</td>
            <td id="tel" role="gridcell" >{!! $marker['coord'] !!}</td>
            <td id="adresse" role="gridcell" >{!! $marker['type'] !!}</td>
            
            <td colspan="3" role="gridcell" style="padding: 0; margin: 0;">
              <table class="table table-bordered" style="padding: 0;">
                @foreach ($marker['faces'] as $fac)
                  <tr>
                    <td style="width: 75px">{!! $fac['codif'] !!}</td>
                    <td style="width: 80px">{!! $fac['support'] !!}</td>
                    <td style="width: 22px">
                      @if($fac['etat'] == 0)Libre @endif
                      @if($fac['etat'] != 0)Loué @endif
                    </td>
                  </tr>
                @endforeach
              </table>


            </td>
        @endforeach
      </tbody>
    </table>

  </body>
  </html>