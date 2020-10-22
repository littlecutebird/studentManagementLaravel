<?php
namespace App\Services;
use App\Models\SocialFacebookAccount as FacebookUser;
use App\Models\User;
use Laravel\Socialite\Contracts\User as ProviderUser;
class FacebookAccountService
{
    public function createOrGetUser(ProviderUser $providerUser)
    {
        $account = FacebookUser::whereProvider('facebook')
            ->whereProviderUserId($providerUser->getId())
            ->first();
        if ($account) {
            return $account->user;
        } else {
            $account = new FacebookUser([
                'provider_user_id' => $providerUser->getId(),
                'provider' => 'facebook'
            ]);
            $user = User::whereUsername($providerUser->getEmail())->first();
            if (!$user) {
                $user = User::create([
                    'fullname' => $providerUser->getName(),
                    'username' => $providerUser->getEmail(),
                    'password' => md5(rand(1,10000)),
                ]);
            }
            $account->user()->associate($user);
            $account->save();
            return $user;
        }
    }
}