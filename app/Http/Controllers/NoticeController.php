<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notice;

class NoticeController extends Controller
{
    public function index()
    {
        $notices = Notice::active()->oldest()->paginate(12);
        return view('notice', compact('notices'));
    }
}
