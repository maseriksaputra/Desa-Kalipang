<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Auth::user()->reports()->latest()->paginate(10);
        return view('dashboard', compact('reports'));
    }

    public function create()
    {
        return view('reports.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image_proof' => 'nullable|image|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('image_proof')) {
            $path = $request->file('image_proof')->store('reports', 'public');
        }

        Auth::user()->reports()->create([
            'title' => $request->title,
            'description' => $request->description,
            'image_proof' => $path,
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Laporan berhasil dibuat.');
    }

    public function show(Report $report)
    {
        if ($report->user_id !== Auth::id()) abort(403);
        return view('reports.show', compact('report'));
    }
}
