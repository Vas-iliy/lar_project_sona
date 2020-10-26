<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RoomMail extends Mailable
{
    use Queueable, SerializesModels;

    public $cod;
    public $alias;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($cod, $alias)
    {
        $this->cod = $cod;
        $this->alias = $alias;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('hotelSona@gmail.com')
            ->view(env('THEME') .'.email')->with(['cod' => $this->cod, 'alias' => $this->alias]);
    }
}
