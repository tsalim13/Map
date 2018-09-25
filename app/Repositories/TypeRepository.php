<?php

namespace App\Repositories;

use App\Type;

class TypeRepository
{
    protected $type;

    public function __construct(Type $type)
	{
		$this->type = $type;
	}
	private function save(Type $type, Array $inputs)
	{
		$type->intitule = $inputs['type'];
		$type->unite_val = $inputs['unite_val'];
		$type->unite = $inputs['unite'];
		$type->save();
	}
	public function index()
	{
		return $this->type->orderBy('intitule')->get();
	}
	public function store(Array $inputs)
	{
		$type = new $this->type;		
		$this->save($type, $inputs);
		return $type;
	}
	public function getById($id)
	{
		return $this->type->findOrFail($id);
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