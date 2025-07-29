<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\News;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Dashboard Index
     */
    public function index()
    {
        $admin = Admin::count();
        $news = News::where(['status' => 1, 'is_approved' => 1])->count();
        $pending = News::where('is_approved', 0)->count();

        return view('admin.dashboard.index', compact('admin', 'news', 'pending'));
    }
}
