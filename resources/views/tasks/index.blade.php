@extends('layouts.app')



@section('content')

    <div class="container">
        <div class="row">

            {{--       Not done Tasks     --}}
            <div class="col-md-6 ">
                <h2>Not done tasks:</h2>
                @if(session('status'))
                    <div class="alert alert-success">
                        {{session('status')}}
                    </div>
                @endif

                <div class="list-group">
                    @foreach($notDoneTasks as $index=>$notDoneTask)
{{--                        {{dd($index++)}}--}}
                        <a href="{{route('tasks.show', $notDoneTask->id)}}" class="list-group-item list-group-item-action">{{$notDoneTask->name}}</a>
                    @endforeach
                </div>

                    <a href="{{route('tasks.create')}}" class="btn btn-success mt-3">Create new Task</a>
            </div>


            {{--      Done Tasks    --}}
            <div class="col col-6">
                <h2>Done tasks:</h2>
                <ul class="list-group">
                    @foreach($doneTasks as $doneTask)
                        <a href="{{route('tasks.show', $doneTask->id)}}" class="list-group-item list-group-item-action list-group-item-success">{{$doneTask->name}}</a>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>



@endsection