<?php

namespace App\Repositories\Auth;

use Illuminate\Http\Request;
use Laravel\Passport\Token;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Client;

class AuthRepository
{
    public function getCredentials(array $data): array
    {
        return [
            'email' => $data['email'] ?? null,
            'password' => $data['password'] ?? null,
        ];
    }
    public function getRefreshData(array $data): array
    {
        return [
            'grant_type' => 'refresh_token',
            'refresh_token' => $data['refresh_token'],
        ];
    }
    public function getUserToken()
    {
        return Auth::user()->token();
    }
    public function findUserTokenById($tokenId)
    {
        return Auth::user()->tokens()->where('id', $tokenId)->first();
    }


    public function getTokensByUser($user)
    {
        return $user->tokens;
    }

    public function revokeTokenById($tokenId)
    {
        $token = Token::find($tokenId);

        if (!$token) {
            return response()->json(['error' => 'Token not found'], 404);
        }

        $token->revoke();

        return response()->json(['message' => 'Token revoked']);
    }
    public function getClients()
    {
        return Client::all();
    }

    public function updateClient($clientId, array $data)
    {
        $client = Client::findOrFail($clientId);
        $client->update($data);
        return $client;
    }
    public function deleteClient($clientId)
    {
        $client = Client::findOrFail($clientId);
        $client->delete();

        return response()->json(['message' => 'Client deleted'], 200);
    }
    public function getPersonalTokens($user)
    {
        return $user->tokens()->get();
    }

    public function createPersonalToken($user, $name, $scopes = [])
    {
        return ['token' => $user->createToken($name, $scopes)->accessToken];
    }

    public function deletePersonalToken($tokenId)
    {
        $token = $user = auth()->user()->tokens()->findOrFail($tokenId);
        $token->revoke();

        return response()->json(['message' => 'Token revoked successfully.']);
    }
    public function getActiveSessions()
    {
        return Auth::user()->tokens()->where('revoked', false)->get();
    }

    public function revokeSession($tokenId)
    {
        $token = Auth::user()->tokens()->where('id', $tokenId)->first();

        if ($token) {
            $token->revoke();
            return response()->json(['message' => 'Session revoked successfully']);
        }

        return response()->json(['error' => 'Token not found'], 404);
    }
}
