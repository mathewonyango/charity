<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contribution;
use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;


class DashboardController extends Controller
{
    public function dashboard()
{
    // Fetch total contributions (assuming a 'contributions' table)
    $totalContributions = Contribution::count();

    // Fetch total events
    $totalEvents = Event::count();

    // Fetch total users
    $totalUsers =User::count();

    // Fetch pending and approved contributions
    $pendingContributions = Contribution::where('status', 'pending')->count();
    $approvedContributions = Contribution::where('status', 'ongoing')->count();

    // Fetch ongoing and completed events

    $ongoingEvents = Event::where('end_date', '>', Carbon::now())->count();
    // dd($ongoingEvents);
    $completedEvents = Event::where('end_date', '<=', Carbon::now())->count();
    //  dd($completedEvents);


    $activeUsers=User::where('status','active')->count();
    $inactiveUsers=User::where('status','inactive')->count();


 $users_data = [
        'labels' => ['active', 'inactive'],
        'values' => [$activeUsers, $inactiveUsers]
    ];

    // Prepare chart datasets
    $contributions_data = [
        'labels' => ['Pending', 'Approved'],
        'values' => [$pendingContributions, $approvedContributions]
    ];

    $events_data = [
        'labels' => ['Ongoing', 'Completed'],
        'values' => [$ongoingEvents, $completedEvents]
    ];

    $approved_contributions_data=Contribution::where('status','approved')->count();
    $not_approved_contributions_data=Contribution::where('status','pending')->count();

    // Return data to the dashboard view
    return view('dashboard', [
        'totalContributions' => $totalContributions,
        'ongoingEvents' => $ongoingEvents,
        'totalEvents' => $totalEvents,
        'totalUsers' => $totalUsers,
        'contributions_data' => $contributions_data,
        'events_data' => $events_data,
        'users_data'=>$users_data,
        'not_approved_contributions_data'=>$not_approved_contributions_data,
        'approved_contributions_data'=>$approved_contributions_data
    ]);
}


}
