<?php

namespace Yonidebleeker\Webinsights;

use Detection\MobileDetect;
use Illuminate\Http\Request;
use Yonidebleeker\Webinsights\Http\Models\Page;
use Yonidebleeker\Webinsights\Http\Models\Pagevisit;
use Yonidebleeker\Webinsights\Http\Models\Visitor;

class Webinsights
{
    protected $detect;

    public function __construct()
    {
        $this->detect = new MobileDetect();
    }

    public function store()
    {
        $request = request();
        $visitor = Visitor::firstOrCreate([
            'cookie' => $this->substractCookie($request->headers->get('cookie')),
            'source' => $request->headers->get('referer'),
            'device_type' => $this->isMobile() ? 'mobile' : 'desktop',
        ]);

        $page = Page::firstOrCreate([
            'url' => $request->url(),
        ]);

        Pagevisit::create([
            'page_id' => $page->id,
            'visitor_id' => $visitor->id,
        ]);

        return response()->json(['message' => 'Page visit stored']);
    }

    /**
     * Get if the visitor is on a mobile device
     */
    private function isMobile()
    {
        try {
            $isMobile = $this->detect->isMobile();

            return $isMobile;
        } catch (\Detection\Exception\MobileDetectException $e) {
            return null;
        }
    }

    /**
     * Substract the cookie from the request headers
     */
    private function substractCookie($cookie)
    {
        $cookies = explode(';', $cookie);
        $cookies = array_map('trim', $cookies);

        // Filter the cookies to find the one with the name 'visitor_id'
        $visitorIdCookie = array_filter($cookies, function ($cookie) {
            return strpos($cookie, 'user_cookie') !== false;
        });

        // If the 'visitor_id' cookie is found, return it; otherwise, return null
        return $visitorIdCookie ? reset($visitorIdCookie) : null;
    }

    /**
     * Get all page visits with their related page and visitor
     */
    public function getAll()
    {
        // Eager load pages and visitors
        $pagevisits = Pagevisit::with('page', 'visitor')->get();

        // Return JSON response
        return response()->json($pagevisits);
    }
}
