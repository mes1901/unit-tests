<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\CreateOrUpdateProjectHttpRequest;
use App\Http\Requests\Project\UpdateProjectHttpRequest;
use App\Models\Project;
use Illuminate\Http\JsonResponse;

class ProjectController extends Controller
{
    public function store(CreateOrUpdateProjectHttpRequest $request): JsonResponse
    {
        try {
            $project = Project::create([
                'name' => $request->getName(),
                'description' => $request->getDescription(),
                'status' => $request->getStatus()
            ]);

            return response()->json($project->toArray(),201);
        } catch (\Exception $exception) {
            return response()->json([
                'error' => [
                    'code' => 'system',
                    'message' => $exception->getMessage()
                ]
            ], 500);
        }
    }

    public function show(string $id): JsonResponse
    {
        $project = Project::findOrFail($id);

        return response()->json($project->toArray());
    }

    public function index(): JsonResponse
    {
        $projects = Project::all();

        return response()->json($projects->toArray());
    }

    public function update(string $id, CreateOrUpdateProjectHttpRequest $request): JsonResponse
    {
        try {
            Project::where('id', $id)
                ->update([
                    'name' => $request->getName(),
                    'description' => $request->getDescription(),
                    'status' => $request->getStatus()
                ]);

            return response()->json(['status' => 'successfully_updated']);
        } catch (\Exception $exception) {
            return response()->json([
                'error' => [
                    'code' => 'system',
                    'message' => $exception->getMessage()
                ]
            ], 500);
        }
    }

    public function delete(string $id): JsonResponse
    {
        Project::find($id)->delete();

        return response()->json(null,204);
    }
}
