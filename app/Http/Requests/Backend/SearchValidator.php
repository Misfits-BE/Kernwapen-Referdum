<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Validatie voor de zoek opdrachten in de databank.
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 TIm Joosten
 * @package     \App\Http\Requests\Backend
 */
class SearchValidator extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return ['term' => 'max:120|required'];
    }
}
