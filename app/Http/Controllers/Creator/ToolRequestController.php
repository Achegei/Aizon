<?php

namespace App\Http\Controllers\Creator;

use App\Http\Controllers\Controller;
use App\Models\Tool;
use App\Models\ToolRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ToolRequestController extends Controller
{
    /**
     * Store a new tool request
     */
   public function store(Request $request, Tool $tool)
        {
            $this->authorize('request', $tool); // checks ToolPolicy

            $user = Auth::user();

            ToolRequest::firstOrCreate(
                [
                    'user_id' => $user->id,
                    'tool_id' => $tool->id,
                ],
                [
                    'creator_id' => $tool->creator_id,
                    'name' => $user->name,
                    'email' => $user->email,
                ]
            );

            return back()->with('success', "Your request for {$tool->title} has been sent to the creator!");
        }


    /**
     * Show all tool requests for the logged-in creator
     */
    public function index()
    {
        $creatorId = Auth::id();

        // Assuming ToolRequest has a relation to Tool
        $requests = ToolRequest::whereHas('tool', function ($query) use ($creatorId) {
            $query->where('creator_id', $creatorId);
        })->latest()->get();

        return view('creator.tools.requests.index', compact('requests'));
    }
}
