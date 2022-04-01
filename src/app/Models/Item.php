<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    public $timestamps = false;//暗黙的にタイムスタンプをする機能をオフにする

    protected $fillable = [
        'item_title',
        'item_explain',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
