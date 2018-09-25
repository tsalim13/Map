<?php

namespace App\Repositories;

use App\Horaire;

class HoraireRepository
{
    protected $horaire;

    public function __construct(Horaire $horaire)
	{
		$this->horaire = $horaire;
	}
	private function save(Horaire $horaire, Array $inputs)
	{
		$horaire->debut = $inputs['horDebut'];
		$horaire->fin = $inputs['horFin'];
		$horaire->save();
	}
	public function index()
	{
		return $this->horaire->orderBy('debut')->get();
		//return $this->horaire->orderBy('intitule')->get();
	}
	public function store(Array $inputs)
	{
		$horaire = new $this->horaire;		
		$this->save($horaire, $inputs);
		return $horaire;
	}
	public function getById($id)
	{
		return $this->horaire->findOrFail($id);
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