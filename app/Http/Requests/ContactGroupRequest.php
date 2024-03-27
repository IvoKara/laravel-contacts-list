<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContactGroupRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $unique = Rule::unique('contacts_groups');

        if (request()->routeIs('contacts-groups.update')) {
            $unique = $unique->ignore(request()->route('group')->id);
        }
        return [
            "name" => ['required', 'min:3', 'max:255', 'string', $unique],
            "contacts" => 'sometimes|required|array'
        ];
    }
}
