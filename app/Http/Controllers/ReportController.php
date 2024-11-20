<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Contribution;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function portalReport()
    {
        // Get the data for the reports (example for events status)
        $eventsStatus = Event::selectRaw('status, COUNT(*) as total')
                             ->groupBy('status')
                             ->get();

        // Example for contributions status
        $contributionsStatus = Contribution::selectRaw('status, COUNT(*) as total')
                                           ->groupBy('status')
                                           ->get();

        // Example for users by role
        $usersByRole = User::selectRaw('role, COUNT(*) as total')
                           ->groupBy('role')
                           ->get();

        // Get the event summary (upcoming, ongoing, past)
        $currentDate = now()->toDateString();
        $upcomingEvents = Event::where('start_date', '>', $currentDate)->count();
        $ongoingEvents = Event::where('start_date', '<=', $currentDate)
                              ->where('end_date', '>=', $currentDate)
                              ->count();
        $pastEvents = Event::where('end_date', '<', $currentDate)->count();

        // Return view with data
        return view('reports.index', compact('eventsStatus', 'contributionsStatus', 'usersByRole', 'upcomingEvents', 'ongoingEvents', 'pastEvents'));
    }
}
