@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
		
		<div class="col-md-7">
			<div class="panel panel-default">
				<div class="panel-heading">Task</div>
				<div class="panel-body">
				@if(count($tasks) > 0)
					@foreach($tasks ->all() as $task)
						<div class="row">
							<div class="col-md-8">{{ $task -> task }} <span class="text-muted pull-right">Created at {{ $task-> created_at }}</span></div>
							<div class="col-md-2"><a href="{{ url('/home/edit?tid='.$task-> id ) }}">Edit</a></div>
							<div class="col-md-2"><a href="{{ url('/home?did='.$task-> id ) }}">Delete</a> </div>
						</div>
					@endforeach
				@else
					<p>There is no Task recorded yet.</p>
				@endif
				</div>
			</div>
			
		</div>
        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading">Add Task
			</div>

                <div class="panel-body">
					@if(session('response'))
					<div class="alert alert-success">{{ session('response') }}</div>
				
					@endif 	
                  
					<form method="POST" action="{{ url('home')}}">
					  {{ csrf_field() }}
					<div class="form-group input-group">
						<input type="text" name="task" id="task" class="form-control"> <span class="input-group-btn">
    <button type="submit"class="btn btn-default" type="button">ADD</button></span>
					</div>
					
					</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
