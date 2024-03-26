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
        // $sometimes = request()->routeIs('contacts.store') || request()->method() === "PUT" ? 'sometimes' : ''

        $required = Rule::requiredIf(
            request()->routeIs('contacts.store') || request()->method() === "PUT"
        );

        $unique = Rule::unique('contacts');

        if (request()->routeIs('contacts.update')) {
            $unique = $unique->ignore(request()->route('contact')->id);
        }

        $phone_regex = "/^([0-9\s\.\-\+\(\)]*)$/";

        return [
            // TODO: this should be split into two separate alpha field
            "name" => [$required, 'min:3', 'max:255', 'string'],
            "nickname" => [$required, 'min:3', 'max:255', 'alpha_dash', $unique],
            "email" => [$required, 'email', $unique],
            "phone" => [$required, 'min:10', "regex:$phone_regex", $unique],
            "group_id" => ['nullable', 'integer']
        ];
    }
}
