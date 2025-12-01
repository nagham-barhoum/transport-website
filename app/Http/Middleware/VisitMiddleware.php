<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\VisitLog; // Assuming you have a VisitLog model
use Spatie\Referer\Referer;
use Stevebauman\Location\Facades\Location; // For getting visitor location

class VisitMiddleware
{
    protected $referer;

    public function __construct(Referer $referer)
    {
        $this->referer = $referer;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get visitor IP address
        $ip = $request->ip();

        // Get visitor location (country) using IP address
        $location = Location::get($ip);
        $country = $location ? $location->countryName : 'Unknown';

        // Get referer (source URL)
        $referer = $request->header('referer');

        // Get user agent (device/browser info)
        $userAgent = $request->header('User-Agent');
        $city = $location ? $location->cityName : 'Unknown';
        // Detect the source (e.g., WhatsApp, Google)
        $source = $this->detectSource($referer, $userAgent);

        // Log the visit
        VisitLog::create([
            'ip_address' => $ip,
            'country' => $country,
            'referer' => $referer,
            'city' => $city,
            'source' => $source,
            'user_agent' => $userAgent,
            'visited_at' => now(),
        ]);

        return $next($request);
    }

    private function detectSource($referer, $userAgent)
    {
        // Check Referer first
        if ($referer) {
            // Detect Facebook
            if (str_contains($referer, 'facebook.com') || str_contains($referer, 'm.facebook.com')) {
                return 'Facebook';
            }

            // Detect Instagram
            if (str_contains($referer, 'instagram.com')) {
                return 'Instagram';
            }

            // Detect Google
            if (str_contains($referer, 'google.com')) {
                return 'Google';
            }

             // Detect Ebay kleineanzeige
             if (str_contains($referer, 'kleinanzeigen.de') || str_contains($referer, 'kleinanzeigen')) {
                return 'Ebay_kleineanzeige';
            }
        }

        // Fallback to User-Agent if Referer is not available
        if (str_contains($userAgent, 'WhatsApp')) {
            return 'WhatsApp';
        }

        // Default to 'Other' or 'Direct'
        return $referer ? 'Other' : 'Direct';
    }
}
