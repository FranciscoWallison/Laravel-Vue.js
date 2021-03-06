<?php

namespace SisFin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
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
        $client = Auth::guard('api')->user()->client;

        return [
            'name' => 'required|max:255',
            'parent_id' => Rule::exists($this->getTable(), 'id')
                ->where(function ($query) use ($client) {
                    $query->where('client_id', $client->id);
                })
        ];
    }

    protected function getTable()
    {
        $currentAction = \Route::currentRouteAction();
        list($controller) = explode('@', $currentAction);
        return str_is("$controller*", \SisFin\Http\Controllers\Api\CategoryRevenuesController::class)
            ? "category_revenues" : "category_expenses";
    }
}
