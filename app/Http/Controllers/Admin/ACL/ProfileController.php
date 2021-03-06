<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Requests\StoreUpdateProfile;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;

class ProfileController extends Controller
{
    protected $repository;


    public function __construct(Profile $profile)
    {
        $this->repository = $profile;
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profiles = $this->repository->paginate();

        return view('admin.pages.profiles.index', ['profiles' => $profiles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.profiles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreUpdateProfile  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateProfile  $request)
    {
             
        $this->repository->create($request->except('_token'));

        return redirect()->route('profiles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profile = $this->repository->find($id);

        if(!$profile) {
            return redirect()->back();
        }

         return view('admin.pages.profiles.show', ['profile' => $profile]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profile = $this->repository->find($id);

        if(!$profile) {
            return redirect()->back();
        }

        return view('admin.pages.profiles.edit', ['profile' => $profile]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\StoreUpdateProfile  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateProfile $request, $id)
    {
        $profile = $this->repository->find($id);

        if(!$profile) {
            return redirect()->back();
        }

        $profile->update($request->all());

        return redirect()->route('profiles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $profile = $this->repository->find($id);

        if(!$profile) {
            return redirect()->back();
        }
         $profile->delete();

        return redirect()->route('profiles.index');
    }

    /**
     * Search
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {

        $searchs = $request->only('search');
        // usei use para eu consegui acessar $request dentro da fun????o e sem isso n??o vai funcionar
         $profiles = $this->repository->where(function($query) use ($request){
            if($request->search) {
                $query->where('name', 'LIKE', "%{$request->search}%")->orWhere('description', 'LIKE', "%{$request->search}%");
                //uso o like para ver se a informa????o est?? contida na cadeia de caracteres
            }           

         })->paginate();

         //passo esse search para a pagina????o funcionar
        return view('admin.pages.profiles.index', ['profiles' => $profiles,'searchs' => $searchs]); 

        }
}
