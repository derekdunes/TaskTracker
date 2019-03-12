<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getclientAgents($clientCode){

		$users = DB::table('users')->where('client_code',$client_code)->orWhere('client_code', 'overall')->get();
		
		echo json_encode($users);

		exit;	
	}

	
}
