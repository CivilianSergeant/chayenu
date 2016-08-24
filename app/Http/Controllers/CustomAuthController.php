<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomAuthController extends Controller
{
	
	public function index(Request $request)
	{

        if($request->cookie('user') || $request->session()->has('user')){
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

        $remember = isset($all['remember']) ? 1 : 0;

		if($all['email'] == $suser && $all['password'] == $spass){
            $loginToken = md5($all['email'].$all['password']);

            if($remember)
            {
                return redirect('dashboard')
                    ->withCookie(cookie('user',$loginToken,time()+(60*60*24*365)));
            }
		    else{
                $request->session()->put('user',$loginToken);
                return redirect('dashboard');
            }

        }else{
			$request->session()->flash('message','Invalid email or password');
			return redirect('/');
		}
	}

	public function logout(Request $request)
	{
		$request->session()->forget('user');
		return redirect('/')->withCookie(cookie('user',null,-time()+(60*60*24*365)));
	}
}