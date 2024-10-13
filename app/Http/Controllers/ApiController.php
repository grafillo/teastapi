<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

//          $validator = Validator::make($request->all(), [
//              'name' => 'required|string|max:255',
//              'email' => 'required|email|max:255',
//          ]);
//
//          if ($validator->fails()) {
//              return response()->json([
//                  'errors' => $validator->errors(),
//              ], 422);
//          }
//        dd($request);

            return Task::create($request->validated());
      }

      public function updateTask(Request $request,Task $task){
          return $task->update($request->all());
      }

      public function deleteTask(Task $task){
          return $task->delete();
      }
}
