<?php

namespace App\Repositories;

use App\Louer;
use App\Client;

class LouerRepository
{

    protected $louer;

    public function __construct(Louer $louer)
	{
		$this->louer = $louer;
	}

	private function save(Louer $louer, Array $inputs)
	{
		$louer->client_id = $inputs['idClient'];
		$louer->face_id = $inputs['idFace'];
		$louer->fromDate = $inputs['dateDebut'];
		$louer->toDate = $inputs['dateFin'];
		$louer->etat = 1;

		$louer->save();
	}

	public function index()
	{
		return $this->louer->where('etat','=', 1)->get();
	}

	public function store(Array $inputs)
	{
		$louer = new $this->louer;		
		$this->save($louer, $inputs);
		return $louer;
	}

	public function getById($id)
	{
		return $this->marker->findOrFail($id);
	}

	public function update($id, Array $inputs)
	{
		$this->save($this->getById($id), $inputs);
	}

	public function destroy($id)
	{
		$this->getById($id)->delete();
	}

	public function countByClient()
	{
               return \DB::table('louers')
				  ->select('client_id', \DB::raw('count(*) as total'))
				  ->groupBy('client_id')
				  ->get();
	}
	public function countByClientAct()
	{
               return \DB::table('louers')
				  ->select('client_id', \DB::raw('count(*) as total'))
				  ->where('etat',1)
				  ->groupBy('client_id')
				  ->get();
	}

}