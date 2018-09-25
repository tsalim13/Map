<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Example 2</title>
    
  </head>
<body>


<table style="border: 1px solid black;">
      <thead>
        <tr>
          <th rowspan="2">Identifiant</th>
          <th rowspan="2">Adresse</th>
          <th rowspan="2">Coordonées</th>
          <th rowspan="2">Type</th>
          <th colspan="3">Faces</th>
          <th rowspan="2">Actions</th>
        </tr>
        <tr>
          <th>Codif</th>
          <th>Support</th>
          <th>etat</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($collection as $marker)
          <tr>
            <td id="name" 
            rowspan="{!!count($marker['faces'])!!}">{!! $marker['name']!!}</td>
            <td id="email" 
            rowspan="{!!count($marker['faces'])!!}">{!!  $marker['adrReg'] !!}</td>
            <td id="tel" 
            rowspan="{!!count($marker['faces'])!!}">{!! $marker['coord'] !!}</td>
            <td id="adresse" 
            rowspan="{!!count($marker['faces'])!!}">{!! $marker['type'] !!}</td>
                @foreach ($marker['faces'] as $key=>$fac)
                  @if($key == 0)
                    <td>{!! $fac['codif'] !!}</td>
                    <td>{!! $fac['support'] !!}</td>
                    <td>{!! $fac['etat'] !!}</td>
                  @endif
                @endforeach
            <td id="action"
            rowspan="{!!count($marker['faces'])!!}">
              00000000000000000000
            </td>
          </tr>
          @foreach ($marker['faces'] as $key=>$fac)
                  @if($key != 0)
                    <tr>
                      <td>{!! $fac['codif'] !!}</td>
                      <td>{!! $fac['support'] !!}</td>
                      <td>{!! $fac['etat'] !!}</td>
                    </tr>
                  @endif
                @endforeach
        @endforeach
      </tbody>
    </table>

  </body>
  </html>