<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function showTask(Task $task){
        return $task;
    }

    public function getTasks(Request $request){
        $tasks = Task::paginate(10);

        if(isset($request->order)){
            if($request->order == 'asc'){
                $tasks = Task::orderBy('completion_date', 'asc')->paginate(10);
            }

            if($request->order == 'desc'){
                $tasks = Task::orderBy('completion_date', 'desc')->paginate(10);
            }
        }

            return $tasks;
      }

      public function createTask(CreateTaskRequest $request){
            return Task::create($request->validated());
      }

      public function updateTask(CreateTaskRequest $request,Task $task){
          return $task->update($request->validated());
      }

      public function deleteTask(Task $task){
          return $task->delete();
      }
}
