<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\MarkerRepository;

use App\Face;
use App\Type;
use App\Support;

use PDF;

class ExportPdfController extends Controller
{
	protected $markerRepository;

    public function __construct(MarkerRepository $markerRepository)
    {
        $this->markerRepository = $markerRepository;
    }


    public function listeFace($id)
    {
        $col_face = collect([]);
        $faces = Face::where('id_emplacement',$id)
                      ->get();

        foreach($faces as $face)
        {
          if($face->etat == 0)
          {
            $support = Support::find($face->id_support);

            $data = ['id_face' => $face->id,
                     'codif' => $face->codif,
                     'support' => $support->intitule,
                     'etat' => $face->etat
                    ];

            $col_face->push($data);
          }
        }

        return $col_face;
    }

    public function export_pdf(Request $request)
  	{

  		$typee = $request->input('typeP');
  		$wilayaS = $request->input('wilaya');

    	$markers = $this->markerRepository->index();

        $collection = collect([]);
        foreach($markers as $mark)
        {
            $coord = 'Lat: '.$mark->lat.'<br>'.'Lng: '.$mark->lng;
            $type = Type::find($mark->type_id);
            $face_l = $this->listeFace($mark->id);
            $dataa = ['id' => $mark->id,
                      'name' => $mark->name,
                      'adrReg' => $mark->adrReg,
                      'wilaya' => $mark->wilaya,
                      'coord' => $coord,
                      'type' => $type['intitule'],
                      'faces' => $face_l
                     ];
            $collection->push($dataa);
        }
        $filtered = $collection;
        if(isset($typee))
        {
           $filtered = $filtered->where('type', $typee);
           $req = ''.$typee;
        }
        if(isset($wilayaS))
        {
           $filtered = $filtered->where('wilaya', $wilayaS);
           if(!empty($req)){ $req = $req.', '.$wilayaS;}
           else {$req = ''.$wilayaS;}
        }
        if(empty($req)){ $req = 'liste complete';}

    // Send data to the view using loadView function of PDF facade
    $pdf = PDF::loadView('pdf.listeEmp', compact('filtered','req'));
    // Finally, you can download the file using download function
    return $pdf->download('customers.pdf');
  }
}
