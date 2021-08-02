<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdatePermission extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //criar execeção para eu poder enviar o mesmo nome do perfil quando for atualizar alguma permissão

        //Pegando o segmento, ou seja, o campo id
        //http://127.0.0.1:8000/admin/plans/plano-normal
        // admin = segmento 1
        //plans = segmento 2
        //plano-normal 3       
        // é contado assim

        $id = $this->segment(3);

        //abra uma exceção para eu salvar o nome do permissão atual que é o mesmo que está no banco
        //OBS: NAO DEIXE ESPAÇOS APÓS A VÍRGULA, SENAO DÁ MERDA

        return [
            'name' => "required|min:3|max:255|unique:permissions,name,{$id},id",
            'description' => 'nullable|min:3|max:255',
        ];
    }
}
