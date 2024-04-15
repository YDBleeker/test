<?php

namespace Yonidebleeker\Webinsights\Models;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $table = 'pages';
    protected $fillable = ['url'];

    // Add any additional methods or relationships here
}