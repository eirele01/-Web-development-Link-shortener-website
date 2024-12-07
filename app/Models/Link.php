<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    // Define which columns are fillable for mass assignment
    protected $fillable = ['original_url', 'shortened_url'];

    // Define the table if it's not the plural of the model name
    protected $table = 'links';
}
