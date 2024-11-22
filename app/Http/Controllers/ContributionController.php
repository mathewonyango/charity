<?php

namespace App\Http\Controllers;

use App\Models\Contribution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ContributionController extends Controller
{
    public function index()
    {
        $contributions = Contribution::all();
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

    public function create(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'goal_amount' => 'required|numeric',
            'description' => 'required',
            'duration' => 'required|date',
            'organizer_name' => 'required|string',
            'organizer_contact' => 'required|string',
            'image' => 'nullable|string', // Accept base64 string for image
        ]);

        // Process the image (if it exists and is base64 encoded)
        $image = null;
        if ($request->has('image')) {
            // Validate and process the base64 image string
            $imageData = $request->image;
            $image = base64_decode($imageData); // Decode the base64 image

            // Generate a unique name for the image and store it in the public/images directory
            $imageName = uniqid() . '.png'; // Or use the appropriate extension
            Storage::disk('public')->put('images/' . $imageName, $image);

            // You can store the image path in the database (e.g., 'public/images/...')
            $imagePath = 'images/' . $imageName;
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
            'image' => $imagePath ?? null, // Store the image path or null
        ]);

        return response()->json([
            'code' => '000',
            'message' => 'Contribution created successfully',
            'data' => $contribution,
        ], 201);
    }

    public function portalIndex(Request $request)
    {
        $status = $request->get('status');
        $open = $request->get('open');

        $query = Contribution::query();

        // Filter by 'status' only if it's provided
        if ($status !== null) {
            $query->where('status', $status);
        }

        // Filter by 'open' only if it's provided
        if ($open !== null) {
            $query->where('open', $open === '1' ? 1 : 0);
        }

        $contributions = $query->orderBy('created_at', 'desc')->get();
        $contribution_count = $contributions->count();

        // Count contributions by their status
        $open_count = $contributions->where('status', 'open')->count();
        $approved_count = $contributions->where('status', 'approved')->count();
        $pending_count = $contributions->where('status', 'pending')->count();

        if ($contribution_count > 0) {
            toast("Total Contributions: {$contribution_count} (Open: {$open_count}, Approved: {$approved_count}, Pending: {$pending_count})", 'success');
        } else {
            toast('No contributions found with the applied filters.', 'error');
        }

        return view('contributions.index', compact('contributions', 'contribution_count'));
    }

    public function createContribution()
    {
        return view('contributions.create');
    }

    public function storeContribution(Request $request)
    {
        // Validate the request data
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
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
        }

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
            'image' => $imagePath, // Store the image path in the database
            'user_id' => Auth::user()->id,
        ]);

        toast("Contribution created successfully!", "success");

        return redirect()->route('portal.Pcontributions.index');
    }

    public function viewEdit($id)
    {
        $contribution = Contribution::findOrFail($id);
        return view('contributions.edit', compact('contribution'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'category' => 'required|string|max:255',
            'goal_amount' => 'required|numeric',
            'duration' => 'required|integer',
            'description' => 'required|string',
            'organizer_name' => 'required|string|max:255',
            'organizer_contact' => 'required|string|max:255',
            'status' => 'required|string|in:active,inactive',
        ]);

        $contribution = Contribution::findOrFail($id);
        $contribution->update($request->all());
        toast('Contribution updated successfully.', 'success');

        return redirect()->route('portal.Pcontributions.index');
    }

    public function toggleStatus($id)
    {
        $contribution = Contribution::findOrFail($id);
        $newStatus = $contribution->status === 'approved' ? 'pending' : 'approved';
        $contribution->status = $newStatus;
        $contribution->save();

        toast("Contribution status changed to '{$newStatus}'.", 'success');
        return redirect()->back();
    }
}
