<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Task;

class TasksController extends Controller
{
    public function index()
    {
    	$user = Auth::user();
        return view('admin.tasks.index',compact('user'));
    }

    public function add()
    {
    	return view('admin.tasks.add');
    }

    public function create(Request $request)
    {
    	$task = new Task();
    	$task->description = $request->description;
    	$task->user_id = Auth::id();
    	$task->save();
    	return redirect()->route('admin.tasks.index'); 
    }

    public function edit(Task $task)
    {

    	if (Auth::check() && Auth::user()->id == $task->user_id)
        {            
                return view('admin.tasks.edit', compact('task'));
        }           
        else {
             return redirect()->route('admin.tasks.index');
         }            	
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
	    	$task->save();
	    	return redirect()->route('admin.tasks.index');
    	}    	
    }
}