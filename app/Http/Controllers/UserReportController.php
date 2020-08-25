<?php

namespace App\Http\Controllers;

use App\Report;
use Illuminate\Http\Request;

class UserReportController extends Controller
{
    public function index() {
        $reports = Report::with(["user", "province", "city"])->orderBy("created_at", "DESC")->paginate(10);
    
        return view("admin.reports.index", compact("reports"));
    }

    public function show(Report $report) {
        return view("admin.reports.show", compact("report"));
    }
}