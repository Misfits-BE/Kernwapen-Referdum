<?php

namespace App\Http\Requests\Shared;

use Illuminate\Foundation\Http\FormRequest;

/**
 * SignatureValidator
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 * @package     \App\Http\Requests\Shared
 */
class SignatureValidator extends FormRequest
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
            'voornaam'      => 'required|string|max:50',
            'achternaam'    => 'required|string|max:50',
            'geboortedatum' => 'required|max:12',
            'postcode'      => 'required|max:4',
            'straatnaam'    => 'required|string|max:125',
            'stadsnaam'     => 'required|max:100',
            'huis_nr'       => 'required|max:7'
        ];
    }
}
