<?php

namespace App\Services\Auth;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Auth\AuthRepository;
use Laravel\Passport\Passport;


class AuthService

{

    protected $authRepository;
    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function login(array $credentials)
    {
        $response = Http::asForm()->post(config('app.url') . '/public/oauth/token', [
            'grant_type' => 'password',
            'client_id' => config('services.passport.client_id'),
            'client_secret' => config('services.passport.client_secret'),
            'username' => $credentials['email'],
            'password' => $credentials['password'],
            'scope' => '',
        ]);

        if ($response->failed()) {
            return response()->json(['error' => 'Неверный логин или пароль'], 401);
        }

        return $response->json();
    }
    public function refresh(array $data)
    {
        $refreshData = $this->authRepository->getRefreshData($data);

        $response = Http::asForm()->post(config('app.url') . '/public/oauth/token', [
            'grant_type' => 'refresh_token',
            'refresh_token' => $refreshData['refresh_token'],
            'client_id' => config('services.passport.client_id'),
            'client_secret' => config('services.passport.client_secret'),
        ]);

        if ($response->failed()) {
            return response()->json(['error' => 'Ошибка обновления токена'], 401);
        }

        return $response->json();
    }

    public function logout()
    {
        $this->authRepository->getUserToken()->revoke();

        return response()->json(['message' => 'Вы вышли из системы']);
    }

    public function getUserTokens()
    {
        return $this->authRepository->getTokensByUser(Auth::user());
    }

    public function revoke($tokenId)
    {
        return $this->authRepository->revokeTokenById($tokenId);
    }

    public function getClients()
    {
        return $this->authRepository->getClients();
    }
    public function updateClient($clientId, array $data)
    {
        return $this->authRepository->updateClient($clientId, $data);
    }
    public function deleteClient($clientId)
    {
        return $this->authRepository->deleteClient($clientId);
    }
    public function getScopes()
    {
        return Passport::scopes();
    }

    public function getPersonalTokens()
    {
        return $this->authRepository->getPersonalTokens(auth()->user());
    }

    public function createPersonalToken($user, $name, $scopes = [])
    {
        return $this->authRepository->createPersonalToken($user, $name, $scopes);
    }

    public function deletePersonalToken($tokenId)
    {
        return $this->authRepository->deletePersonalToken($tokenId);
    }
    public function getActiveSessions()
    {
        return $this->authRepository->getActiveSessions();
    }

    public function revokeSession($tokenId)
    {
        return $this->authRepository->revokeSession($tokenId);
    }


}
