@extends('layouts.app')



@section('content')


    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-2">
                <h1>Edit this task</h1>

                @if(session('status'))
                    <div class="alert alert-success">
                        {{session('status')}}
                    </div>
                @endif


                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{route('tasks.update', $task->id)}}" method="post">
                    <div class="form-group">

                        <label for="taskTitle">Task Title</label>
                        <input class="form-control @error('task') is-invalid @enderror" value="{{$task->name}}" type="text" placeholder="your task" name="task" id="taskTitle">

                        @error('task')
                        <div class="invalid-feedback">
                            Please fill the form.
                        </div>
                        @enderror

                    </div>

                    <input type="submit" value="update" class="btn btn-primary">

                    @method('PUT')
                    @csrf

                </form>

            </div>
        </div>
    </div>


@endsection