<?php

namespace App\Repositories;

use App\Louer;

class LouerHistRepository
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
		return $this->louer->where('etat','=', 0)->get();
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

}