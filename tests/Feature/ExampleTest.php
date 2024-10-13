<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Task;
use Tests\TestCase;

class ExampleTest extends TestCase
{


    private $registeredUser = ['email'=>'test@example.com',
                               'password' => '12345678'];
    /**
     * A basic test example.
     */



    public function test_get_tasks(): void
    {
        $response = $this->get('/api/tasks');
        $response->assertSuccessful();
    }


    public function test_get_task(): void
    {
        $task = Task::factory(1)->create();
        $response = $this->get('/api/task/' . $task[0]->id);

        $response->assertSuccessful();
    }

    public function test_delete_task_nonautorise(): void
    {
        $task = Task::factory(1)->create();
        $response = $this->delete('/api/delete/' . $task[0]->id);

        $response->assertStatus(302);
    }

    public function test_delete_task_autorised(): void
    {
        $task = Task::factory(1)->create();
        $bearerToken = $this->post('api/auth/login', $this->registeredUser);

        $response = $this->withHeaders([
        'Token' => $bearerToken['access_token'],
          ])->delete('/api/delete/' . $task[0]->id);

        $response->assertSuccessful();
    }

    public function test_update_task_nonautorise(): void
    {
        $taskUpdate = ['title' => 'new'];
        $task = Task::factory(1)->create();
        $response = $this->patch('/api/update/' . $task[0]->id, $taskUpdate);

        $response->assertStatus(302);
    }

    public function test_update_task_authorised(): void
    {
        $taskUpdate = ['title' => 'new'];
        $task = Task::factory(1)->create();
        $bearerToken = $this->post('api/auth/login', $this->registeredUser);

        $response = $this->withHeaders([
            'Token' => $bearerToken['access_token'],
        ])->patch('/api/update/' . $task[0]->id,$taskUpdate);

        $response->assertSuccessful();
    }

    public function test_create_task_nonautorise(): void
    {
        $task = ['title' => 'new'];

        $response = $this->post('/api/task/', $task);

        $response->assertStatus(302);
    }

    public function test_create_task_authorised(): void
    {
        $task = ['title' => 'new'];
        $bearerToken = $this->post('api/auth/login', $this->registeredUser);

        $response = $this->withHeaders([
            'Token' => $bearerToken['access_token'],
        ])->post('/api/task/', $task);

        $response->assertSuccessful();
    }

    public function test_create_task_autorise_without_title(): void
    {
        $task = ['description' => 'new'];
        $bearerToken = $this->post('api/auth/login', $this->registeredUser);

        $response = $this->withHeaders([
            'HTTP_X_REQUESTED_WITH' => 'XMLHttpRequest',
            'Token' => $bearerToken['access_token'],
            'Content-Type' => ' application/json;'
        ])->post('/api/task/', $task);

        $response = $this->postJson('/api/task/', [
            'date' => '2016-01-01'
        ]);

        $response->assertStatus(422);
    }


}
