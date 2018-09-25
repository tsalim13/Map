<?php

namespace App\Repositories;

use App\Support;

class SupportRepository
{
    protected $support;

    public function __construct(Support $support)
	{
		$this->support = $support;
	}
	private function save(Support $support, Array $inputs)
	{
		$support->intitule = $inputs['support'];
		$support->save();
	}
	public function index()
	{
		return $this->support->all();
		//return $this->support->orderBy('intitule')->get();
	}
	public function store(Array $inputs)
	{
		$support = new $this->support;		
		$this->save($support, $inputs);
		return $support;
	}
	public function getById($id)
	{
		return $this->support->findOrFail($id);
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