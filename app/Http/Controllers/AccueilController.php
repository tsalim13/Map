<?php

namespace App\Http\Controllers;

use App\Repositories\LouerRepository;
use Illuminate\Http\Request;
use App\Face;

use Carbon\Carbon;

class AccueilController extends Controller
{
	protected $louerRepository;

	public function __construct(LouerRepository $louerRepository)
	{
		$this->louerRepository = $louerRepository;
	}
    
    public function index()
    {
    	$co = $this->louerRepository->countByClient();
        $co_act = $this->louerRepository->countByClientAct();
        return view('accueil',compact('co','co_act'));
    }


    /*public function locationsByclient()
    {
    	$louers = $this->louerRepository->index();
    	if($louers->isNotEmpty())
    	{
    		foreach ($louers as $louer) 
            {
            	$now = Carbon::now();
                $dt = $louer->toDate;
                $diff = $now->diffInDays($dt, false);

                if($diff < 0)
                {
                	$louer->etat = 0;
                	$louer->save();

                	$face= Face::find($louer->face_id);
                	$face->etat = 0;
                	$face->save();

                }
            }
    	}

    }*/

}
