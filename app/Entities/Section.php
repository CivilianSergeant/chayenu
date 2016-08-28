<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 8/25/16
 * Time: 2:12 PM
 */

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{

    protected $table = "sections";

    protected $fillable = ['title', 'parsha_id', 'order', 'last_action', 'sync'];
} 