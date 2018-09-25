<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gestion\PhotoGestion;
use App\Photo;

class PhotoController extends Controller
{
    /*protected $photogestion;
    public function __construct(PhotoGestion $photogestion)
    {
        $this->photogestion = $photogestion;
    }*/
   /* protected $photo;
    public function __construct(Photo $photo)
    {
        $this->photo = $photo;
    }*/
	
    public function store(Request $request)
    {
    	/*$id = $request->input('id_empl_photo');
    	$this->photogestion->save_photo($request->file('image'),$id);*/

        if ($request->hasFile('image')) {
            $idd =$request->input('id_empl_photo');
            $photo = new Photo();

            $image = $request->file('image');
            $name = $idd.'_'.str_random(14).'.'.$image->getClientOriginalExtension();
            $destinationPath = config('images.path');

            $imagePath = $destinationPath. "/".  $name;
            $image->move($destinationPath, $name);

            $photo->id_emplacement = $idd;
            $photo->title = $name;
            $photo->save();
            $photo = null ;
            return $name;
        }

            return 1;
    }
}
