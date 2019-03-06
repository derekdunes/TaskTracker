@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row">
      <div class="col-md-8 col-md-offset-2">
         <div class="panel panel-default">
            <div class="panel-heading">Edit Current Task</div>
            <div class="panel-body">
               <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                  {{ csrf_field() }}
                  @if(count($tasks) > 0)
                  @foreach($tasks ->all() as $task)
                  <div class="form-group{{ $errors->has('task') ? ' has-error' : '' }}">
                     <label for="task" class="col-md-4 control-label">Task</label>
                     <div class="col-md-6">
                        <input id="task" type="text" class="form-control" name="task" value="{{ $task -> task }}" required autofocus>
                        Created at {{ $task-> created_at }}
                        @if ($errors->has('task'))
                        <span class="help-block">
                        <strong>{{ $errors->first('task') }}</strong>
                        </span>
                        @endif
                     </div>
                  </div>
                  @endforeach
                  @else
                  <p>There is no Task recorded yet.</p>
                  @endif
                  <div class="form-group">
                     <div class="col-md-8 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                        Update
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