<?php
namespace App\Observers;
use App\Notifications\NewProfile;
use App\Profile;
use App\User;
class ProfileObserver
{
    public function created(Profile $profile)
    {
        $author = $profile->user;
        $users = User::all();
        foreach ($users as $user) {
            $user->notify(new NewProfile($profile,$author));
        }
    }
}