<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DetailPlan;
use App\Models\Plan;

class DetailPlanController extends Controller
{

    protected $repository, $plan;

    public function __construct(DetailPlan $detailPlan, Plan $plan)
    {
        $this->repository = $detailPlan;
        $this->plan = $plan;
    }

    public function index($url){       

       $plan = $this->plan->where('url', $url)->first();

       if (!$plan){
           return redirect()->back();
       }
 
       $details = $plan->details()->paginate();
      

       return view('admin.pages.plans.details.index', ['plan'=> $plan, 'details'=> $details]);

    }
}
