<?php
namespace App\Http\Controllers;

use App\Entities\Section;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class SectionController extends Controller
{
	public function index(Request $request)
	{
        return view('section.index',[]);
	}

    public function show(Request $request)
    {
        $sections = Section::where('last_action','!=','delete')
            ->orderBy('order','asc')->get();
        $data = array('sections'=>$sections);
        return view('section.list',$data);
    }

    public function create(Request $request)
    {
        $this->validate($request,[
            'title' =>'required|unique:sections'
        ]);

        $order = Section::select(DB::raw('max(sections.`order`) as `order`'))->first();

        $section = new Section($request->all());
        $section->last_action='insert';
        $section->sync=1;
        $section->order = (!empty($order))? ($order->order+1):1;
        $section->save();

        return redirect('section/lists')
            ->with('success','New Section ['.$request->get('title').'] has been saved');

    }

    public function edit($id)
    {
        $section = Section::find($id);
        if(empty($section)){
            return redirect('section/lists')
                ->withErrors('Sorry! No Section found with ID:'.$id);
        }

        $data = array(
            'section' => $section
        );
        return view('section.edit',$data);
    }

    public function update(Request $request)
    {
        $this->validate($request,[
            'title' =>'required'
        ]);
        $all = $request->all();

        $section = Section::find($all['id']);
        if(empty($section)){
            return redirect('section/lists')
                    ->withErrors('Sorry! No Section found for update');
        }
        if($section->title != $all['title']){
            $sectionExist = Section::where('title',$all['title'])->first();
            if(!empty($sectionExist)){
                return redirect('section/edit/'.$all['id'])
                            ->withErrors('Section title already exist. Please try different one');
            }
            $section->title = $all['title'];
        }

        $section->save();

        return redirect('section/lists')
                ->with('success','Section Info Updated');

    }

    public function updateOrder(Request $request)
    {

        $orders = $request->get('order');

        if(!empty($orders)){
            foreach($orders as $i=>$item){
                $section = Section::find($item);
                $section->order=$i;
                $section->save();
            }
        }
    }

    public function delete($id)
    {
        $section = Section::find($id);
        $section->delete();

        return redirect('section/lists');
    }
}