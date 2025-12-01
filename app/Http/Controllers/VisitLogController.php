<?php

namespace App\Http\Controllers;

use App\Http\Requests\VisitLogRequest;
use App\Models\Entsorgung;
use App\Models\Transport;
use App\Models\umzuge;
use App\Models\VisitLog;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VisitLogController extends Controller
{
    public function getReviewStats(Request $request)
    {
        // Validate query parameters
        $request->validate([
            'date'  => 'nullable|date_format:Y-m-d',
            'month' => 'nullable|date_format:Y-m',
            'year'  => 'nullable|date_format:Y-m-d',
        ]);

        // Check which parameters are provided
        $hasDate  = $request->filled('date');
        $hasMonth = $request->filled('month');
        $hasYear  = $request->filled('year');
        $anyParam = $hasDate || $hasMonth || $hasYear;


        // Compute year_stat if 'year' is provided or no parameters
        if ($hasYear || !$anyParam) {
            $year = $hasYear ? Carbon::parse($request->year) : Carbon::now();
            $stats = [
                'umzuge_count'      => Umzuge::whereYear('created_at', $year->year)->count(),
                'transport_count'   => Transport::whereYear('created_at', $year->year)->count(),
                'entsorgung_count'  => Entsorgung::whereYear('created_at', $year->year)->count(),
                'google_count'      => VisitLog::whereYear('visited_at', $year->year)->where('source', 'Google')->count(),
                'facebook_count'    => VisitLog::whereYear('visited_at', $year->year)->where('source', 'Facebook')->count(),
                'instagram_count'   => VisitLog::whereYear('visited_at', $year->year)->where('source', 'Instagram')->count(),
                'other_count'       => VisitLog::whereYear('visited_at', $year->year)->whereNotIn('source', ['Google', 'Facebook', 'Instagram', 'WhatsApp', 'Ebay'])->count(),
            ];
            $this->computeYearlyStats($year, $stats);
        }


        // Compute month_stat if 'month' is provided or no parameters
        if ($hasMonth || !$anyParam) {
            $month = $hasMonth ? Carbon::parse($request->month) : Carbon::now();
            $stats = [
               //some_code
            ];
            $this->computeMonthlyStats($month, $stats);
        }

        // Compute day_stat if 'date' is provided or no parameters
        if ($hasDate || !$anyParam) {
            $date = $hasDate ? Carbon::parse($request->date) : Carbon::today();
            $stats = [
            //some_code
            ];
            $this->computeDailyStats($date, $stats);
        }
        return response()->json($stats);
    }

// some private function
}
