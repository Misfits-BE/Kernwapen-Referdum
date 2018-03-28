<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ArticleStoreValidator 
 * ---- 
 * Validatie class voor het opslaan van een nieuwsbericht. 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 * @package     App\Http\Requests\Backend
 */
class ArticleStoreValidator extends FormRequest
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
        return [
            'titel'     => 'string|required|max:190', 
            'bericht'   => 'string|required', 
            'is_public' => 'required|boolean'
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function messages(): array
    {
        return ['is_public' => 'u moet een status opgeven voor het nieuwsbericht'];
    }
}
