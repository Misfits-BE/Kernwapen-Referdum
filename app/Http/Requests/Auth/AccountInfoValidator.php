<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class AccountInfoValidator extends FormRequest
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
            'name'  => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . auth()->user()->id,
        ];
    }

    /**
     * {@inheritDoc}
     */
    protected function getRedirectUrl()
    {
        return $this->redirector->getUrlGenerator()->route(
            $this->redirectRoute,
            ['type' => 'informatie']
        );
    }
}
