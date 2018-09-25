<?php

namespace App\Http\Controllers;
use App\Repositories\FaceRepository;
use App\Repositories\MarkerRepository;
use Illuminate\Http\Request;
use Response;

class facesController extends Controller
{
	protected $faceRepository;
	protected $markerRepository;

    public function __construct(FaceRepository $faceRepository, MarkerRepository $markerRepository)
    {
        $this->faceRepository = $faceRepository;
        $this->markerRepository = $markerRepository;
    }

    public function store(Request $request)
    {
        $faces = $this->faceRepository->store($request->all());
        return Response::json(['success' => '1','faces' =>  $faces]);
    }

    public function update(Request $request, $id)
    {
        $this->faceRepository->update($id, $request->all());
        
        return redirect('MarkerList');
    }
    public function destroy($id)
    {
        $this->faceRepository->destroy($id);
    }
}
