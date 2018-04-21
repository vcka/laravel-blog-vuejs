<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactEmail extends Mailable {

    use Queueable,
        SerializesModels;

    public $contact;

    public function __construct($contact) {
        $this->contact = $contact;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        //, $this->contact['name']
        return $this->from(config('mail.from.address'))->to($this->contact['email'])
                        ->subject('Blog Feedback Receive.')
                        ->view('user.mail.contact');
        //return $this->view('view.name');
    }

}
