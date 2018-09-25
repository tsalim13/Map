<?php

namespace App\Http\Controllers;

use App\Repositories\ClientRepository;
use Illuminate\Http\Request;
use Validator;


class ClientsController extends Controller
{
    protected $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public function index()
    {
        $clients = $this->clientRepository->index();
        return view('clients',compact('clients'));
    }

    public function create()
    {
        return view('createClient');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required|max:150|unique:clients,name',
            'email'=>'required_without_all:tel||email|max:150|unique:clients,email',
            'tel'=>'required_without_all:email|numeric|nullable|unique:clients,tel',
            'adresse'=>'nullable',
        ]);

        if ($validator->fails()) {
            return redirect('client-edit/create')
                        ->withErrors($validator)
                        ->withInput();
        }
        $this->clientRepository->store($request->all());
        return redirect('client-edit');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $client = $this->clientRepository->getById($id);
        return view('editClient',  compact('client'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required|max:150|unique:clients,name,'.$id,
            'email'=>'required_without_all:tel||email|max:150|unique:clients,email,'.$id,
            'tel'=>'required_without_all:email|numeric|nullable|unique:clients,tel,'.$id,
            'adresse'=>'nullable',
        ]);

        if ($validator->fails()) {
            return redirect('client-edit/'.$id.'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }
        $this->clientRepository->update($id, $request->all());
        return redirect('client-edit');
    }

    public function destroy($id)
    {
        $this->clientRepository->destroy($id);
        return redirect('client-edit');
    }
}
