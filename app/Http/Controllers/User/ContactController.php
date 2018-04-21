<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactFormRequest;
use App\Mail\ContactEmail;

class ContactController extends Controller {

    public function create() {
        /*$data = array();
        $data['email'] = 'nice.vivek25@gmail.com';
        $data['name'] = 'Test Test';
        $mail = \Mail::send('user.mail.welcome', $data, function($message) use ($data)
        {
            $message->from('no-reply@site.com', "Blog");
            $message->subject("Welcome to Blog");
            $message->to($data['email']);
        });
        dd($mail);
        die;*/
        return view('user.contact.create');
    }

    public function store(ContactFormRequest $request) {
        $contact = [];
        $contact['name'] = $request->get('name');
        $contact['email'] = $request->get('email');
        $contact['msg'] = $request->get('msg');        
        
        \Mail::send(new ContactEmail($contact));
        // Mail delivery logic goes here
        // flash('Your message has been sent!')->success();
        return redirect()->route('contact.create');
    }

}
