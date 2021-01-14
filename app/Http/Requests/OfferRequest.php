<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
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
        return [
            'name_ar' => 'required|max:100|unique:offers,name_ar',
            'name_en' => 'required|max:100|unique:offers,name_en',
            'price' => 'required|numeric',
            'details_ar' => 'required',
            'details_en' => 'required',
        ];
    }

    public function messages() // it is used in laravel we make override in code of laravel that is default
    {
        return [
            'name.required' => trans('messages.offer name required'), // __ equal to trans
            'name.unique' => __('messages.offer name must be unique'),
            //'name.max:100' => __('message.name max is 100'),
            'price.numeric' => __('messages.offer price must be numiric'),
            'price.required' => __('messages.offer price required'),
            'details.required' => __('messages.offer details required'),
        ];
    }

    // he make redirect out of the box
}
