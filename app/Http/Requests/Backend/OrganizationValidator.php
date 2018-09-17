<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

/**
 * OrganizationValidator
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 * @package     \App\Http\Requests\Backend
 */
class OrganizationValidator extends FormRequest
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
            'link'                      => 'required|max:255',
            'name'                      => 'required|max:255',
            'verantwoordelijke_naam'    => 'required|max:255',
            'verantwoordelijke_email'   => 'required|email',
            'telefoon_nr'               => 'required|max:255',
        ];
    }
}
