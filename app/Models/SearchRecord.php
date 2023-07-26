<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchRecord extends Model
{
    protected $fillable = ["keyword","user_id"];
    use HasFactory;
}
