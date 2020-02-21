<?php

namespace App\Http\Controllers;

use App\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewLead;
use App\Mail\UserConfirmation;

class HomeController extends Controller
{

    public function index()
    {
        return view('home');
    }

    public function contatti()
    {
        return view('contatti');
    }

    public function contattiStore(Request $request)
    {
        $new_message= new Lead();
        $new_message->fill($request->all());
        $new_message->save();

        Mail::to('admin@boolpress.com')->send(new NewLead($new_message));
        Mail::to($new_message->email)->send(new UserConfirmation($new_message));
        return redirect()->route('contatti.grazie');


    }

    public function grazie()
    {
        return view('thx-page');
    }
}
