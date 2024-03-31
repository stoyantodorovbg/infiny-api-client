<?php

namespace App\Http\Requests;

use App\Models\Enum\ClientEnvironment;
use App\Rules\ClientNameUnique;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:20',
                new ClientNameUnique($this->user(), $this->client, $this->method()),
            ],
            'environment' => [
                'required',
                'string',
                'in:' . implode(',', array_column(ClientEnvironment::cases(), 'value')),
            ],
            'client_id' => [
                'required',
                'string',
                'max:255',
            ],
            'client_secret' => [
                'required',
                'string',
                'max:255',
            ],
        ];
    }
}
