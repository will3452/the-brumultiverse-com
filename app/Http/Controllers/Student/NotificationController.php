<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications()->latest()->get();
        return view('student.notification.index', compact('notifications'));
    }

    public function markAsRead($id)
    {
        $not = auth()->user()->notifications()->find($id);
        $not->markAsRead();

        if ($not->data['url'] === '#') {
            return back();
        }

        return redirect($not->data['url']);
    }
}
