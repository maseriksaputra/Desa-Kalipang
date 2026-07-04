<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $reports = \Illuminate\Support\Facades\Auth::user()->assignedReports()->latest()->paginate(10);
        $pending = \Illuminate\Support\Facades\Auth::user()->assignedReports()->where('status', 'pending')->count();
        $proses = \Illuminate\Support\Facades\Auth::user()->assignedReports()->where('status', 'proses')->count();
        $selesai_dikerjakan = \Illuminate\Support\Facades\Auth::user()->assignedReports()->where('status', 'selesai_dikerjakan')->count();
        $selesai = \Illuminate\Support\Facades\Auth::user()->assignedReports()->where('status', 'selesai')->count();
        
        return view('pegawai.dashboard', compact('reports', 'pending', 'proses', 'selesai_dikerjakan', 'selesai'));
    }

    public function show(\App\Models\Report $report)
    {
        if ($report->assigned_to !== \Illuminate\Support\Facades\Auth::id()) abort(403);
        return view('pegawai.reports.show', compact('report'));
    }

    public function updateStatus(Request $request, \App\Models\Report $report)
    {
        if ($report->assigned_to !== \Illuminate\Support\Facades\Auth::id()) abort(403);
        
        $request->validate([
            'status' => 'required|in:pending,proses,selesai_dikerjakan',
        ]);

        $report->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Status laporan berhasil diperbarui.');
    }
}
