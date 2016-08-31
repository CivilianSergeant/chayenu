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
use DB;
class TextController extends Controller{

    public function save(Request $request)
    {
        $all = $request->all();


        
        $section = $all['section'];
        $day_num = $all['day_num'];
        $parsha_id = $all['parsha_id'];
        $englishOnly = (!empty($all['englishOnly']))? $all['englishOnly'] : null;
        $hebTexts = (!empty($all['heb']))? $all['heb'] : null;
        $engTexts = (!empty($all['eng']))? $all['eng'] : null;
        $deletedItem = (!empty($all['deletedItem']))? $all['deletedItem'] : null;
        $sync = (!empty($all['sync']))? $all['sync'] : null;

        $englishOnlyNew = (!empty($all['englishOnlyNew']))? $all['englishOnlyNew'] : null;
        $eng_new = (!empty($all['eng_new']))? $all['eng_new'] : null;
        $heb_new = (!empty($all['heb_new']))? $all['heb_new'] : null;
        $deletedItem_new = (!empty($all['deletedItem_new']))? $all['deletedItem_new'] : null;
        $sync_new = (!empty($all['sync_new']))? $all['sync_new'] : null;

        if(!empty($englishOnly)){
            foreach($englishOnly as $id=> $engOnly){
                $text = Text::find($id);
                    if(!empty($text)){

                    $text->text_both = $engOnly;
                    $text->text_eng = '';
                    $text->text_heb = '';
                    $text->parsha_id = $parsha_id;
                    if(!empty($deletedItem) && !empty($deletedItem[$id])){
                        if($deletedItem[$id]!=0)
                            $text->last_action="delete";
                        else
                            $text->last_action="update";
                    }

                    if(!empty($sync) && !empty($sync[$id])){
                        $text->sync = 1;
                    }

                    $text->save();
                }
            }
        }

        if(!empty($hebTexts)){
            foreach($hebTexts as $id => $heb){
                $text = Text::find($id);
                if(!empty($text)){
                    $eng = (!empty($engTexts) && !empty($engTexts[$id]))? $engTexts[$id]: null;
                    $text->text_eng = $eng;
                    $text->text_heb = $heb;
                    $text->text_both = '';

                    $text->parsha_id = $parsha_id;
                    if(!empty($deletedItem) && !empty($deletedItem[$id])){
                        if($deletedItem[$id]!=0)
                            $text->last_action="delete";
                        else
                            $text->last_action="update";
                    }

                    if(!empty($sync) && !empty($sync[$id])){
                        $text->sync = 1;
                    }

                    $text->save();
                }
            }
        }

        // new english only sub sections
        if(!empty($englishOnlyNew)){
            $order = Text::select(DB::raw('max(`order`) as `order`'))
                ->where('section_id',$section)
                ->where('day_num',$day_num)->first();
            $order = (!empty($order))? (($order->order)+1) : 1;
            foreach($englishOnlyNew as $i => $engOnlyNew){
                $order++;
                $text = new Text();
                $text->section_id = $section;
                $text->day_num = $day_num;
                $text->order = $order;
                $text->text_both = $engOnlyNew;
                $text->sync = (!empty($sync_new[$i]))? 1 : 0;
                $text->last_action = (!empty($deletedItem_new[$i]) && $deletedItem_new[$i] != 0)? 'delete':'insert';
                $text->save();
            }
        }

        // new heb or english sub sections
        if(!empty($heb_new)){
            $order = Text::select(DB::raw('max(`order`) as `order`'))->where('section_id',$section)
                ->where('day_num',$day_num)->first();
            $order = (!empty($order))? (($order->order)+1) : 1;
            foreach($heb_new as $id => $h_n){
                    $order++;
                    $text = new Text();

                    $eng = (!empty($eng_new) && !empty($eng_new[$id]))? $eng_new[$id]: null;
                    $text->text_eng = $eng;
                    $text->text_heb = $h_n;
                    $text->text_both = '';
                    $text->section_id = $section;
                    $text->day_num = $day_num;
                    $text->parsha_id = $parsha_id;
                    $text->order = $order;
                    if(!empty($deletedItem_new) && !empty($deletedItem_new[$id])){
                        if($deletedItem_new[$id]!=0)
                            $text->last_action="delete";
                        else
                            $text->last_action="update";
                    }

                    if(!empty($sync_new) && !empty($sync_new[$id])){
                        $text->sync = 1;
                    }else{
                        $text->sync = 0;
                    }

                    $text->save();

            }
        }

        return redirect('text/'.$parsha_id)->with('success','Information Updated');

    }
} 