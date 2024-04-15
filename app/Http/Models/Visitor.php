<?php

namespace Yonidebleeker\Webinsights\Models;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $table = 'visitors';
    protected $fillable = ['cookie, source, device_type'];

    // Add any additional methods or relationships here
}