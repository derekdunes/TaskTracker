<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use DB;
use Auth;
use Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function welcome(){

    	$user = Auth::user();	
		
		if($user){ 
			
			$tasks = DB::table('newTasks')->get();
			return view('home', compact('tasks'));

		}else{
			return view('welcome');
		}

    } 

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		// if(isset($_GET["did"])){
			
		// 	$did = $_GET["did"];
		// 	$delete = Task::find($did);
		// 	$delete->delete();
		// }
		
		// $user_id = Auth::user()->id;
		// $taskview = Task::all()->where('author_id', $user_id);

		/*
		*To get all task added by user we need to select * task WHERE Auth user id == 
		*/

		$tasks = DB::table('newTasks')->orderBy('created_at','DESC')->get();

        return view('home', compact('tasks'));
    }
	
	public function addTask(Request $request)
	{
		$user_id = Auth::user()->id;
		$this->validate($request,[
			'task' => 'required'
		]);

		//
		$task = new Task;
		$task->task = $request->input('task');
		$task->author_id = Auth::user()->id;
		$task->save();

		$tasks = DB::table('newTasks')->orderBy('created_at','DESC')->get();

		return redirect('/home')->with('response', 'Task Added Successfully')->with('tasks', $tasks);

	}

	public function findTask(Request $req){

		$taskId = $req->input("id");

		$tasks = DB::table('newTasks')->where('id', $taskId)->orderBy('created_at', 'DESC')->get();

		if (!$tasks->isEmpty()) {

		  	return view('/home',compact('tasks'));
		
		}else{

			$message = 'Could Not Find Ticket id '. $taskId;
			$tasks = DB::table('newTasks')->orderBy('created_at','DESC')->get();

			return redirect('/home')->with('response', $message)->with('tasks', $tasks);

		}  

	}

	public function viewTask($id){
		$task = DB::table('newTasks')->where('id',$id)->get();

		return view('view', compact('task'));
	}
	
	public function editTask($id) 
	{
		//get all the clients and users
		$users = DB::table('users')->get();
		$clients = DB::table('clients')->get();
		$task = DB::table('newTasks')->where('id',$id)->get();

		return view('edit', compact('task','users','clients'));
	}

	public function creatingTask(Request $req){
		
		$user = Auth::user();
		$client = $req->input("client");
		$candidateMail = $req->input("candidateMail");
		$operators = $req->input("operator");
		$description = $req->input("description");
		$details = $req->input("details");
		$status = $req->input("status");

		$concatOperator = '';

		foreach ($operators as $operator) {
			# code...
			//build the string to save to the DB
			$concatOperator = $concatOperator . ' ' . $operator;

		}

		$data=array("client"=>$client,"problem_description"=>$description,"addition_info"=>$details,"problem_candidate"=>$candidateMail,"assigned_to"=>$concatOperator,"status"=>$status,"created_by"=>$user->name,"created_at"=>NOW());

		Db::table('newTasks')->insert($data);

		$tasks = DB::table('newTasks')->get();

		$id = DB::getPdo()->lastInsertId();

		// send an email to the problemCandidate first and selected operators with the ticket id
		//$id;

	    $content = 'Hi ' . $candidateMail . ', ' . 'An issue with the ticket ' . $id . ' has been logged. Kindly check your email for more information concerning your issues ' . 'Thank you.';

	   $title = 'LloydantBot: Do Not Reply';
	   
	   Mail::send('emails.send', ['candidateMail' => $candidateMail, 'title' => $title, 'content' => $content], function ($message) use ($candidateMail)
        {

            $message->from('support@lloydant.com', 'Lloydant Support');

            $message->to($candidateMail);

        });

	   $title = 'LloydantBot: Do Not Reply';

	   $content = 'A '. $status . ' issue from our client ' . $client .' with the ticket no ' . $id . ' has been logged and assigned to you by ' . $user->name . '. Kindly check the taskTracker app for more information on how to solve issue ' . 'Thank you.';

		foreach ($operators as $operator) {
			
			//send the mail to all the operators involved and use the id

		Mail::send('emails.send', ['operator' => $operator, 'title' => $title, 'content' => $content], function ($message) use ($operator)
        {

            $message->from('support@lloydant.com', 'Lloydant Support');

            $message->to($operator);

        });


		}

		return redirect('/home')->with('response', 'Task Added Successfully')->with('tasks',$tasks);


	}

	public function UpdateTask(Request $req, $id){

		$user = Auth::user();
		$client = $req->input("client");
		$candidateMail = $req->input("candidateMail");
		$operators = $req->input("operator");
		$description = $req->input("description");
		$details = $req->input("details");
		$status = $req->input("status");

		$concatOperator = '';

		foreach ($operators as $operator) {
			# code...
			//build the string to save to the DB
			$concatOperator = $concatOperator . ' ' . $operator;

		}

		$data = array("client"=>$client,"problem_description"=>$description,"addition_info"=>$details,"problem_candidate"=>$candidateMail,"assigned_to"=>$concatOperator,"status"=>$status,"modified_by"=>$user->name,"updated_at"=>NOW());

		Db::table('newTasks')->where('id', $id)->update($data);
		$tasks = DB::table('newTasks')->get();

		$id = DB::getPdo()->lastInsertId();

		//if the status is resolved send the user a new email telling him or her that the problem is resolved

		// send an email to the problemCandidate first and selected operators with the ticket id
		//$id;

		if ($status == 'resolved') {
			# send mail to the user that the issue has been 

			$content = 'Hi ' . $candidateMail . ', ' . 'the issue you complained about have been solved by our operators ' . 'Thank you.';

		   $title = 'LloydantBot: Do Not Reply';

		   
		   Mail::send('emails.send', ['candidate' => $candidateMail, 'title' => $title, 'content' => $content], function ($message) use ($candidateMail)
	        {

	            $message->from( 'support@lloydant.com', 'Lloydant Support');

	            $message->to($candidateMail);

	        });

		}
	    

	 //   $title = 'Lloydant IssueBot From TaskTracker: Do Not Reply';

	 //   $content = 'A '. $status . ' issue from our client ' . $client .' with the ticket no ' . $id . ' has been logged and assigned to you by ' . $user->name . '. Kindly check the taskTracker app for more information on how to solve issue ' . 'Thank you.';

		// foreach ($operators as $operator) {
			
		// 	//send the mail to all the operators involved and use the id

		// 	Mail::send('emails.send', [ 'operator' => $operator , 'title' => $title, 'content' => $content], function ($message) use ($operator)
  //       	{

  //           	$message->from( 'support@lloydant.com', 'Lloydant Support');

	 //            $message->to($operator);

  //   	    });

		// }

		return redirect('/home')->with('response', 'Task Updated Successfully')->with('tasks',$tasks);

	}

	public function deleteTask($id){

		//delete row with id from the database
		DB::table('newTasks')->where('id',$id)->delete();
		$tasks = DB::table('newTasks')->get();

		return redirect('/home')->with('response', 'Task Deleted Successfully')->with('tasks',$tasks);

	}

	public function sortByStatus(){
		$tasks = DB::table('newTasks')->orderBy('status','desc')->get();

		return view('/home',compact('tasks'));
	}

	public function sortByLastModified(){
		$tasks = DB::table('newTasks')->orderBy('updated_at','desc')->get();

		return view('/home',compact('tasks'));
	}

	public function sortByPending(){
		$tasks = DB::table('newTasks')->where('status','pending')->orderBy('status','DESC')->get();

		return view('/home',compact('tasks'));
	}

	public function sortByProgress(){
		$tasks = DB::table('newTasks')->where('status','progress')->orderBy('status','DESC')->get();

		return view('/home',compact('tasks'));
	}

	public function sortByCompleted(){
		$tasks = DB::table('newTasks')->where('status','resolved')->orderBy('status','DESC')->get();

		return view('/home',compact('tasks'));
	}

	public function sortByModified(){
		$tasks = DB::table('newTasks')->orderBy('updated_at','DESC')->get();

		return view('/home',compact('tasks'));		
	}

	public function getTask($id)
	{
		//fetch data where the id is located
		$task = DB::table('newTasks')->where('id',$id)->get();
		$clients = DB::table('clients')->get();

		return view::make('edit', compact('task','clients'));
	}

	public function createNewTask(){

		//get all the clients and users
		$users = DB::table('users')->get();
		$clients = DB::table('clients')->get();
		
		return view('createTask', compact('clients','users'));

	}

	//update the already created task in the database
	public function updateNewTask(Request $req){

		$clients = DB::table('clients')->get();

		return view::make('edit', compact('clients'));

	}
	
}
