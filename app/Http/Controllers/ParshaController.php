<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entities\Parsha;
class ParshaController extends Controller
{
    public function index(Request $request)
    {
        return view('parsha.index',[]);
    }

	public function detail(Request $request, $id)
	{
		$parsha = Parsha::find($id);
		$data = array(
			'parsha' => $parsha
		);
		return view('parsha.detail',$data);
	}

    public function create(Request $request)
    {
        $this->validate($request,['parsha_name'=>'required']);
        redirect('parsha/new');
    }
}