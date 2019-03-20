@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create Task</div>

                <div class="panel-body">

                    @foreach($task as $tak)

                    <form class="form-horizontal" method="POST" action="/updateTask/{{$tak->id}}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="client" class="col-md-4 control-label">Client</label>

                            <div class="col-md-6">
                                <select type="text" class="form-control" name="client" id="client" value="" required autofocus>
                                 
                              @foreach($clients as $client)     
                                   @if($tak->client == $client->client_code)
                                        <option value="{{ $client->client_code }}" selected>{{ $client->client_code }}</option>
                                    @endif
                                    <option value="{{ $client->client_code }}">{{ $client->client_code }}</option>

                              @endforeach
                              
                              </select>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="candidateMail" class="col-md-4 control-label">Candidate Email</label>

                            <div class="col-md-6">
                                <input id="candidateMail" type="candidateMail" class="form-control" value="{{ $tak->problem_candidate }}" name="candidateMail" required>
                            </div>

                        </div>
                        
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Select the operators to mail the Issue to</label>

                            <div class="col-md-6">
                                
                                @foreach($users as $user)

                                    @if($user->id % 2 == 0)
                                        <input type="checkbox" name="operator[]" value="{{ $user->email }}"> {{ $user->name }} <br>
                                    @else
                                        <input type="checkbox" name="operator[]" value="{{ $user->email }}"> {{ $user->name }}
                                    @endif

                                @endforeach

                            </div>

                        </div>

                        <div class="form-group">
                            <label for="status" class="col-md-4 control-label">Problem Status</label>

                            <div class="col-md-6">
                                <select id="status" type="text" class="form-control" name="status" required autofocus>
                                    @if ($tak->status == 'pending')
                                        <option id="red" value="pending" selected>Pending</option>       
                                        <option id="yellow" value="progress">In Progress</option>
                                        <option id="green" value="resolved">Resolved</option>
                                    @elseif ($tak->status == 'progress')
                                        <option id="red" value="pending" >Pending</option>       
                                        <option id="yellow" value="progress" selected>In Progress</option>
                                        <option id="green" value="resolved">Resolved</option>
                                    @elseif( $tak-status == 'resolved')
                                        <option id="red" value="pending" >Pending</option>       
                                        <option id="yellow" value="progress">In Progress</option>
                                        <option id="green" value="resolved" selected>Resolved</option>
                                    @endif
                                </select>
                            </div>
                            
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-md-4 control-label">Description/Error Message</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="description" value="{{ $tak->problem_description }}" required>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="details" class="col-md-4 control-label">Reg/App/RRR/Confirmation No</label>

                            <div class="col-md-6">
                                <input id="details" type="details" class="form-control" name="details" value="{{ $tak->addition_info }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
