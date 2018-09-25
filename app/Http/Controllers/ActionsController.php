<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Repositories\ActionRepository;
use App\Gestion\ActionMarkerGestion;
use App\Marker;
use App\Client;
use App\Louer;
use App\Face;
use App\Type;
use App\Support;
use Response;
class ActionsController extends Controller
{
	protected $grouped = null , $louer = null , $collection = null;
    protected $actionMarkerGestion;
    public function __construct(ActionMarkerGestion $actionMarkerGestion)
    {
        $this->actionMarkerGestion = $actionMarkerGestion;
    }
    public function getHistoric($id)
    {
    	$louer = Louer::select('marker_id','fromDate','toDate')
    			->where('client_id', $id)
               	->orderBy('fromDate', 'desc')
                ->get();
        if($louer->isNotEmpty())
    	{ 
    		$collection = collect([]);
    		foreach($louer as $group)
    		{
    			$mark = Marker::find($group->marker_id);
                if($mark == null){ $mark = new Marker; $mark->name = '--'; $mark->type = '--'; }
    			$coll = collect(['marker' => $mark->name, 'type' => $mark->type , 'fromDate' => $group->fromDate ,'toDate' => $group->toDate]);
    			$collection->push($coll);
    		}
    		$grouped = $collection->groupBy('fromDate');
    		return $grouped;
    	}
        return "not found";
    }
    public function getHistMarker($id)
    {   //$etatMarker = $this->actionMarkerGestion->find($id);
        $louer = Louer::select('client_id','fromDate','toDate')
                ->where('marker_id', $id)
                ->orderBy('fromDate', 'desc')
                ->get();
        if($louer->isNotEmpty())
        { 
            $collection = collect([]);
            foreach($louer as $group)
            {
                $client = Client::find($group->client_id);
                $coll = collect(['client' => $client->name , 'fromDate' => $group->fromDate ,'toDate' => $group->toDate]);
                $collection->push($coll); 
            }
            $grouped = $collection->groupBy('fromDate');
            return $grouped;
        }
        return "not found";
    }
    /*public function etatMarker($id)
    {
        $etatMarker = $this->actionMarkerGestion->find($id);
        return $etatMarker;
    }*/

    public function etatMarker($id)
    {
        $faces_emplc = Face::where('id_emplacement',$id)->orderBy('etat', 'asc')
                ->get();
        if($faces_emplc->isNotEmpty())
        {
            $collection = collect([]);
            foreach($faces_emplc as $fac)
            {
                $supp = Support::select('intitule')->where('id',$fac->id_support)->first();

                $data = ["id_face" => $fac->id, "id_emplacement" => $fac->id_emplacement, "support" => $supp->intitule , "codif" => $fac->codif, "etat" => $fac->etat];
                $collection->push($data);
            }
            return $collection;
        }//fin if
        return false;
    }//fin fct etatMarker

    public function lastFace($idType)
    {
        $id = Face::select('id')
                    ->orderBy('id', 'desc')
                    ->first();
        $type = Type::where('id',$idType)
                     ->first();

        if($id!=null)
        { 
            $data=['id'=>$id->id,
                   'unite_val'=> $type->unite_val,
                   'unite'=> $type->unite
                  ];
            return $data; 
        }
        return "0" ;
    }
}