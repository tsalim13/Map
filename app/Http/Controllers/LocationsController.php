<?php

namespace App\Http\Controllers;

use App\Repositories\ClientRepository;
use App\Repositories\LouerRepository;
use App\Repositories\MarkerRepository;
use App\Repositories\FaceRepository;

use Illuminate\Http\Request;

use Illuminate\Support\Collection;

use App\Marker;
use App\Louer;
use App\Client;
use App\Face;

use Carbon\Carbon;

class LocationsController extends Controller
{
    protected $clientRepository;
    protected $louerRepository;
    protected $markerRepository;
    protected $faceRepository;
    
    public function __construct(ClientRepository $clientRepository, LouerRepository $louerRepository, MarkerRepository $markerRepository, FaceRepository $faceRepository)
    {
        $this->clientRepository = $clientRepository;
        $this->louerRepository = $louerRepository;
        $this->markerRepository = $markerRepository;
        $this->faceRepository = $faceRepository;
    }
    public function locationListe()
    {
    	$locations = collect([]);
    	$louers = $this->louerRepository->index();
    	if($louers->isNotEmpty())
    	{
	        foreach ($louers as $louer) 
            {
                $marker =new Marker();
                $marker->name = '-----';
                $marker->adrReg = '-----';
	        	if($louer->client_id != null )
	        	{
                    $client = $this->clientRepository->getById($louer->client_id);
	        		if($client == null){ $client=new Client; $client->name='-----';}
	        	}

	        	if($louer->face_id != null )
	        	{
                    $face = $this->faceRepository->getById($louer->face_id);
                    if($face != null)
                    {
                        $marker = $this->markerRepository->getById($face->id_emplacement);
                        if($marker == null){$marker =new Marker();
                                            $marker->name = '-----';
                                            $marker->adrReg = '-----';
                                           }
                    }
                    else{
                        $face = new Face(); $face->codif= '-----';
                        $marker =new Marker();
                            $marker->name = '-----';
                            $marker->adrReg = '-----';
                    }
                }

                $now = Carbon::now();
                $dt = $louer->toDate;
                $dtt =Carbon::parse($dt);
                $diff = $now->diffInDays($dtt->addDay(),false);

	        	$loca = collect(['client' => $client->name, 
                                 'marker' => $marker->name,
                                 'adrReg' => $marker->adrReg,
                                 'type' => $face['codif'],
                                 'debut' => $louer->fromDate, 
                                 'fin' => $louer->toDate,
                                 'dif' => $diff,
                                 'id' => $louer->id
                               ]);
	        	$locations->push($loca);
	        }
	    }
        return view('listeLocations',compact('locations'));
    }
}
