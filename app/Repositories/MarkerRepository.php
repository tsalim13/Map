<?php

namespace App\Repositories;

use App\Marker;

class MarkerRepository
{
    protected $marker;

    public function __construct(Marker $marker)
	{
		$this->marker = $marker;
	}
	private function save(Marker $marker, Array $inputs)
	{
		$marker->name = $inputs['nom'];
		$marker->adrReg = $inputs['adrReg'];
		$marker->wilaya = $inputs['wilaya'];
		$marker->lat = $inputs['lat'];
		$marker->lng = $inputs['lng'];
		$marker->type_id = $inputs['type'];
		$marker->etat = $inputs['etat'];

		$marker->save();
	}
	public function index()
	{
		return $this->marker->all();
	}
	public function store(Array $inputs)
	{
		$marker = new $this->marker;		
		$this->save($marker, $inputs);
		return $marker;
	}
	public function getById($id)
	{
		return $this->marker->find($id);
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