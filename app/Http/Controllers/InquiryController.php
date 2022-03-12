<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function submit()
    {
        $data = request()->validate([
            'email' => ['required', 'email'],
            'message' => ['required', 'max:500'],
        ]);

        Inquiry::create($data);
        return "Your inquiry has been sent.";
    }
}
