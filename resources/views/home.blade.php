@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
		
<!-- 		<div class="col-md-7">
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
			
		</div> -->

        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Add Task
			</div>

                <div class="panel-body">
					@if(session('response'))
					<div class="alert alert-success">{{ session('response') }}</div>
				
					@endif 	
                  <table>
                  	<tr>
                  		<th>Task id</th>
	                  	<th>Client</th>
	                  	<th>Description/Error Message</th>
	                  	<th>Candidate Reg/App/RRR/Confirmation No</th>
	                  	<th>Created By</th>
	                  	<th>Assigned to</th>
	                  	<th>Start Time</th>
	                  	<th>Modified Time</th>
	                  	<th>Status</th>
                  	</tr>
                  	<tr>
                  		<td><a href="">1</a></td>
                  		<td>ABSU</td>
                  		<td>A student cant fill the Post graduate programme</td>
                  		<td>ESUT/2011/110473,RRR(1274390324)</td>
                  		<td>Ugochukwu Willie</td>
                  		<td>Biggie, Cynthia, Teecee</td>
                  		<td>20th June 2019 20:11:15</td>
                  		<td>45th January 2014 20:11:15</td>
                  		<td>Pending</td>
                  		<!-- <td>
	    					<button type="submit"class="btn btn-default" type="button">UPDATE</button>
	    				</td>
	    				<td>
	    					<button type="submit"class="btn btn-default" type="button">DELETE</button>
	    				</td> -->
                  	</tr>
                  	<tr>
                  		<td><a href="">2</a></td>
                  		<td>ABSU</td>
                  		<td>A student cant fill the Post graduate programme</td>
                  		<td>ESUT/2011/110473, RRR(1274390324)</td>
                  		<td>Tochukwu Jaycee</td>
                  		<td>Biggie, Cynthia</td>
                  		<td>20th June 2019 20:11:15</td>
                  		<td>45th January 2014 20:11:15</td>
                  		<td>Pending</td>
                  	</tr>
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
