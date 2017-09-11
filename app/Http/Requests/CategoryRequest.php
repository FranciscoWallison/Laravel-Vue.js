<?php

namespace CodeFin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
        $client = \Auth::guard('api')->user()->client;
        return [
            //
            'name'      => 'required|max:255',
            'parent_id' => Rule::exists($this->getTable(), 'id')
                ->where(function($query) use($client){
                    $query->where('client_id', $client->id);
            })
        ];
    }

    protected function getTable(){
        //pegando o controller que esta sendo acessado 
        $currentAction = \Route::currentRouteAction();
        list($controller) = explde('@', $currentAction); // pegando cntroller

        //consutando a tabela
        return str_is("$controller*", CategoryRevenuesController::class)
            ? "category_revenues" : "category_expenses";
    }
}
