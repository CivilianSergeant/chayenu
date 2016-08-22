<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class SectionController extends Controller
{
	public function index()
	{
		return view('section.index',[]);
	}


}