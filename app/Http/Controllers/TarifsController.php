<?php

namespace App\Http\Controllers;
use App\Repositories\TarifRepository;
use Illuminate\Http\Request;
use Response;

class TarifsController extends Controller
{
	protected $tarifRepository;

    public function __construct(TarifRepository $tarifRepository)
    {
        $this->tarifRepository = $tarifRepository;
    }

    public function store(Request $request)
    {
        $face = $this->tarifRepository->store($request->all());
    }

    public function update(Request $request, $id)
    {
        $this->tarifRepository->update($id, $request->all());
        
        //return redirect('MarkerList');
    }
}
