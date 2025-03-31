<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReportController extends Controller
{
    public function download()
    {
        $filePath = storage_path('app/reports/event_report.pdf'); // Ensure the file exists
        if (!file_exists($filePath)) {
            return back()->with('error', 'Report not found.');
        }

        return response()->download($filePath, 'Event_Report.pdf');
    }
}
