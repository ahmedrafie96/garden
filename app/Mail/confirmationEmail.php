<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class confirmationEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $customer;
    public $tree_number;
    public $post ;
    public $photo ;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($customer , $tree_number , $post , $photo)
    {
        $this->customer = $customer;
        $this->tree_number = $tree_number;
        $this->post = $post;
        $this->photo = $photo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.confirmationEmail')
            ->subject('Hello' .' '. $this->customer->first_name )
        ;
    }
}
