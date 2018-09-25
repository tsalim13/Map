<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TypeRepository;
use App\Repositories\SupportRepository;
use App\Repositories\HoraireRepository;
use Validator;
use Response;

class TypeEmplcController extends Controller
{
    protected $typeRepository;
    protected $supportRepository;
    protected $horaireRepository;

    public function __construct(TypeRepository $typeRepository,SupportRepository $supportRepository, HoraireRepository $horaireRepository)
    {
        $this->typeRepository = $typeRepository;
        $this->supportRepository = $supportRepository;
        $this->horaireRepository = $horaireRepository;
    }
    public function index()
    {
        $types = $this->typeRepository->index();
        $supports = $this->supportRepository->index();
        $horaires = $this->horaireRepository->index();
        return view('createType',compact('types','supports','horaires'));
    }
    public function create()
    {
        return view('createType');
    }
    public function store(Request $request)
    {
        if($request->input('formulaire') == 1){
            $validator = Validator::make($request->all(), [
                'type'=>'required|max:100|unique:types,intitule',
            ]);

            if ($validator->fails()) {
                return Response::json(['errors' => $validator->errors()]);
            }
            else{
            $type = $this->typeRepository->store($request->all());
            return Response::json(['success' => '1']);
            }//return redirect('types/create');
        }
        else if ($request->input('formulaire') == 2){
            $validator = Validator::make($request->all(), [
                'support'=>'required|max:100|unique:supports,intitule',
            ]);

            if ($validator->fails()) {
                return Response::json(['errors' => $validator->errors()]);
            }
            else{
            $type = $this->supportRepository->store($request->all());
            return Response::json(['success' => '1']);
            }//return redirect('types/create');
        }
        else if ($request->input('formulaire') == 3){

            $horaire = $this->horaireRepository->store($request->all());
            return Response::json(['success' => '1']);
            //return redirect('types/create');
        }
    }
    public function destroy($id)
    {
        $this->typeRepository->destroy($id);
        return redirect('types');
    }
    public function destroyS(Request $request)
    {
        $this->supportRepository->destroy($request->input('supp'));
        return redirect('types');
    }
    public function edit($id)
    {
        $marker = $this->markerRepository->getById($id);
        return view('editMarker',  compact('marker'));
    }
    public function update(Request $request, $id)
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
        $this->markerRepository->update($id, $request->all());
        return redirect('MarkerList');
    }
}
