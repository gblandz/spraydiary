<?php

namespace App\Http\Controllers;

use Auth;
use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TasksController extends Controller
{
    public function index()
    {
    	$tasks = Task::all();
        $users = User::pluck('name', 'id');
        return view('admin.tasks.index',compact('tasks', 'users'));

    }

    public function add()
    {
        $userSelect = User::pluck('name', 'id');
    	return view('admin.tasks.add', compact('userSelect'));
    }

    public function create(Request $request)
    {
    	$task = new Task();
    	$task->description = $request->description;
    	$task->user_id = $request->id;
    	$task->save();
    	return redirect()->route('admin.tasks.index'); 
    }

    public function edit($id)
    {
    	if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        $task = Task::find($id);
        $userSelect = User::pluck('name', 'id');

        return view('admin.tasks.edit', compact('task', 'userSelect'));
    }

    public function update(Request $request, Task $task)
    {
    	if(isset($_POST['delete'])) {
    		$task->delete();
    		return redirect()->route('admin.tasks.index');
    	}
    	else
    	{
    		$task->description = $request->description;
            $task->user_id = $request->user_id;
	    	$task->save();
	    	return redirect()->route('admin.tasks.index');
    	}    	
    }
}