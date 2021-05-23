<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plan extends Model
{
    protected $fillable = ["name",'url', 'price', 'description'];

    public function details(){

        //nao precisei importar detailplan prq ele já está na mesma pasta que plan
        return $this->hasMany(DetailPlan::class);
    }

    public function search($search = null){

        $results = $this
                    ->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%")
                    ->paginate();

        return $results;

    }


}
