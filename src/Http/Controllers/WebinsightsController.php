<?php

namespace Yonidebleeker\Webinsights\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yonidebleeker\Webinsights\Http\Models\Page;
use Yonidebleeker\Webinsights\Http\Models\Pagevisit;
use Yonidebleeker\Webinsights\Http\Models\Visitor;

class WebinsightsController extends Controller
{
    /*
    * Get the data for the dashboard
    */
    public function get_data($start_date = null, $end_date = null)
    {
        $mostPageViews = $this->getPageViews('desc', $start_date, $end_date);
        $leastPageViews = $this->getPageViews('asc', $start_date, $end_date);
        $averageVisitorsEachDay = $this->getVisitors($start_date, $end_date);
        $bounce_rate = $this->getBounceRate($start_date, $end_date);
        $average_time = $this->getAverageTime($start_date, $end_date);
        $desktop_and_mobile_visitors = $this->getPercentageDesktopMobile($start_date, $end_date);

        //dd($mostPageViews, $leastPageViews, $averageVisitorsEachDay, $bounce_rate, $average_time, $desktop_and_mobile_visitors);

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
            ->orderByRaw('COUNT(*) '.strtoupper($orderBy))
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
                'name' => $pageView->page->url,
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

    /**
     * Get the average time a visitor spent on a website
     */
    private function getAverageTime($start_date = null, $end_date = null)
    {
        $query = Pagevisit::query()
            ->select('visitor_id', 'created_at')
            ->orderBy('created_at');

        if ($start_date && $end_date) {
            $query->whereBetween('created_at', [$start_date, $end_date]);
        }

        $pageVisits = $query->get(); // Fetch the results
        $visitors = $query->groupBy('visitor_id')->get(); // Fetch the results

        $averageTime = 0;

        foreach ($visitors as $visitor) {
            // Look for the first and last visit in $pageVisits
            $firstVisit = $pageVisits->where('visitor_id', $visitor->visitor_id)->last();
            $lastVisit = $pageVisits->where('visitor_id', $visitor->visitor_id)->first();

            $averageTime += $lastVisit->created_at->diffInMinutes($firstVisit->created_at);
        }

        // Calculate the average time
        return count($visitors) > 0 ? round($averageTime / count($visitors), 2) : 0;
    }

    /**
     * Get the bounce rate of the website
     */
    private function getBounceRate($start_date = null, $end_date = null)
    {
        $query = Pagevisit::query()
            ->selectRaw('COUNT(visitor_id) as count, visitor_id, created_at')
            ->orderBy('created_at');

        if ($start_date && $end_date) {
            $query->whereBetween('created_at', [$start_date, $end_date]);
        }

        $query->groupBy('visitor_id');

        $totalVisitors = $query->count();
        $singlePageVisits = $query->having('count', '=', 1)->count();

        // Ensure to handle the case where totalVisitors is 0 to avoid division by zero
        $bounceRate = ($totalVisitors > 0) ? $singlePageVisits / $totalVisitors : 0;

        return $bounceRate;
    }
}
