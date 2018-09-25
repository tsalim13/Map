<?php
namespace App\Gestion;
use Illuminate\Support\Collection;
use App\Client;
use App\Louer;
class ActionMarkerGestion
{   //appeler dans le script api-map
	protected $marker;
	protected $louer;
    public function __construct(Client $client,Louer $louer)
	{
		$this->client = $client;
		$this->louer = $louer;
	}
	public function find($id)
    {
        $louer = $this->louer->where('marker_id', $id)
                             ->where(function ($query) {
                                 $query->where('etat', '=', 1); })
                             ->first();
        if($louer != null)
        {
        	$client = $this->client->find($louer->client_id);
        	$collection = collect(['client' => $client->name, 'toDate' => $louer->toDate]);
        	return $collection;
        }
        return "no";
    }
}