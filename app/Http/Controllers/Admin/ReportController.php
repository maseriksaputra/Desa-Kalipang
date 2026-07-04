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
        $selesai_dikerjakan = Report::where('status', 'selesai_dikerjakan')->count();
        $selesai = Report::where('status', 'selesai')->count();
        $recentReports = Report::with('user')->latest()->take(5)->get();
        return view('admin.dashboard', compact('pending', 'proses', 'selesai_dikerjakan', 'selesai', 'recentReports'));
    }

    public function index()
    {
        $reports = Report::with('user')->latest()->paginate(15);
        return view('admin.reports.index', compact('reports'));
    }

    public function show(Report $report)
    {
        $pegawai = \App\Models\User::where('role', 'pegawai')->get();
        return view('admin.reports.show', compact('report', 'pegawai'));
    }

    public function updateStatus(Request $request, Report $report)
    {
        $request->validate([
            'status' => 'required|in:pending,proses,selesai_dikerjakan,selesai',
        ]);

        $report->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Status laporan berhasil diperbarui.');
    }

    public function assign(Request $request, Report $report)
    {
        $request->validate([
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        $report->update([
            'assigned_to' => $request->assigned_to,
        ]);

        return back()->with('success', 'Laporan berhasil ditugaskan.');
    }
}
