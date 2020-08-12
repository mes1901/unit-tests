<?php

declare(strict_types=1);

namespace App\Http\Requests\Client;

use App\Http\Requests\ApiFormRequest;

class CreateClientHttpRequest extends ApiFormRequest
{
    public function getFirstName(): string
    {
        return $this->get('first_name');
    }

    public function getLastName(): string
    {
        return $this->get('last_name');
    }

    public function getEmail(): string
    {
        return $this->get('email');
    }

    public function getPassword(): string
    {
        return $this->get('password');
    }

    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:55',
            'last_name' => 'required|string|max:55',
            'email' => 'required|email|unique:clients',
            'password' => 'required|min:8|string',
        ];
    }
}