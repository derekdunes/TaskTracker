@extends('layouts.app')

@section('scripts')

    <script type="text/javascript">

        $(document).ready(function(){ 

            $("#editBtn").click(function(){

                var Id = document.getElementById('taskId').getAttribute('value');

                var $url = '/edit/' + Id;

                window.location.href = $url;

            });

            $("#deleteBtn").click(function(){

                var Id = document.getElementById('taskId').getAttribute('value');

                console.log('The task row id is' + Id);

                var $url = '/delete/' + Id;

                window.location.href = $url;

            });

        });
            
    </script>

@endsection


@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">View Task</div>

                <div class="panel-body">
                    @foreach($task as $tak)

                    <div id="taskId" value="{{ $tak->id }}" hidden>
                    </div>

                    <form class="form-horizontal"  action="">

                        <div class="form-group">
                            <label for="client" class="col-md-4 control-label">Client</label>

                            <div class="col-md-6">
                                {{ $tak->client }}
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="candidateMail" class="col-md-4 control-label">Candidate Email</label>

                            <div class="col-md-6">
                                {{ $tak->problem_candidate }}
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Operators</label>

                            <div class="col-md-6">
                                {{ $tak->assigned_to }}
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="date" class="col-md-4 control-label">Expiring Date</label>

                            <div class="col-md-6">
                                <input id="date" type="date" class="form-control" value="{{ $tak->stop_date }}" name="stopDate" required>
                            </div>

                        </div>
                                                
                        <div class="form-group">
                            <label for="status" class="col-md-4 control-label">Problem Status</label>

                            <div class="col-md-6">
                                {{ $tak->status }}
                            </div>
                            
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-md-4 control-label">Description/Error Message</label>

                            <div class="col-md-6">
                                {{ $tak->problem_description }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="details" class="col-md-4 control-label">Reg/App/RRR/Confirmation No</label>
                                {{ $tak->addition_info }}
                        </div>
                    </form>
                    <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button id="editBtn" class="btn btn-primary">
                                    Edit
                                </button>
                                <button id="deleteBtn" class="btn btn-primary">
                                    Delete
                                </button>
                            </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
