<?php
namespace App\Http\Controllers;
use App\Gestion\DataXmlGestion;
use App\Repositories\MarkerRepository;
use App\Repositories\TypeRepository;
use App\Repositories\SupportRepository;
use App\Repositories\HoraireRepository;
use Illuminate\Http\Request;
use Response;

class MarkersController extends Controller
{
    protected $markerRepository;
    protected $typeRepository;
    protected $supportRepository;
    protected $dataXmlGestion;
    protected $horaireRepository;
    public function __construct(MarkerRepository $markerRepository,DataXmlGestion $dataXmlGestion, TypeRepository $typeRepository, SupportRepository $supportRepository, HoraireRepository $horaireRepository)
    {
        $this->markerRepository = $markerRepository;
        $this->typeRepository = $typeRepository;
        $this->supportRepository = $supportRepository;
        $this->dataXmlGestion = $dataXmlGestion;
        $this->horaireRepository = $horaireRepository;
    }
    public function index()
    {
        $markers = $this->markerRepository->index();
        $types = $this->typeRepository->index();
        $supports = $this->supportRepository->index();
        $horaires = $this->horaireRepository->index();
        $this->dataXmlGestion->generateXml($markers);

        return view('mapEdit',compact('markers', 'types', 'supports', 'horaires'));
    }
    /*public function create()
    {
        return view('create');
    }*/
    public function store(Request $request)
    {
        $marker = $this->markerRepository->store($request->all());
       return Response::json(['success' => '1','last_id' =>  $marker->id]);
        //return redirect('edit');
    }
    public function show($id)
    {
        $marker = $this->markerRepository->getById($id);
        return view('mapEdit');
    }
    /*public function edit($id)
    {
        $user = $this->userRepository->getById($id);

        return view('edit',  compact('user'));
    }*/
    /*public function update(UserUpdateRequest $request, $id)
    {
        $this->userRepository->update($id, $request->all());
        
        return redirect('user')->withOk("L'utilisateur " . $request->input('name') . " a été modifié.");
    }*/
    public function destroy($id)
    {
        $this->markerRepository->destroy($id);
    }
}