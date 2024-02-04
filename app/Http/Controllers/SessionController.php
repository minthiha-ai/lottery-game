<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function storeMessage(Request $request)
    {
        // Set the session message
        $request->session()->flash('status', 'success');
        $request->session()->flash('message', 'Lottery created successfully!');

        // Redirect back to the same page or any other page where you want to show the Swal directly
        return redirect()->route('lottery.management.create');
    }
}
