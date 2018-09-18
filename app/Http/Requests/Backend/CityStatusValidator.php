<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CityStatusValidator
 * 
 * @author      Tim Joosten tim@activisme.be
 * @copyright   2018 Tim Joosten, Activisme_BE
 * @package     App\Http\Requests\Backend
 */
class CityStatusValidator extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return ['verklaring' => 'required|mimes:pdf'];
    }
}
