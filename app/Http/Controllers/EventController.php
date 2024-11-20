<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;




class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return response()->json([
            'code' => '000',
            'message' => 'Events fetched successfully',
            'data' => $events,
        ], 200);
    }


    public function userEvents(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id', // Validate user_id exists
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => '999',
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 400);
        }

        // Fetch the user and their events
        $user = User::find($request->user_id);
        $events = $user->events;

        return response()->json([
            'code' => '000',
            'message' => 'User events fetched successfully',
            'data' => $events,
        ], 200);
    }


    public function store(Request $request)
    {
        $validator = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'category' => 'required|string',
            'type' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'venue' => 'required|string',
        ]);

        if (!$validator) {
            return response()->json([
                'code' => '999',
                'message' => 'Validation error',
            ], 400);
        }
        $creatorId=User::where('id',$request->user_id)->first();

        if(!$creatorId){
            return response()->json([
                'message'=>'user not found'
            ]);
        }

        $event = Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'type' => $request->type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'venue' => $request->venue,
            'creator_id' => $request->creator_id,
            'status' => 'Ongoing',
            // 'created_by' => $request->user_id,

        ]);

        return response()->json([
            'code' => '000',
            'message' => 'Event created successfully',
            'data' => $event,
        ], 201);
    }



    public function portalIndex(Request $request)
    {
        $status = $request->get('status', 'pending');
        $filter = $request->get('filter', ''); // Ongoing, past, or upcoming filter.

        // Get the current date with the timezone set to Africa/Nairobi
        $currentDate = Carbon::today('Africa/Nairobi'); // Ensures correct comparison based on timezone

        $query = Event::query();

        // Handle ongoing, past, and upcoming filters using Carbon
        if ($filter === 'ongoing') {
            // Ongoing filter logic: Events where the start date is in the past or today,
            // and the end date is in the future or today.
            $query->whereDate('start_date', '<=', $currentDate)
                  ->whereDate('end_date', '>=', $currentDate);
        } elseif ($filter === 'past') {
            // Past filter logic: Events where the end date is strictly before today.
            $query->whereDate('end_date', '<', $currentDate);
        } elseif ($filter === 'upcoming') {
            // Upcoming filter logic: Events where the start date is strictly after today.
            $query->whereDate('start_date', '>', $currentDate);
        }

        // Debugging: Log the query to check what it is selecting
        Log::info("Final Query: " . $query->toSql());
        Log::info("Query bindings: " . json_encode($query->getBindings()));

        // Fetch the events based on the filter
        $events = $query->orderBy('created_at', 'desc')->get();
        $events_count = $events->count();

        return view('events.index', compact('events', 'events_count', 'status', 'filter'));
    }






    public function portalEventStore(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'venue' => 'required|string|max:255',
        ]);

        $creatorId=Auth::user()->id;


            // Create the event
            $event = Event::create([
                'title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'category' => $validatedData['category'],
                'type' => $validatedData['type'],
                'start_date' => $validatedData['start_date'],
                'end_date' => $validatedData['end_date'],
                'venue' => $validatedData['venue'],
                'creator_id' => $creatorId,
                'status' => 'Ongoing',
                'user_id'=>$creatorId
            ]);

            // Redirect or respond with success
            return redirect()->route('portal.Pevents.index')
                             ->with('success', 'Event created successfully!');

    }



public function toggleStatus($id)
{
    $event = Event::findOrFail($id);

    // Toggle the status between 'approved' and 'pending'
    $newStatus = $event->status === 'approved' ? 'pending' : 'approved';
    $event->status = $newStatus;

    // Save the updated status
    $event->save();

    // Flash a success message
    // session()->flash('success', "Event status changed to '{$newStatus}'.");
    toast('Event status changed to successfully','success');

    return redirect()->back();
}

public function portalCreateEvent(){
    return view('events.create');
}

}
