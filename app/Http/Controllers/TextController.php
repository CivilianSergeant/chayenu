<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 8/28/16
 * Time: 11:04 PM
 */

namespace App\Http\Controllers;


use App\Entities\Text;
use Illuminate\Http\Request;

class TextController extends Controller{

    public function save(Request $request)
    {
        $all = $request->all();

        dd($all);
        
        /*$section = $all['section'];
        $day_num = $all['day_num'];
        $englishOnlyStart = $all['englishOnlyStart'];
        $hebStart = $all['hebStart'];
        $engStart = $all['engStart'];
        $englishOnly = $all['englishOnly'];
        $hebText = $all['hebText'];
        $engText = $all['engText'];
        $parsha_id = $all['parsha_id'];

        if($request->get('sync_both')){
            $texts = Text::where('section_id',$all['section'])
                ->where('day_num',$all['day_num'])
                ->whereIn('id',explode(",",$englishOnlyStart))->update(['sync'=>1]);
        }

        if($request->get('sync_ind')){
            $texts = Text::where('section_id',$all['section'])
                ->where('day_num',$all['day_num'])
                ->whereIn('id',explode(",",$hebStart))->update(['sync'=>1]);
            $texts = Text::where('section_id',$all['section'])
                ->where('day_num',$all['day_num'])
                ->whereIn('id',explode(",",$engStart))->update(['sync'=>1]);
        }*/

        return redirect('text/'.$parsha_id)->with('success','Information Updated');

    }
} 