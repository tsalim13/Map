<?php 
namespace App\Gestion;
use App\Repositories\MarkerRepository;
use App\Marker;
use App\Type;
use App\Photo;
use Storage;
class DataXmlGestion
{
protected $markerRepository;
   public function __construct(Marker $markers, Type $type, Photo $photo)
    {
        $this->markers = $markers;
        $this->type = $type;
        $this->photo = $photo;
    }
	 public function generateXml($markers)
   {
      $xml = new \XMLWriter();
      $xml->openMemory();
      $xml->setIndent(true);
      $encoding   = 'UTF-8';
      
    // Start a new document
      $xml->startDocument('1.0', $encoding);
    // Start a element to put data in
      $xml->startElement('markers');
    // Data what goes in your element\
      foreach ($markers as $marker) {
        $xml->startElement('marker');
        $xml->writeAttribute('id', $marker->id);
        $xml->writeAttribute('name', $marker->name);
        $xml->writeAttribute('adrReg', $marker->adrReg);
        $xml->writeAttribute('lat', $marker->lat);
        $xml->writeAttribute('lng', $marker->lng);

        $type_name = $this->type->select('intitule')
                                ->where('id',$marker->type_id)
                                ->first();
        if(empty($type_name)){$type_name= new Type; $type_name->intitule='';}

        $xml->writeAttribute('type', $type_name->intitule);
        $xml->writeAttribute('etat', $marker->etat);

        $photo_titre = $this->photo->select('title')
                                ->where('id_emplacement',$marker->id)
                                ->first();
        if(empty($photo_titre)){$photo_titre = new Photo; $photo_titre->title='';}
        $xml->writeAttribute('photo', $photo_titre->title);

        $xml->endElement();
      }
      $xml->endElement();
      $xml->endDocument();
    // You put the XML content in this variable
       $contents = $xml->outputMemory();
    // Reset XML just in case
        $xml = null;
      Storage::disk('public_uploads_data')->put('data.xml', $contents);
	}
}