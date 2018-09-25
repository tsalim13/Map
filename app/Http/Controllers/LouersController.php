<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ClientRepository;
use App\Repositories\LouerRepository;
use App\Gestion\DataXmlGestion;
use App\Marker;
use App\Face;

class LouersController extends Controller
{
    protected $clientRepository;
    protected $louerRepository;
    protected $dataXmlGestion;

    public function __construct(ClientRepository $clientRepository, LouerRepository $louerRepository,DataXmlGestion $dataXmlGestion)
    {
        $this->clientRepository = $clientRepository;
        $this->louerRepository = $louerRepository;
        $this->dataXmlGestion = $dataXmlGestion;
    }

    public function index()
    {
        $clients = $this->clientRepository->index();
        $this->dataXmlGestion->generateXml(Marker::all());
        return view('mapClient',compact('clients'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->louerRepository->store($request->all());
        $idFace = $request->input('idFace');
        Face::where('id', $idFace)->update(array('etat' => 1));
        return redirect('mapClient');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
