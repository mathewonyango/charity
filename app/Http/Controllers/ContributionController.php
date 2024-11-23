<?php

namespace App\Http\Controllers;

use App\Models\Contribution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContributionController extends Controller
{
    public function index()
    {
        $contributions = Contribution::all()->map(function ($contribution) {
            return [
                'id' => $contribution->id,
                'title' => $contribution->title,
                'category' => $contribution->category,
                'goal_amount' => $contribution->goal_amount,
                'description' => $contribution->description,
                'status' => $contribution->status,
                'current_amount' => $contribution->currentAmount(), // No error now
                'is_active' => $contribution->currentAmount() < $contribution->goal_amount && $contribution->end_date && $contribution->end_date->isFuture(),
                'end_date' => $contribution->end_date ? $contribution->end_date->toDateString() : 'N/A',
            ];
        });

        return response()->json([
            'code' => '000',
            'message' => 'Contributions fetched successfully',
            'data' => $contributions,
        ], 200);
    }



    public function userContributions()
    {
        $contributions = Auth::user()->contributions;
        return response()->json([
            'code' => '000',
            'message' => 'User contributions fetched successfully',
            'data' => $contributions,
        ], 200);
    }

    public function store(Request $request)
    {
        // Validate the incoming data
        $validator = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'goal_amount' => 'required|numeric',
            'description' => 'required',
            'duration' => 'required',
            'organizer_name' => 'required|string',
            'organizer_contact' => 'required|string',
            'image' => 'nullable|string', // Accept base64 string for image
        ]);

        if (!$validator) {
            return response()->json([
                'code' => '999',
                'message' => 'Validation error',
            ], 400);
        }



        // Create the contribution record
        $contribution = Contribution::create([
            'title' => $request->title,
            'category' => $request->category,
            'goal_amount' => $request->goal_amount,
            'description' => $request->description,
            'duration' => $request->duration,
            'organizer_name' => $request->organizer_name,
            'organizer_contact' => $request->organizer_contact,
            'user_id' => $request->user_id,
            'status' => 'Ongoing',
            'image' => $request->image, // Save the base64 image in the database
        ]);

        return response()->json([
            'code' => '000',
            'message' => 'Contribution created successfully',
            'data' => $contribution,
        ], 201);
    }



public function portalIndex(Request $request)
{
    // Get the parameters from the request
    $status = $request->get('status'); // Check if 'status' is provided
    $open = $request->get('open'); // Check if 'open' is provided

    $query = Contribution::query();

    // Filter by 'status' only if it's provided
    if ($status !== null) {
        $query->where('status', $status);
    }

    // Filter by 'open' only if it's provided
    if ($open !== null) {
        $query->where('open', $open === '1' ? 1 : 0);
    }

    // Fetch contributions and count
    $contributions = $query->orderBy('created_at', 'desc')->get();
    $contribution_count = $contributions->count();

    // Count contributions by their status
    $open_count = $contributions->where('status', 'open')->count();
    $approved_count = $contributions->where('status', 'approved')->count();
    $pending_count = $contributions->where('status', 'pending')->count();

    // Toast with count and status information
    if ($contribution_count > 0) {
        toast("Total Contributions: {$contribution_count} (Open: {$open_count}, Approved: {$approved_count}, Pending: {$pending_count})", 'success');
    } else {
        toast('No contributions found with the applied filters.', 'error');
    }

    return view('contributions.index', compact('contributions', 'contribution_count'));
}
public function createContribution(){

    return view('contributions.create');
}

public function storeContribution(Request $request){

    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'category' => 'required|string|max:255',
        'goal_amount' => 'required|numeric',
        'description' => 'required|string',
        'duration' => 'required|numeric',
        'organizer_name' => 'required|string|max:255',
        'organizer_contact' => 'required|string|max:255',
        'status' => 'required|string',
        'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        'open' => 'nullable|boolean',
    ]);

    // Handle image upload
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('public/images');
    } else {
        $imagePath = null;
    }
        // dd($validated);

    // Create the contribution
    Contribution::create([
        'title' => $request->title,
        'category' => $request->category,
        'goal_amount' => $request->goal_amount,
        'description' => $request->description,
        'duration' => $request->duration,
        'organizer_name' => $request->organizer_name,
        'organizer_contact' => $request->organizer_contact,
        'status' => $request->status,
        'image' => $request->image ?? null,  // Set to null if image is not provided
        'updated_at' => now(),
        'created_at' => now(),
        'user_id'=>Auth::user()->id,
    ]);


    // Redirect with a success message
    toast("Contribution created successfully!", "success");

    return redirect()->route('portal.Pcontributions.index');

}

public function viewEdit($id){
    $contribution = Contribution::findOrFail($id);

    return view('contributions.edit',compact('contribution'));
}

public function update(Request $request, $id)
    {
        // Validate the input data
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'goal_amount' => 'required|numeric',
            'duration' => 'required|integer',
            'description' => 'required|string',
            'organizer_name' => 'required|string|max:255',
            'organizer_contact' => 'required|string|max:255',
            'status' => 'required|string|in:active,inactive',
        ]);

        // Find the contribution by ID
        $contribution = Contribution::findOrFail($id);

        // Update the contribution's details
        $contribution->update($request->all());
        toast( 'Contribution updated successfully.','success',);

        // Redirect back to the index page or another desired page
        return redirect()->route('portal.Pcontributions.index');
    }

    public function toggleStatus($id)
{
    // Find the contribution by ID
    $contribution = Contribution::findOrFail($id);

    // Toggle the status
    $newStatus = $contribution->status === 'approved' ? 'pending' : 'approved';
    $contribution->status = $newStatus;

    // Save the updated status
    $contribution->save();

    // Flash a success message
    toast( "Contribution status changed to '{$newStatus}'.",'success',);

    return redirect()->back();
}

}


