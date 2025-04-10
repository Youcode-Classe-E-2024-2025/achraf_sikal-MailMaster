<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\NewsletterResource;

class NewsletterController extends Controller
{
    // Display a listing of the newsletters
    public function index()
    {
        $newsletters = Newsletter::all(); // You can paginate if necessary
        return NewsletterResource::collection($newsletters);
    }

    // Store a newly created newsletter
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'user_id' => 'required|exists:users,id',  // Ensure the user exists
        ]);

        $newsletter = Newsletter::create($validated);

        return response()->json(new NewsletterResource($newsletter), 201);
    }

    // Display the specified newsletter
    public function show(Newsletter $newsletter)
    {
        return new NewsletterResource($newsletter);
    }

    // Update the specified newsletter
    public function update(Request $request, Newsletter $newsletter)
    {
        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
        ]);

        $newsletter->update($validated);

        return response()->json(new NewsletterResource($newsletter), 200);
    }

    // Remove the specified newsletter
    public function destroy(Newsletter $newsletter)
    {
        $newsletter->delete();

        return response()->json(null, 204);
    }
}
