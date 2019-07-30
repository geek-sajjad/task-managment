@extends('layouts.app')



@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <div>
                            {{$task->id}} - {{$task->name}} <br> created at : {{$task->created_at}} {{$task->updated_at ? "Updated at : " . $task->updated_at : ""}}
                            <br>
                            {{$task->done_at ? "Done at : " . $task->done_at : ""}}
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    Default checkbox
                                </label>

                            </div>
                            <a href="{{route('tasks.done', $task->id)}}" class="btn btn-success">Done</a>
                            <a href="{{route('tasks.edit', $task->id)}}" class="btn btn-primary">Edit</a>
{{--                            <a href="{{route('tasks.destroy', $task->id)}}" class="btn btn-danger">Delete</a>--}}
                            <form class="mt-2" action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button class="btn btn-danger">Delete Task</button>
                            </form>
                        </div>

                    </div>
                </div>



            </div>
        </div>
    </div>

@endsection