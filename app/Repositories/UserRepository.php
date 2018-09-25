<?php

namespace App\Repositories;

use App\User;
use Illuminate\Support\Facades\Hash;
class UserRepository
{

    protected $user;

    public function __construct(User $user)
	{
		$this->user = $user;
	}

	private function save(User $user, Array $inputs)
	{
		$user->name = $inputs['name'];
		$user->email = $inputs['email'];
		$user->tel = $inputs['tel'];
		$user->password = Hash::make($inputs['password']);
		$user->role = $inputs['role'];

		$user->save();
	}

	private function saveUp(User $user, Array $inputs)
	{
		$user->name = $inputs['name'];
		$user->email = $inputs['email'];
		$user->tel = $inputs['tel'];
		$user->role = $inputs['role'];

		$user->save();
	}

	public function index()
	{
		return $this->user->all();
	}

	public function store(Array $inputs)
	{
		$user = new $this->user;		

		$this->save($user, $inputs);

		return $user;
	}

	public function getById($id)
	{
		return $this->user->findOrFail($id);
	}

	public function update($id, Array $inputs)
	{
		$this->saveUp($this->getById($id), $inputs);
	}

	public function destroy($id)
	{
		$this->getById($id)->delete();
	}

}