<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;
	
	public $name;
	
	public $letter;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $letter)
    {
        //
		 $this->name = $name;
		 $this->letter = $letter;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
		return $this->from('admin@companydata')
            ->view('email.message')
            ->with(
            [
                'name' => $this->name,
                'letter' => $this->letter,
            ]);
    }
}
