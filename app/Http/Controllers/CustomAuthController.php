<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomAuthController extends Controller
{
	
	public function index(Request $request)
	{
		if($request->session()->has('user')){
			return redirect('dashboard');
		}
		return view('authenticate.index');	
	}

	public function authenticate(Request $request)
	{
		$config = config('app.credentials');
		$suser = $config['user'];
		$spass = $config['pass']; 
		
		$all = $request->all();

		if($all['email'] == $suser && $all['password'] == $spass){
			$request->session()->put('user',md5($all['email'].$all['password']));
			return redirect('dashboard');
		}else{
			$request->session()->flash('message','Invalid email or password');
			return redirect('/');
		}
	}

	public function logout(Request $request)
	{
		$request->session()->forget('user');
		return redirect('/');
	}
}