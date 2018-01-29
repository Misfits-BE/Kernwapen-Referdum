<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

/**
 * NotitionValidator 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten 
 * @package     \App\Http\Requests\Backend
 */
class NotitionValidator extends FormRequest
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
        return [
            'titel'         => 'required|string|max:255',
            'status'        => 'required|numeric|max:1',
            'beschrijving'  => 'required|string'
        ];
    }
}
