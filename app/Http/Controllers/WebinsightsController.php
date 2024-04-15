<?php

namespace Yonidebleeker\Webinsights\App\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Yonidebleeker\Webinsights\Models\Visitor;
use Yonidebleeker\Webinsights\Models\Pagevisit;
use Yonidebleeker\Webinsights\Models\Page;

class WebinsightsController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function store(Request $request)
    {
        $visitor = Visitor::firstOrCreate([
            'cookie' => $request->cookie,
            'source' => $request->source,
            'device_type' => $request->device_type,
        ]);

        $page = Page::firstOrCreate([
            'url' => $request->url,
        ]);

        Pagevisit::create([
            'page_id' => $page->id,
            'visitor_id' => $visitor->id,
        ]);

        return response()->json(['message' => 'Page visit stored']);
    }

    private function desktop_or_mobile($request)
    {
        //$agent = new Agent();
        //return $agent->isMobile() ? 'mobile' : 'desktop';
    }

    public function get_data($start_date, $end_date)
    {
        $mostPageViews = 0;
        $leastPageViews = 0;
        $visitors = 0; //gemiddelde aantal bezoekers per dag???
        $bounce_rate = 0;
        $average_time = 0; //tijden optellen 
        $desktop_visitors = 0; //count 
        $mobile_visitors = 0; //count 
        

        return view('dashboard', [
            'mostPageViews' => $mostPageViews,
            'leastPageViews' => $leastPageViews,
            'visitors' => $visitors,
            'bounce_rate' => $bounce_rate,
            'average_time' => $average_time,
            'desktop_visitors' => $desktop_visitors,
            'mobile_visitors' => $mobile_visitors
        ]);
        
    }
}