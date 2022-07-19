<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Backend\{Crud};
use App\Traits\{GlobalMethod,Slug};

use App\Models\Alpha\Utilisateur;
use DB;

class CrudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use GlobalMethod,Slug;
    public function index()
    {
        //
        // $data= Crud::select('name','slug','description','price','created_at')->paginate(4);
        // return $this->apiData($data);

        $data  = Crud::orderBy('id','desc')->get();
        return $this->apiData(['data'   =>  $data]);

      

    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $request->validate([
            'name' => 'required',
            'price' => 'required'
        ]);

        $stringToSlug=substr($request->name,0,16).'-'.$this->generateOpt(8);
        $slug =$this->makeSlug($stringToSlug);

        $data = Crud::create([
            'name'          =>  $request->name,
            'price'         =>  $request->price,
            'description'   =>  $request->description,
            'slug'          =>  $slug
        ]);



        return $this->msgJson('Information ajoutée avec succès');

       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data= Crud::select('cruds.id','cruds.name','cruds.slug','cruds.description','cruds.price','cruds.created_at')->where('cruds.id', $id)->get();
        return response()->json([
            'data'  =>  $data
        ]);
    }

  

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $stringToSlug=substr($request->name,0,16).'-'.$this->generateOpt(8);
        $slug =$this->makeSlug($stringToSlug);

        $data = Crud::where('id', $id)->update([
            'name'          =>  $request->name,
            'price'         =>  $request->price,
            'description'   =>  $request->description,
            'slug'          =>  $slug
        ]);

        
        
        return $this->msgJson('Mise à jour d\'information ajoutée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $data = Crud::where('id',$id)->delete();
        return $this->msgJson('suppression avec succès');
    }

    /**
     * Search for a name
     *
     * @param  str  $name
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        

        if (!is_null($request->get('query'))) {
            # code...
            $query = $this->Gquery($request);
            $data = Crud::select('cruds.id','cruds.name','cruds.slug','cruds.description','cruds.price','cruds.created_at')
            ->where('cruds.name', 'like', '%'.$query.'%')
            ->orWhere('cruds.price', 'like', '%'.$query.'%')
            ->orderBy("cruds.id", "desc")
            ->get();

            return $this->apiData(['data'   =>  $data]);
           

        }

        $data = Crud::select('cruds.id','cruds.name','cruds.slug','cruds.description','cruds.price','cruds.created_at')->orderBy('id','desc')->get();
        return $this->apiData(['data'   =>  $data]);
        
    }

    function fetch_utilisateur()
    {
        //pour envoyer avec filtrage d'ordre
        $data = Utilisateur::orderBy('id', 'desc')->get();

        // pour renvoyer toutes les données
        // $data = Utilisateur::all();


        // pour la paginaltion
        // $data = Utilisateur::orderBy('id', 'desc')->paginate(2);
        return response()->json([
            'nom'   =>  'patrona',
            'data'  =>  $data,
        ]);
    }

    function insert_utilisateur(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required'
        ]);
        $data = Utilisateur::create([
            'nom'       =>  $request->nom,
            'prenom'    =>  $request->prenom,
            'age'       =>  $request->age,
            'date_nais' =>  $request->date_nais,
            'sexe'      =>  $request->sexe,
        ]);
        return response()->json([
            'data'  =>  "Insertion avec succès!!!",
        ]);
    }

    function update_utilisateur(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required'
        ]);
        $data = Utilisateur::where('id', $id)->update([
            'nom'       =>  $request->nom,
            'prenom'    =>  $request->prenom,
            'age'       =>  $request->age,
            'date_nais' =>  $request->date_nais,
            'sexe'      =>  $request->sexe,
        ]);
        return response()->json([
            'data'  =>  "Modification  avec succès!!!",
        ]);
    }

    function delete_utilisateur($id)
    {
        $data = Utilisateur::where('id',$id)->delete();
        return $this->msgJson('suppression avec succès');
    }

    function search_utilisateur(Request $request)
    {
        

        if (!is_null($request->get('query'))) {
            # code...
            $query = $this->Gquery($request);
            $data = Utilisateur::where('nom', 'like', '%'.$query.'%')
            ->orWhere('prenom', 'like', '%'.$query.'%')
            ->orderBy("id", "desc")
            ->get();

            return $this->apiData(['data'   =>  $data]);
           

        }

        $data = Utilisateur::orderBy('id','desc')->get();
        return $this->apiData(['data'   =>  $data]);
        
    }



}
