<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'username' => 
            [
                'required', 
                'string', 
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),

            ],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'phone' => [
                'required', 
                'string', 
                'regex:/^\+1[0-9]{10}$/',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'image' =>[
                'nullable', 
                'image', 
                'mimes:jpeg,jpg,png,webp,svg',
            ],
            'facebook' =>[
                'nullable',
                'url',
                'regex:/^https?:\/\/(www\.)?facebook\.com\/[A-Za-z0-9.\-_]+$/',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'twitter' =>[
                'nullable',
                'url',
                'regex:/^https?:\/\/(www\.)?twitter\.com\/([A-Za-z0-9_]{1,15})$/',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'linkedin' =>[
                'nullable',
                'url',
                'regex:/^https?:\/\/(www\.)?linkedin\.com\/(in|company)\/[A-Za-z0-9\-_]+\/?$/',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'mail' =>[
                'nullable',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'website' =>[
                'nullable',
                'url',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'fax' => [
                'nullable',
                'string',
                'regex:/^\+?[0-9\s\-\(\)]{7,20}$/',
            ],            


        ];
    }

    public function messages(): array
    {
        return [

            'facebook.regex' => 'Please enter a valid facebook link',
            'twitter.regex' => 'Please enter a valid twitter link',
            'linkedin.regex' => 'Please enter a valid linkedin link',
        ];
    }
}
