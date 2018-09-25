<?php

namespace App\Repositories;

use App\Client;

class ClientRepository
{

    protected $client;

    public function __construct(Client $client)
	{
		$this->client = $client;
	}

	private function save(Client $client, Array $inputs)
	{
		$client->name = $inputs['name'];
		$client->email = $inputs['email'];
		$client->tel = $inputs['tel'];
		$client->adresse = $inputs['adresse'];

		$client->save();
	}

	public function index()
	{
		return $this->client->all();
	}

	public function store(Array $inputs)
	{
		$client = new $this->client;		

		$this->save($client, $inputs);

		return $client;
	}

	public function getById($id)
	{
		return $this->client->findOrFail($id);
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