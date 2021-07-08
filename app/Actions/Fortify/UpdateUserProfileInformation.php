<?php

namespace App\Actions\Fortify;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
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
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name' => $input['name'],
                'email' => $input['email'],
                'gender' => $input['gender'],
                'address' => $input['address'],
                'city' => $input['city'],
                'state' => $input['state'],
                'area' => $input['area'],
                'professional_email' => $input['professional_email'],
                'contact' => $input['contact'],
                'whatsapp_contact' => isset($input['same_contact']) ?
                $input['contact'] : $input['whatsapp_contact'],
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,'profession' => $input['profession'] === 'Other' ?
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
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
