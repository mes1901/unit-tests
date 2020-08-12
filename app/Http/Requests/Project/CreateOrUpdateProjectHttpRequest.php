<?php

declare(strict_types=1);

namespace App\Http\Requests\Project;

use App\Http\Requests\ApiFormRequest;

class CreateOrUpdateProjectHttpRequest extends ApiFormRequest
{
    public function getName(): string
    {
        return $this->get('name');
    }

    public function getDescription(): string
    {
        return $this->get('description');
    }

    public function getStatus(): string
    {
        return $this->get('status');
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:55',
            'description' => 'required|string|max:255',
            'status' => 'required|string',
        ];
    }
}