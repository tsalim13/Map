<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Validator;

class UsersController extends Controller
{
    protected $userRepository;

    public $rules=array(
        'password'=>'required|min:6|confirmed',
        'name'=>'required',
        'email'=>'required',
        'role'=>'required',
        'tel'=>'numeric'
    );

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = $this->userRepository->index();
        return view('users',compact('users'));
    }

    public function create()
    {
        return view('createUser');
    }

    public function store(Request $request)
    {
    	$validator = Validator::make($request->all(), [
   	        'name'=>'required|max:150',
	        'email'=>'required|email|max:150|unique:users,email',
	        'tel'=>'numeric|nullable|unique:users,tel',
	        'role'=>'required',
	        'password'=>'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect('user-edit/create')
                        ->withErrors($validator)
                        ->withInput();
        }
        $this->userRepository->store($request->all());
        return redirect('user-edit');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $user = $this->userRepository->getById($id);
        return view('editUser',  compact('user'));
    }

    public function update(Request $request, $id)
    {
    	$validator = Validator::make($request->all(), [
   	        'name'=>'required|max:150',
	        'email'=>'required|email|max:150|unique:users,email,'.$id,
	        'tel'=>'numeric|nullable|unique:users,tel,'.$id,
	        'role'=>'required',
        ]);

        if ($validator->fails()) {
            return redirect('user-edit/'.$id.'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }
        $this->userRepository->update($id, $request->all());
        return redirect('user-edit');
    }

    public function destroy($id)
    {
        $this->userRepository->destroy($id);
        return redirect('user-edit');
    }
}
