<?php

namespace App\Http\Controllers;

use App\Repositories\MarkerRepository;
use App\Repositories\TypeRepository;
use App\Repositories\SupportRepository;
use App\Repositories\ClientRepository;

use Illuminate\Http\Request;
use Validator;

use App\Face;
use App\Type;
use App\Support;
use App\Photo;

class MarkerListController extends Controller
{
    protected $markerRepository;
    protected $typeRepository;
    protected $supportRepository;
    protected $clientRepository;

    public function __construct(MarkerRepository $markerRepository, TypeRepository $typeRepository, SupportRepository $supportRepository,ClientRepository $clientRepository)
    {
        $this->markerRepository = $markerRepository;
        $this->typeRepository = $typeRepository;
        $this->supportRepository = $supportRepository;
        $this->clientRepository = $clientRepository;
    }

    /*public function index()
    {
        $markers = $this->markerRepository->index();
        return view('MarkerList',compact('markers'));
    }*/


    public function index()
    {
        $markers = $this->markerRepository->index();
        $clients = $this->clientRepository->index();

        $collection = collect([]);
        foreach($markers as $mark)
        {
            $coord = 'Lat: '.$mark->lat.'<br>'.'Lng: '.$mark->lng;
            $type = Type::find($mark->type_id);
            if (empty($type)) {
                $type = new Type(); $type->intitule='-----';
            }
            $photoo = Photo::where('id_emplacement',$mark->id)
                    ->first();
            if(empty($photoo)){$photoo= new Photo(); $photoo->title = "";}
            $face_l = $this->listeFace($mark->id);
            $dataa = ['id' => $mark->id,
                      'name' => $mark->name,
                      'adrReg' => $mark->adrReg,
                      'wilaya' => $mark->wilaya,
                      'coord' => $coord,
                      'type' => $type->intitule,
                      'photo' => $photoo->title,
                      'faces' => $face_l
                     ];
            $collection->push($dataa);
        }
        
        $types = $this->typeRepository->index();

        return view('MarkerList',compact('collection', 'types','clients'));
    }



    public function create()
    {
        return view('createMarker');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'identifiant'=>'required|max:200',
            'lat'=>'required',
            'lng'=>'required',
            'adresse'=>'required',
        ]);
        if ($validator->fails()) {
            return redirect('MarkerList/create')
                        ->withErrors($validator)
                        ->withInput();
        }
        $marker = $this->markerRepository->store($request->all());
        return redirect('MarkerList');
    }
    public function destroy($id)
    {
        $this->markerRepository->destroy($id);
        return redirect('MarkerList');
    }
    public function edit($id)
    {
        $marker = $this->markerRepository->getById($id);
        $types = $this->typeRepository->index();
        $faces = Face::where('id_emplacement',$id)
                        ->get();
        $support = $this->supportRepository->index();
        return view('editMarker',  compact('marker','types','faces','support'));
    }
    public function update(Request $request, $id)
    {
        /*$validator = Validator::make($request->all(), [
            'identifiant'=>'required|max:200',
            'lat'=>'required',
            'lng'=>'required',
            'adresse'=>'required',
        ]);

        if ($validator->fails()) {
            return redirect('MarkerList/create')
                        ->withErrors($validator)
                        ->withInput();
        }*/
        $this->markerRepository->update($id, $request->all());
        return redirect('MarkerList');
    }

    public function listeFace($id)
    {
        $col_face = collect([]);
        $faces = Face::where('id_emplacement',$id)
                      ->get();
        foreach($faces as $face)
        {
            $support = Support::find($face->id_support);
            $data = ['id_face' => $face->id,
                     'codif' => $face->codif,
                     'support' => $support->intitule,
                     'etat' => $face->etat
                    ];
            $col_face->push($data);
        }
        return $col_face;
    }
}