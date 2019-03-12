<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use DB;
use Auth;

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
			return redirect('home');
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
		if(isset($_GET["did"])){
			
			$did = $_GET["did"];
			$delete = Task::find($did);
			$delete->delete();
		}
		
		$user_id = Auth::user()->id;
		$taskview = Task::all()->where('author_id', $user_id);

		/*
		*To get all task added by user we need to select * task WHERE Auth user id == 
		*/
        return view('home', ['tasks' => $taskview,]);
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

		return redirect('/home')->with('response', 'Task Added Successfully'); 
	}
	
	public function editTask() 
	{

		if(isset($_GET["tid"])){
			$id = $_GET["tid"];
			$taskview = Task::all()->where('id', $id);
			return view('edit', ['tasks' => $taskview,]);
		}else{
			//get all the clients and users
			$users = DB::table('users')->get();
			$clients = DB::table('clients')->get();

			return view::make('edit', compact('users','clients'));
			//return redirect('/home');
		}

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
