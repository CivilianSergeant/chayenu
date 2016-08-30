<?php
namespace App\Http\Controllers;

use App\Entities\Section;
use App\Entities\Text;
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
        if(empty($parsha)){
           return redirect('dashboard')->withErrors('Sorry! Parsha not exist with ID:'.$id);
        }
		$data = array(
			'parsha' => $parsha,
            'sections' => Section::where('last_action','!=','delete')->orderBy('order','asc')->get()
		);
		return view('parsha.detail',$data);
	}

    public function create(Request $request)
    {

        $this->validate($request,['parsha_name'=>'required|unique:parshas',
        'start_date'=>'required',
        'end_date' => 'required']);

        $all = $request->all();
        $all['last_action'] = 'insert';
        $parsha = new Parsha($all);
        $parsha->save();

        return redirect('parsha/lists')->with('success','New Parsha ['.$all['parsha_name'].'] was saved successfully');
    }

    public function show(Request $request)
    {
        $data = array('parshas'=>Parsha::all());
        return view('parsha.list',$data);
    }

    public function edit(Request $request, $id)
    {
        $data = array('parsha'=>Parsha::find($id));
        return view('parsha.edit',$data);
    }

    public function update(Request $request)
    {

        $this->validate($request,['parsha_name'=>'required',
            'start_date'=>'required',
            'end_date' => 'required']);

        $all = $request->all();

        $parsha = Parsha::find($request->get('id'));

        if(!empty($parsha)){
            if($parsha->parsha_name != $all['parsha_name']){
                $search = Parsha::where('parsha_name',$all['parsha_name'])->first();
                if(!empty($search)){
                    return redirect('parsha/edit/'.$all['id'])
                                            ->withErrors('Parsha name is not available')
                                            ->withInput();
                }
            }

            $parsha->parsha_name = $all['parsha_name'];
            $parsha->start_date  = $all['start_date'];
            $parsha->end_date    = $all['end_date'];
            $parsha->save();

            return redirect('parsha/edit/'.$all['id'])->with('success','Parsha info updated');
        }else{
            return redirect('parsha/edit/'.$all['id'])->withErrors('Sorry! parsha not found or not exist');
        }
    }

    public function delete(Request $request, $id)
    {
        $parsha = Parsha::find($id);
        if(!empty($parsha)){
            $parsha->delete();
        }
        return redirect('parsha/lists');
    }

    public function getDays(Request $request)
    {
        $sectionId = $request->get('section_id');
        $dayNumbers = Text::select('day_num')->distinct()->where('section_id',$sectionId)->get();
        $days = ['Saturday','Sunday','Monday','Tuesday','Wednesday','Thursday','Friday'];
        $newDays = array();
        foreach($dayNumbers as $i=> $dn){

            $newDays[$dn->day_num] = $days[$i]." (".$dn->day_num.")";
        }

        return json_encode(array('days'=>$newDays));
    }

    public function getTexts(Request $request)
    {
        $sectionId = $request->get('section_id');
        $dayNum = $request->get('day_num');

        $texts = Text::select('id','text_both','sync','last_action','order')->where('section_id',$sectionId)
                ->where('day_num',$dayNum)
                ->where('last_action','!=','delete')
                ->orderBy('order','asc')
                ->get();
        $textEngHebs = Text::select('id','text_eng','text_heb','sync','last_action','order')->where('section_id',$sectionId)
            ->where('day_num',$dayNum)
            ->where('text_both','=','')
            ->where('last_action','!=','delete')
            ->orderBy('order','asc')
            ->get();
        
        $data = array(
            'text_both' => $texts,
            'text_eng_heb' => $textEngHebs
        );
        return json_encode($data);
    }
}