<?php

namespace Yonidebleeker\Webinsights\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Yonidebleeker\Webinsights\Http\Models\Pagevisit;

class Page extends Model
{
    protected $table = 'pages';
    protected $fillable = ['url'];

    // Add any additional methods or relationships here
    public function pagevisits()
    {
        return $this->hasMany(Pagevisit::class);
    }
}
