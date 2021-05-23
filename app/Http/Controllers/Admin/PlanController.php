<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdatePlan;


class PlanController extends Controller
{
    private $repository;

    public function __construct(Plan $plan)
    {
        $this->repository = $plan;
    }

    public function index(){
        $plans = $this->repository->paginate();

        return view('admin.pages.plans.index',['plans' => $plans]);
    }

    public function show($url){
        // uso where prq find só pesquisa pelo id       
        $plan = $this->repository->where('url',$url)->first();

        if(!$plan) {
            //vou retornar para a página anterior com o back()
            return redirect()->back();
        }

        return view('admin.pages.plans.show',['plan' => $plan]);

    }

    public function create() {
       

        return view('admin.pages.plans.create');
    }

     public function store(StoreUpdatePlan $request) {

      
       $this->repository->create($request->all());

       return redirect()->route('plans.index');
       
    }

    public function edit($url){

         $plan = $this->repository->where('url',$url)->first();

          if(!$plan) {
            //vou retornar para a página anterior com o back()
            return redirect()->back();
        }


        return view('admin.pages.plans.edit', ['plan' => $plan]);

    }

    public function update(StoreUpdatePlan $request, $url){


         $plan = $this->repository->where('url',$url)->first();

          if(!$plan) {
            //vou retornar para a página anterior com o back()
            return redirect()->back();
        }

       $plan->update($request->all());

       return redirect()->route('plans.index');
       
    }

    public function destroy($url) {
       
          // uso where prq find só pesquisa pelo id       
        $plan = $this->repository->where('url',$url)->first();

        if(!$plan) {
            //vou retornar para a página anterior com o back()
            return redirect()->back();
        }

        $plan->delete();

        return redirect()->route('plans.index');


    }

    public function search(Request $request){

        //vai mandar tudo de request, menos o token
        $searchs = $request->except('_token');

        $plans = $this->repository->search($request->search);

        return view('admin.pages.plans.index',['plans' => $plans, 'searchs' => $searchs]);

    }
}
