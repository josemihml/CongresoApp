<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;

class EmailVerification extends Mailable
{
    use Queueable, SerializesModels;

   public $url, $user;

    public function __construct($user, $url)
    {
        $this->url = $url;
        $this->user = $user;
    }
    
    public function build()
    {
        $this->to($this->user);
        return $this->view('emails.verify')->with(['user'=>$this->user, 'url'=>$this->url]);
    }
}
