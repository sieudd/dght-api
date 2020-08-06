<?php

namespace GGPHP\Contribute\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContributeApproval extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * data
     *
     * @var string
     */
    public $data;

    /**
     * Create a new message instance.
     *
     * @param $data
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
        return $this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->subject('Cổng đóng góp hỗ trợ - ' . $this->data['status'])
            ->view('view-contribute::emails.contribute_approval');
    }
}
