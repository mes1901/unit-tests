<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectApiTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    private $expectedData;

    protected function setUp(): void
    {
        parent::setUp();
        $this->expectedData = [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'status' => $this->faker->randomElement([
                'planned',
                'running',
                'on hold',
                'finished',
                'cancel'
            ]),
        ];
    }

    public function testCreateProject()
    {
        $this->post('api/projects', $this->expectedData)
            ->assertStatus(201)
            ->assertJsonStructure([
                'id',
                'name',
                'description',
                'status',
                'created_at',
                'updated_at',
            ]);
    }

    public function testGetProject()
    {
        $project = factory(Project::class)->create();

        $this->get('api/projects/' . $project->id)
            ->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'name',
                'description',
                'status',
                'created_at',
                'updated_at',
            ]);
    }

    public function testGetAllProjects()
    {
        $projects = factory(Project::class, 2)->create();

        $this->get('api/projects')
            ->assertStatus(200)
            ->assertJson($projects->toArray())
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'name',
                    'description',
                    'status',
                    'created_at',
                    'updated_at',
                ]
            ]);
    }

    public function testUpdateProject()
    {
        $project = factory(Project::class)->create();

        $this->put('api/projects/' . $project->id, $this->expectedData)
            ->assertStatus(200)
            ->assertJson(['status' => 'successfully_updated']);
    }

    public function testDeleteClient()
    {
        $project = factory(Project::class)->create();
        $this->delete('api/projects/' . $project->id)
            ->assertStatus(204);
    }
}
