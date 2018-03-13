<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ApiKeyValidator 
 * ---- 
 * Class voor de validatie tijdens het creeren van een nieuwe API token 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 * @package     App\Http\Requests\Backend
 */
class ApiKeyValidator extends FormRequest
{
    /**
     * {@inheritDoc}
     */
    protected $redirectRoute = 'account.settings';

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
        return ['service' => 'required|string|max:191'];
    }

    /**
     * {@inheritDoc}
     */
    protected function getRedirectUrl()
    {
        return $this->redirector->getUrlGenerator()->route(
            $this->redirectRoute, ['type' => 'tokens']
        );
    }
}
