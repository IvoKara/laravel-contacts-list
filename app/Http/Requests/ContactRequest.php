<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContactRequest extends FormRequest
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
        // if (request()->routeIs('contacts.create')) 
        $unique = Rule::unique('contacts');

        if (request()->routeIs('contacts.update')) {
            $unique = $unique->ignore(request()->get('id'));
        }

        $phone_regex = "/^([0-9\s\.\-\+\(\)]*)$/";

        return [
            // TODO: this should be split into two separate alpha field
            "name" => ['required', 'string', 'min:3', 'max:255'],
            "nickname" => ['required', 'alpha_dash', 'min:3', 'max:255', $unique],
            "email" => ['required', 'email', $unique],
            "phone" => ['required', "regex:$phone_regex", 'min:10', $unique],
            "group_id" => ['nullable', 'integer']
        ];
    }
}
