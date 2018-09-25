<?php

namespace App\Repositories;

use App\Face;

class FaceRepository
{
    protected $face;

    public function __construct(Face $face)
	{
		$this->face = $face;
	}
	private function save(Array $inputs)
	{
		$collection = collect([]);
		$id_emplc = $inputs['id_emplacement'];
		$nbr = $inputs['nbr'];
		for ($i=1; $i <= $nbr ; $i++) 
		{
			$face = new $this->face;
			$support = 'id_support'.$i;
			$codiff = 'codif'.$i;
			$tarif = 'tarif'.$i;
			$face->id_emplacement = $id_emplc;
			$face->id_support = $inputs[$support];
			$face->codif = $inputs[$codiff];
			$face->etat = 0;
			$face->tarif_unite = $inputs[$tarif];
			$face->save();

			$data=['id' => $face->id,
				   'codif' => $face->codif
				  ];
			$collection->push($data);
		}
		return $collection;
	}
	private function save_u(Face $face,Array $inputs)
	{
		$face->id_support = $inputs['support'];
		$face->save();
	}
	public function index()
	{
		return $this->face->all();
	}
	public function store(Array $inputs)
	{		
		$collec = $this->save($inputs);
		return $collec;
	}
	public function getById($id)
	{
		return $this->face->find($id);
	}
	public function update($id, Array $inputs)
	{
		$this->save_u($this->getById($id), $inputs);
	}
	public function destroy($id)
	{
		$this->getById($id)->delete();
	}
}