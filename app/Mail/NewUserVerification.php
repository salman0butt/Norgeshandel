<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewUserVerification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $data = [];
    protected $link = "#";

    public function __construct($Data, $Link)
    {
        $this->data = $Data;
        $this->link = $Link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
//        return $this->subject('Ny registrering!')->view('mail.new_user_verification')
//            ->with(['first_name'=>$this->data['first_name'],
//                'last_name'=>$this->data['last_name'],
//                'link'=>$this->link]
//            );
    }
}
