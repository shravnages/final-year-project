<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function show() {
        $message = 'Welcome to Zeus, a platform for stable and real-time cryptocurrency exchanges!';

        return view('welcome')->withMessage($message);
    }
}
