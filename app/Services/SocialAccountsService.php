<?php
namespace App\Services;


use App\User;
use App\Http\Repositories\ImageUpload;
use Laravel\Socialite\Two\User as ProviderUser;
class SocialAccountsService
{
    /**
     * Find or create user instance by provider user instance and provider name.
     *
     * @param ProviderUser $providerUser
     * @param string $provider
     *
     * @return User
     */
    protected  $imageUpload;

    public function __construct()
    {
        $this->imageUpload = new ImageUpload();
    }

    public function findOrCreate(ProviderUser $providerUser, string $provider): User
    {
        $user = User::where('provider_name', $provider)
            ->where('provider_id', $providerUser->getId())
            ->first();

        if ($user)
            return $user;
        else {
            $user = null;

            if ($email = $providerUser->getEmail())
                $user = User::where('email', $email)->first();

            if (!$user) {
                $user = User::create([
                    'name' => $providerUser->getName(),
                    'email' => $providerUser->getEmail(),
                    'image' => $this->imageUpload->imageUpload($providerUser->getAvatar(), '/img/'),
                    'provider_id' => $providerUser->getId(),
                    'provider_name' => $provider
                ]);
            }
        }
            return $user;
        }
    }

