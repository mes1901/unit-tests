<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\CreateClientHttpRequest;
use App\Models\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    public function store(CreateClientHttpRequest $request): JsonResponse
    {
        try {
            $client = Client::create([
                'first_name' => $request->getFirstName(),
                'last_name' => $request->getLastName(),
                'email' => $request->getEmail(),
                'password' => Hash::make($request->getPassword())
            ]);

            return response()->json($client->toArray(),201);
        } catch (\Exception $exception) {
            return response()->json([
                'error' => [
                    'code' => 'system',
                    'message' => $exception->getMessage()
                ]
            ],500);
        }
    }

    public function show(string $id): JsonResponse
    {
        $client = Client::findOrFail($id);

        return response()->json($client->toArray());
    }

    public function index(): JsonResponse
    {
        $clients = Client::all();

        return response()->json($clients->toArray());
    }

    public function delete(string $id)
    {
        Client::find($id)->delete();

        return response()->json(null,204);
    }
}
