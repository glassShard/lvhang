<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RequestForOffer extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Ajánlatkérés a weboldalról';
        return $this
            ->from('noreply@lvhang.hu', 'L.V.Hang Ajánlatkérés')
            ->subject($subject)
            ->view('emails.requestsForOffer.requestFromPrices');
    }
}
