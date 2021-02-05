<?php

namespace App\Actions\Fortify;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Illuminate\Support\Facades\File;

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
            'username' => ['required', 'min:6', 'max:12', 'alpha_dash', Rule::unique('users')->ignore($user->id)],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ])->validateWithBag('updateProfileInformation');

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            if(isset($input['profile_image'])){
                File::delete('profiles/' . $user->profile_image);
                $profile_image = time().'.'.$input['profile_image']->extension();
                $input['profile_image']->move(public_path('profiles'), $profile_image);
            }
            else{
                $profile_image = $user->profile_image;
            }
            $user->forceFill([
                'name' => $input['name'],
                'username' => $input['username'],
                'email' => $input['email'],
                'profile_image' => $profile_image,
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
        if(isset($input['profile_image'])){
            File::delete($user->profile_image);
            $profile_image = time().'.'.$input['profile_image']->extension();
            $input['profile_image']->move(public_path('profiles'), $profile_image);
        }
        else{
            $profile_image = $user->profile_image;
        }
        $user->forceFill([
            'name' => $input['name'],
            'username' => $input['username'],
            'email' => $input['email'],
            'profile_image' => $profile_image,
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
