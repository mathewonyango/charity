<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\Contribution
;




class EventController extends Controller
{
    public function index()
    {
        $events = Event::all()->map(function ($event) {
            return [
                'id' => $event->id,
                'title' => $event->title,
                'description' => $event->description,
                'category' => $event->category,
                'type' => $event->type,
                'start_date' => $event->start_date,
                'end_date' => $event->end_date,
                'time' => $event->time,
                'venue' => $event->venue,
                'map_link' => $event->map_link,
                'banner_image' => $event->banner_image,
                'organizer_name' => $event->organizer_name,
                'organizer_contact_info' => $event->organizer_contact_info, // Added for contact details
                'event_coordinators' => $event->event_coordinators, // Added for event coordinators
                'ticket_price' => $event->ticket_price, // Added for ticket price
                'registration_deadline' => $event->registration_deadline, // Added for registration deadline
                'event_capacity' => $event->event_capacity, // Added for event capacity
                'is_active' => $event->is_active, // Include is_active status
            ];
        });

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
        // Validate the incoming data, adding the new fields to the validation rules
        $validator = $request->validate([
            'title' => 'required|string|max:255', // Event Title
            'description' => 'required', // Event Description
            'category' => 'required|string', // Event Category
            'type' => 'required|string', // Event Type (Online or In-Person)
            'start_date' => 'required|date', // Event Start Date
            'end_date' => 'required|date|after_or_equal:start_date', // Event End Date
            'time' => 'required|string', // Event Time
            'venue' => 'required|string', // Event Venue (Location/Address)
            'map_link' => 'nullable|url', // Map Link (Optional)
            'banner_image' => 'nullable|string', // Event Banner Image (Base64 string or file path)
            'organizer_name' => 'required|string', // Organizer Name
            'user_id' => 'required|integer|exists:users,id', // Ensure User exists in Users table
            'organizer_contact_info' => 'nullable|string', // Contact Information (Email or Phone)
            'event_coordinators' => 'nullable|array', // Event Coordinators (Can store as array or JSON)
            'ticket_price' => 'nullable|numeric', // Ticket Price
            'registration_deadline' => 'nullable|date', // Registration Deadline
            'event_capacity' => 'nullable|integer', // Event Capacity
        ]);

        if (!$validator) {
            return response()->json([
                'code' => '999',
                'message' => 'Validation error',
            ], 400);
        }

        // Check if user exists
        $creator = User::find($request->user_id);

        if (!$creator) {
            return response()->json([
                'message' => 'User does not exist!',
            ], 404);
        }

        // Handle optional banner image
        $bannerImage = $request->banner_image ?? null;

        // Handle the new fields
        $organizerContactInfo = $request->organizer_contact_info ?? null;
        $eventCoordinators = $request->event_coordinators ? json_encode($request->event_coordinators) : null; // Store as JSON
        $ticketPrice = $request->ticket_price ?? null;
        $registrationDeadline = $request->registration_deadline ?? null;
        $eventCapacity = $request->event_capacity ?? null;

        // Create the event
        $event = Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'type' => $request->type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'time' => $request->time,
            'venue' => $request->venue,
            'map_link' => $request->map_link,
            'banner_image' => $bannerImage,
            'organizer_name' => $request->organizer_name,
            'user_id' => $request->user_id,
            'organizer_contact_info' => $organizerContactInfo,
            'event_coordinators' => $eventCoordinators,
            'ticket_price' => $ticketPrice,
            'registration_deadline' => $registrationDeadline,
            'event_capacity' => $eventCapacity,
            'status' => 'Ongoing',
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
        toast( 'Event filtered successfully!','success',);


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
            toast( 'Event created successfully!','success',);
            return redirect()->route('portal.Pevents.index');
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


public function edit($id)
{
    $event = Event::findOrFail($id); // Fetch the event
    // dd($event);
    return view('events.edit', compact('event'));
}

// Update the event in the database
public function update(Request $request, $id)
{

    // dd($request);
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'category' => 'required|string|max:255',
        'type' => 'required|string|max:255',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'time' => 'nullable',
        'venue' => 'nullable|string|max:255',
        'map_link' => 'nullable|url',
        'organizer_name' => 'required|string|max:255',
        'organizer_contact_info' => 'nullable|json',
        'event_coordinators' => 'nullable|json',
        'ticket_price' => 'nullable|numeric|min:0',
        'registration_deadline' => 'nullable|date|before_or_equal:end_date',
        'event_capacity' => 'nullable|integer|min:1',
        'status' => 'required|in:pending,approved,cancelled',
    ]);

    $event = Event::findOrFail($id);
    $event->update($validated); // Update the event with validated data

    return redirect()->route('portal.Pevents.index')->with('success', 'Event updated successfully.');
}


}
