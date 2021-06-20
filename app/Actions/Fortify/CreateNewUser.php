<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'max:25', 'min:4', 'unique:users'],
            'password' => $this->passwordRules(),
            'profession' => ['required', 'max:100'],
            'profession_other' => ['required_if:profession,Other', 'max:100'],
            'gender' => ['required', 'in:Male,Female,Transgender,Other',],
            'address' => ['nullable', 'max:100',],
            'city' => ['nullable', 'max:100',],
            'state' => ['nullable', 'max:100',],
            'area' => ['nullable'],
            'professional_email' => ['nullable', 'email'],
            'contact' => ['nullable', 'digits:10'],
            'whatsapp_contact' => ['nullable', 'digits:10'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'username' => $input['username'],
            'profession' => $input['profession'] === 'Other' ?
                $input['profession_other'] : $input['profession'],
            'gender' => $input['gender'],
            'address' => $input['address'],
            'city' => $input['city'],
            'state' => $input['state'],
            'area' => $input['area'],
            'professional_email' => $input['professional_email'],
            'contact' => $input['contact'],
            'whatsapp_contact' => isset($input['same_contact']) ?
                $input['contact'] : $input['whatsapp_contact'],
            'role' => User::ROLE_USER,
        ]);
    }
}
