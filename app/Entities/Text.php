<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 8/26/16
 * Time: 11:21 PM
 */

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Text extends Model{
    protected $table="text";
    protected $fillable=['section_id','parsha_id','day_num','order','text_eng','text_heb','text_both','sync','last_action'];
} 