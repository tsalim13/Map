<?php

namespace App\Repositories;

use App\Tarif;
use App\Repositories\HoraireRepository;

class TarifRepository
{
    protected $tarif;
    protected $horaireRepository;

    public function __construct(Tarif $tarif, HoraireRepository $horaireRepository)
	{
		$this->tarif = $tarif;
        $this->horaireRepository = $horaireRepository;
	}
	private function save(Array $inputs)
	{
		$horaires = $this->horaireRepository->index();
		$nbr_face = $inputs['nbr_face'];

		for ($i=0; $i < $nbr_face ; $i++) 
		{ 
		  foreach($horaires as $horaire)
		  {
		  	$tarif = new $this->tarif;
		  	$idhh = $horaire->id;
		  	$idf = 'face'.$i;
		  	$horval = 'hor'.$idhh.$i;
			$tarif->id_face = $inputs[$idf];
			$tarif->id_horaire = $horaire->id;
			$tarif->tarif_horaire = $inputs[$horval];

			$tarif->save();
		  }
		}
	}
	public function index()
	{
		return $this->tarif->all();
		//return $this->horaire->orderBy('intitule')->get();
	}
	public function store(Array $inputs)
	{
		$this->save($inputs);
	}
	public function getById($id)
	{
		return $this->tarif->findOrFail($id);
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