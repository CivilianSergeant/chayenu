<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entities\Parsha;
class ParshaController extends Controller
{
	public function detail(Request $request, $id)
	{
		$parsha = Parsha::find($id);
		$data = array(
			'parsha' => $parsha
		);
		return view('parsha.detail',$data);
	}
}