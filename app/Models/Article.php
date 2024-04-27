<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable = ['id', 'title', 'content', 'category', 'status', 'created_date', 'updated_date'];
    protected $primaryKey = 'id';
    protected $timestamp = ['updated_date', 'created_date'];
}
