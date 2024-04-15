<?php

namespace Yonidebleeker\Webinsights\Models;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $table = 'pagevisits';
    protected $fillable = ['page_id', 'visitor_id'];

    // Add any additional methods or relationships here
}