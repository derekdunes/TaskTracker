@extends('layouts.app')
<style>
.welcomerow{
	margin-top: 25px;
	margin-bottom: 25px;
}
</style>
@section('content')
<div class="jumbotron" style="margin-top: -22px; background-color: white;">
<div class="container">
<h1>Task Management System</h1>
	<p>Welcome to Task Management System</p>

</div>


</div>
<div class="container">
	<div class="row text-center welcomerow">
		<div class="col-md-4"><h1>Add</h1>
		<p>Add task and refer to it from time to time</p>
		</div>
		<div class="col-md-4">
		<h1>Edit</h1>
		<p>Need to add extra stuff in your task? Edit it.</p>
		</div>
		<div class="col-md-4"><h1>Delete</h1>
		<p>Done with that task you set? Delete it.</p>
		</div>
	</div>
</div>
<div class="jumbotron" style=" background-color: white;">
<div class="container">
	<div class="row text-center">
		<div class="col-md-4">
		</div>
		<div class="col-md-4">
		
		</div>
		<div class="col-md-4"><h1>LETS GET STARTED</h1>
		<p>What are you waitng for? <a href="{{ url('/register')}}" class="btn btn-primary">SIGN UP NOW</a></p>
		</div>
	</div>
</div>
</div>
<div class="container">
	&copy Ananta Teor Albert
</div>
@endsection
