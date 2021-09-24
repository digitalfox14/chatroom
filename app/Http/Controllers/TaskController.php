<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Auth;
class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $userId = Auth::id();
        $toDo = "todo";
        $inprogress = "inprogress";
        $completed = "completed";
        $todoTask = Task::where('user_id',$userId)->where('task_status', $toDo)->orderBy('order')->get();
        $inprogressTask = Task::where('user_id',$userId)->where('task_status', $inprogress)->orderBy('order')->get();
        $completedTask = Task::where('user_id',$userId)->where('task_status', $completed)->orderBy('order')->get();
        return view('task.task', ['todoTask' => $todoTask, 'inprogressTask' => $inprogressTask, 'completedTask' => $completedTask]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = new Task;
        $task->user_id = Auth::id();
        $task->order = 1;
        $task->task = $request->task;
        $task->task_status = "todo";
        $task->save();
        return redirect()->route('task.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $task->task = $request->newTask;
        $task->save();
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
    }
    

    public function changeStatus(Request $request, Task $task)
    {        
        
                
            $task->task_status = $request->events;
            $task->save();       
    }
        
    public function changeOrder(Request $request, Task $task)
    {   
        $task->task_status = $request->events;
        $task->order = $request->orders;
        $task->save();
        
    }    
    
}
