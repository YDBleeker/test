<?php

namespace Yonidebleeker\Webinsights\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Yonidebleeker\Webinsights\Http\Models\Visitor;
use Yonidebleeker\Webinsights\Http\Models\Pagevisit;
use Yonidebleeker\Webinsights\Http\Models\Page;
use Illuminate\Support\Facades\DB;
use Detection\MobileDetect;

class WebinsightsController extends Controller
{

    // try {
    //     $isMobile = $detect->isMobile(); // bool(false)
    //     var_dump($isMobile);
    // } catch (\Detection\Exception\MobileDetectException $e) {
    // }
    // try {
    //     $isTablet = $detect->isTablet(); // bool(false)
    //     var_dump($isTablet);
    // } catch (\Detection\Exception\MobileDetectException $e) {
    // }

    public function index()
    {
        return view('webinsights::dashboard');
    }

    // public function store(Request $request)
    // {
    //     $visitor = Visitor::firstOrCreate([
    //         'cookie' => $request->cookie,
    //         'source' => $request->source,
    //         'device_type' => $request->device_type,
    //     ]);

    //     $page = Page::firstOrCreate([
    //         'url' => $request->url,
    //     ]);

    //     Pagevisit::create([
    //         'page_id' => $page->id,
    //         'visitor_id' => $visitor->id,
    //     ]);

    //     return response()->json(['message' => 'Page visit stored']);
    // }

    // private function desktop_or_mobile($request)
    // {
    //     //$agent = new Agent();
    //     //return $agent->isMobile() ? 'mobile' : 'desktop';
    // }

    public function get_data($start_date = null, $end_date = null)
    {
        $detect = new MobileDetect();
        var_dump($detect->getUserAgent()); // "Mozilla/5.0 (Windows NT 10.0; Win64; x64) ..."
        
        $mostPageViews = $this->getPageViews('desc', $start_date, $end_date);
        $leastPageViews = $this->getPageViews('asc', $start_date, $end_date);
        $averageVisitorsEachDay = $this->getVisitors($start_date, $end_date);
        $bounce_rate = 0; //berekend worden
        $average_time = 0; //tijden optellen
        $desktop_and_mobile_visitors = $this->getPercentageDesktopMobile($start_date, $end_date);

        dd($mostPageViews, $leastPageViews, $averageVisitorsEachDay, $bounce_rate, $average_time, $desktop_and_mobile_visitors);

        return view('webinsights::dashboard', [
            'mostPageViews' => $mostPageViews,
            'leastPageViews' => $leastPageViews,
            'averageVisitorsEachDay' => $averageVisitorsEachDay,
            'bounce_rate' => $bounce_rate,
            'average_time' => $average_time,
            'desktop_and_mobile_visitors' => $desktop_and_mobile_visitors,
        ]);

    }

    /**
     * Get the top 5 pages with the most or least views
     */
    private function getPageViews($orderBy = 'desc', $start_date = null, $end_date = null)
    {
        $query = Pagevisit::query()->with('page')
            ->select('page_id', DB::raw('COUNT(*) as count'));

        if ($start_date && $end_date) {
            $query->whereBetween('created_at', [$start_date, $end_date]);
        }

        $query->groupBy('page_id')
            ->orderByRaw('COUNT(*) ' . strtoupper($orderBy))
            ->limit(5);

        $pageViews = $query->get();

        return $this->transformPageViews($pageViews);
    }

    /**
     * Transform the page views to a more readable format
     */
    private function transformPageViews($pageViews)
    {
        return $pageViews->map(function ($pageView) {
            return [
                'name' => $pageView->page->name,
                'count' => $pageView->count,
            ];
        });
    }

    /**
     * Get the average number of visitors in a specific time frame each day
     */
    private function getVisitors($start_date = null, $end_date = null)
    {
        $query = Visitor::query()
            ->select(DB::raw('COUNT(*) as count'));

        if ($start_date && $end_date) {
            $query->whereBetween('created_at', [$start_date, $end_date]);
        }

        $query->groupBy(DB::raw('DATE(created_at)'));

        return $query->count();
    }

/**
 * Get the percentage of desktop and mobile visitors
 */
private function getVisitorsByDeviceType($deviceType, $start_date = null, $end_date = null)
{
    $query = Visitor::query()
        ->where('device_type', $deviceType);

    if ($start_date && $end_date) {
        $query->whereBetween('created_at', [$start_date, $end_date]);
    }

    return $query->count();
}

/**
 * Get the percentage of desktop and mobile visitors
 */
private function getPercentageDesktopMobile($start_date = null, $end_date = null)
{
    $desktopVisitors = $this->getVisitorsByDeviceType('desktop', $start_date, $end_date);
    $mobileVisitors = $this->getVisitorsByDeviceType('mobile', $start_date, $end_date);

    $totalVisitors = $desktopVisitors + $mobileVisitors;

    // Check if total visitors is zero to avoid division by zero
    if ($totalVisitors == 0) {
        return ['desktop' => 0, 'mobile' => 0];
    }

    return [
        'desktop' => ($desktopVisitors / $totalVisitors) * 100,
        'mobile' => ($mobileVisitors / $totalVisitors) * 100,
    ];
}






}
