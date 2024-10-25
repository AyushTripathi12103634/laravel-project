<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyController extends Controller
{
    public function showResponse(Request $request)
    {
        $status = $request->get('status');
        $message = $request->get('message');
        $code = $request->get('code');
        $redirectUrl = $request->get('redirectUrl');

        return view('ResponseView', compact('status', 'message', 'code', 'redirectUrl'));
    }
}
