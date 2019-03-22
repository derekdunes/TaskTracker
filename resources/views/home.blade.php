@extends('layouts.app')

@section('scripts')
	
	<script type="text/javascript">
   
	   function newTask(){

			var $url = '/createTask';

	        window.location.href = $url;

	    }
            
	</script>

@endsection


@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Add Task
			</div>

            <div class="panel-body">

            <div class="row">
				<div class="col-md-1 sort"> 
					<a href="/home">SortBy:</a> 
				</div>
				<div class="col-md-1 sort">
					<a href="/sortby/pending">Pending</a>
				</div>
				<div class="col-md-1 sort">
					<a href="/sortby/progress">InProgress</a>
				</div>
				<div class="col-md-1 sort">
					<a href="/sortby/completed">Resolved</a>
				</div>
				<div class="col-md-1 sort">
					<a href="/sortby/lastmodified">Modified</a>
				</div>

				<form class="form-horizontal" method="POST" action="/findTicket">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <div class="col-md-6">
                                <input type="text" placeholder="Find Ticket Id" name="id">
                                <button type="submit" class="btn btn-primary">
			                        Find Ticket
			                    </button>
                            </div>

                        </div>
                    </form>

			</div>

			<br>

					@if(session('response'))
					<div class="alert alert-success">{{ session('response') }}</div>
				
					@endif 	
                  <table>
                  	<tr>
                  		<th>Ticket id</th>
                  		<th>Candidate</th>
	                  	<th>Client</th>
	                  	<th>Description/Error Message</th>
	                  	<th>Reg/App/RRR/Confirmation No</th>
	                  	<th>Created By</th>
	                  	<th>Assigned to</th>
	                  	<th>Expiring Date</th>
	                  	<th>Status</th>
	                  	<th>View Ticket</th>
                  	</tr>
                  	@foreach($tasks as $task)

                  		<tr>
                  			<td><a href="/view/{{ $task->id }}">{{ $task->id }}</a> </td>
                  			<td>{{ $task->problem_candidate }}</td>
                  			<td>{{ $task->client }}</td>
                  			<td>{{ $task->problem_description }}</td>
                  			<td>{{ $task->addition_info }}</td>
                  			<td>{{ $task->created_by }}</td>
                  			<td> {{ $task->assigned_to }} </td>
                  			<td>{{ $task->stop_date }}</td>

                  			@if($task->status == 'pending')
	                  			<td id="red">
	                  				pending
	                  			</td>
                  			@elseif($task->status == 'progress')
	                  			<td id="yellow">
	                  				In Progress
	                  			</td>
	                  		@elseif($task->status == 'resolved')
	                  			<td id="green">
	                  				Resolved
	                  			</td>
	                  		@endif
                  			<td><a href="/view/{{ $task->id }}">View</a> </td>

                  		</tr>

                  	@endforeach

                  </table>
                  <br>
                  <div class="row">
                  			<div class="col-md-10"></div>
                            <div class="col-md-2">
                                <button onclick="newTask()" class="btn btn-primary">
                                    Create Task
                                </button>
                            </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
