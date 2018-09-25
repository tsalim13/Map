<?php 

namespace App\Gestion;
use App\Photo;

class PhotoGestion
{
	protected $photo;

    public function __construct(Photo $photo)
	{
		$this->photo = $photo;
	}

   public function save_photo($image,$id)
	{
		if($image->isValid())
		{
			$chemin = config('images.path');
			$extension = $image->getClientOriginalExtension();

			do {
				$nom = str_random(10) . '.' . $extension;
			} while(file_exists($chemin . '/' . $nom));

			$photo = new $this->photo;
			
			$photo->id_emplacement = $id;
			$photo->titre = $nom;
			$photo->save();
			$photo = null ;

			$image->move($chemin, $nom);
			return true;
		}

		return false;
	}

}