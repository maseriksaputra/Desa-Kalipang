<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function dashboard()
    {
        $pending = Report::where('status', 'pending')->count();
        $proses = Report::where('status', 'proses')->count();
        $selesai = Report::where('status', 'selesai')->count();
        $recentReports = Report::with('user')->latest()->take(5)->get();
        return view('admin.dashboard', compact('pending', 'proses', 'selesai', 'recentReports'));
    }

    public function index()
    {
        $reports = Report::with('user')->latest()->paginate(15);
        return view('admin.reports.index', compact('reports'));
    }

    public function show(Report $report)
    {
        return view('admin.reports.show', compact('report'));
    }

    public function updateStatus(Request $request, Report $report)
    {
        $request->validate([
            'status' => 'required|in:pending,proses,selesai',
        ]);

        $report->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Status laporan berhasil diperbarui.');
    }
}
