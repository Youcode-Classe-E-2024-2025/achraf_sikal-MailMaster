<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\NewsletterResource;

class NewsletterController extends Controller
{
    public function index()
    {
        $newsletters = Newsletter::all();
        return NewsletterResource::collection($newsletters);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);

        $newsletter = Newsletter::create($validated);

        return response()->json(new NewsletterResource($newsletter), 201);
    }

    public function show(Newsletter $newsletter)
    {
        return new NewsletterResource($newsletter);
    }

    public function update(Request $request, Newsletter $newsletter)
    {
        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
        ]);

        $newsletter->update($validated);

        return response()->json(new NewsletterResource($newsletter), 200);
    }

    public function destroy(Newsletter $newsletter)
    {
        $newsletter->delete();

        return response()->json(null, 204);
    }
}
