<?php

namespace App\Http\Requests\Categories;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        /**
         * Note $this is the request object and inside $this we will get the model object of the record being inserted
         * such syntax cannot be used in create as $this->category wont exist!
         * but if your route has something else such as 
         * /student/{student}/subscription/create where we are creating subscription
         * but route has student object with it then you can access $this->student
         */
        return [
            'name'=>'required|unique:categories,name,'.$this->category->id
        ];
    }
}
