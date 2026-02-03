<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobListing;
use App\Models\JobApplication;

class JobApplicationController extends Controller
{
    public function store(Request $request, JobListing $job)
    {
        $request->validate([
            'cover_letter' => 'required|string|max:2000',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $cvPath = null;
        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('cvs', 'public');
        }

        JobApplication::create([
            'job_post_id' => $job->id,  // <-- matches your column
            'user_id' => $request->user()->id,
            'cover_letter' => $request->cover_letter,
            'cv_path' => $cvPath,
            'status' => 'pending', // default status
        ]);

        return back()->with('success', 'Your application has been submitted!');
    }
}
