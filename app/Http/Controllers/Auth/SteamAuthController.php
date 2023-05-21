<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Ilzrv\LaravelSteamAuth\SteamAuth;
use Ilzrv\LaravelSteamAuth\SteamData;

class SteamAuthController extends Controller
{
    /**
     * The SteamAuth instance.
     *
     * @var SteamAuth
     */
    protected $steamAuth;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = "/";

    /**
     * SteamAuthController constructor.
     *
     * @param SteamAuth $steamAuth
     */
    public function __construct(SteamAuth $steamAuth)
    {
        $this->steamAuth = $steamAuth;
    }

    /**
     * Get user data and login
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login()
    {
        if (!$this->steamAuth->validate()) {
            return $this->steamAuth->redirect();
        }

        $data = $this->steamAuth->getUserData();

        if (is_null($data)) {
            return $this->steamAuth->redirect();
        }

        Auth::login(
            $this->firstOrCreate($data),
            true
        );

        return redirect($this->redirectTo);
    }

    /**
     * Get the first user by SteamID or create new
     *
     * @param SteamData $data
     * @return User|\Illuminate\Database\Eloquent\Model
     */
    protected function firstOrCreate(SteamData $data)
    {
        return User::firstOrCreate([
            'steam_id' => $data->getSteamId(),
        ], [
            'name' => $data->getPersonaName(),
            'avatar' => $data->getAvatar(),
            'player_level' => $data->getPlayerLevel(),
            'profile_url' => $data->getProfileUrl(),
            'country_code' => $data->getLocCountryCode(),
        ]);
    }
}