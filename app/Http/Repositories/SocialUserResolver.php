<?php
/**
 * Created by PhpStorm.
 * User: Swastik
 * Date: 7/11/2019
 * Time: 10:56 PM
 */

namespace App\Http\Repositories;
use Exception;
use Coderello\SocialGrant\Resolvers\SocialUserResolverInterface;
use Illuminate\Contracts\Auth\Authenticatable;
use Laravel\Socialite\Facades\Socialite;
class SocialUserResolver implements SocialUserResolverInterface
{
    /**
     * Resolve user by provider credentials.
     *
     * @param string $provider
     * @param string $accessToken
     *
     * @return Authenticatable|null
     */
    public function resolveUserByProviderCredentials(string $provider, string $accessToken): ?Authenticatable
    {
        $providerUser = null;

        try {
            $providerUser = Socialite::driver($provider)->userFromToken($accessToken);
            //var_dump($providerUser);
        } catch (Exception $exception) {}

        if ($providerUser) {
            return (new SocialAccountRepository())->findOrCreate($providerUser, $provider);
        }
        return null;
    }

}
