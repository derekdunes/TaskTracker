@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Task</div>

                <div class="panel-body">

                    <form class="form-horizontal" method="POST" action="/updateTask">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Client</label>

                            <div class="col-md-6">
                                <select id="name" type="text" class="form-control" name="name" value="" required autofocus>
                                <option value="">Choose a Client</option>
                                 
                              @foreach($clients as $client)     
                                   
                                   <option value="{{ $client->client_code }}">{{ $client->client_code }}</option>
                              
                              @endforeach
                              
                              </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Candidate's Email</label>

                            <div class="col-md-6">
                                <input type="text" name="candidateMail" value="">  <br>
                            </div>

                        </div>
                        
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Select the operators to mail the Issue to</label>

                            <div class="col-md-6">
                                
                                @foreach($users as $user)

                                    @if($user->id % 2 == 0)
                                        <input type="checkbox" name="" value="{{ $user->email }}"> {{ $user->name }} <br>
                                    @else
                                        <input type="checkbox" name="" value="{{ $user->email }}"> {{ $user->name }}
                                    @endif

                                @endforeach

                            </div>

                        </div>

                        <div class="form-group">
                            <label for="description" class="col-md-4 control-label">Description/Error Message</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="description" value="" required>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="details" class="col-md-4 control-label">Reg/App/RRR/Confirmation No</label>

                            <div class="col-md-6">
                                <input id="details" type="details" class="form-control" name="details" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
