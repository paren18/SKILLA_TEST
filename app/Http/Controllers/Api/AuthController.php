<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\Auth\AuthService;
use App\Repositories\Auth\AuthRepository;

class AuthController extends Controller
{
    protected $authService;
    protected $authRepository;

    public function __construct(AuthService $authService, AuthRepository $authRepository)
    {
        $this->authService = $authService;
        $this->authRepository = $authRepository;
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $this->authRepository->getCredentials($request->only('email', 'password'));

        return $this->authService->login($credentials);
    }
    public function refresh(Request $request)
    {
        $request->validate([
            'refresh_token' => 'required|string',
        ]);

        $refreshData = $this->authRepository->getRefreshData($request->only('refresh_token'));

        return $this->authService->refresh($refreshData);
    }

    public function logout()
    {
        return $this->authService->logout();
    }
    public function tokens()
    {
        return $this->authService->getUserTokens();
    }

    public function revoke($tokenId)
    {
        return $this->authService->revoke($tokenId);
    }
    public function clients()
    {
        return response()->json($this->authService->getClients());
    }

    public function updateClient(Request $request, $client_id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'redirect' => 'required|url',
        ]);

        $updatedClient = $this->authService->updateClient($client_id, $request->only(['name', 'redirect']));

        return response()->json($updatedClient);
    }
    public function deleteClient($client_id)
    {
        return $this->authService->deleteClient($client_id);
    }
    public function scopes()
    {
        return $this->authService->getScopes();
    }

    public function getPersonalTokens()
    {
        return $this->authService->getPersonalTokens();
    }

    public function createPersonalToken(Request $request)
    {

            if (!$request->user()) {
                return response()->json(['error' => 'Пользователь не авторизован'], 401);
            }

            $validated = $request->validate([
                'name' => 'required|string',
                'scopes' => 'array',
            ]);

            return $this->authService->createPersonalToken(
                $request->user(),
                $validated['name'],
                $validated['scopes'] ?? []
            );
    }


    public function deletePersonalToken($tokenId)
    {
        return $this->authService->deletePersonalToken($tokenId);
    }
    public function getActiveSessions()
    {
        return $this->authService->getActiveSessions();
    }

    public function revokeSession($tokenId)
    {
        return $this->authService->revokeSession($tokenId);
    }


}
