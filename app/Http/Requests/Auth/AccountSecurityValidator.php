<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

/**
 * AccountSecurityValidator
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 * @package     App\Http\Requests\Auth
 */
class AccountSecurityValidator extends FormRequest
{
    /**
     * {@inheritdoc}
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
        return ['password' => 'required|string|min:6|confirmed'];
    }

    /**
     * {@inheritdoc}
     */
    protected function getRedirectUrl()
    {
        return $this->redirector->getUrlgenerator()->route(
            $this->redirectRoute,
            ['type' => 'beveiliging']
        );
    }
}
