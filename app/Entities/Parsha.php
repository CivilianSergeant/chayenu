<?php
namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Parsha extends Model
{
	protected $table = "parshas";

    protected $fillable=['parsha_name','start_date','end_date','last_action','sync'];
}