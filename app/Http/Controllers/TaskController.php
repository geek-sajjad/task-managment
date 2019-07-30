<?php

namespace App\Http\Controllers;

use App\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //$tasks = Task::where('owner_id', auth()->id())->get();
        //$doneTasks = Task::whereNotNull('done_at')
       //     ->where('owner_id', auth()->id())->get();
//        dd($doneTasks);


        $doneTasks = auth()->user()->tasks()->whereNotNull('done_at')->get();
        $notDoneTasks = auth()->user()->tasks()->whereNull('done_at')->get();



        return view('tasks.index', compact('doneTasks','notDoneTasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'task' => 'required',
        ]);
//         $validatedData = $request->validate();
        $task  = new Task;
        $task->name = $request->task;
        $task->owner_id = auth()->id();
        $task->save();
        return redirect()->back()->with('status', 'new task is created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {

//        dd($task->user()->first()->name); // error

        if($task->owner_id != auth()->id()){
            abort(401);
        }
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {

        if($task->owner_id != auth()->id()){
            abort(401);
        }

        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {

        if($task->owner_id != auth()->id()){
            abort(401);
        }

        $request->validate([
            'task' => 'required',
        ]);

        $task->name = $request->input('task');
        $task->save();
        return redirect()->back()->with('status', 'task is updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */

    public function destroy(Task $task)
    {
        if($task->owner_id != auth()->id()){
            abort(401);
        }


        $task->delete();
        return redirect('/tasks')->with('status','taks is deleted');
    }





    public function done(Task $task){
        $task->done_at = Carbon::now();
        $task->save();
        return redirect('/tasks')->with('status', 'task is done :)');
    }
}
