<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entities\Parsha;
class DashboardController extends Controller
{
	public function __construct()
	{
		//parent::__construct();
		//$this->setLayout('layouts.master.blade.php');
	}
	
	public function index(Request $request)
	{
		if(!$request->session()->has('user') && !$request->cookie('user')){
			return redirect('/');
		}

		$data = array(
			'parshas' => Parsha::all()	
		);

		
		return view('dashboard.index',$data);
	}
}