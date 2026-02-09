<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobListing;
use App\Models\JobApplication;

class JobApplicationController extends Controller
{
    public function store(Request $request, JobListing $job)
    {
        // ✅ Validate input
        $request->validate([
            'cover_letter' => 'required|string|max:2000',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // ✅ Handle CV upload
        $cvPath = null;
        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('cvs', 'public');
        }

        // ✅ Create application (job_id FIXED)
        JobApplication::create([
            'job_id'            => $job->id,            // 🔥 REQUIRED
            'user_id'           => auth()->id(),
            'cover_letter_text' => $request->cover_letter,
            'cv_path'           => $cvPath,
            'status'            => 'pending',
        ]);

        // ✅ Redirect back with success
        return redirect()->back()->with('success', 'Your application has been submitted successfully.');
    }
}
