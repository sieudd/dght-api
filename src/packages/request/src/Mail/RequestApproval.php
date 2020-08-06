<?php

namespace GGPHP\Request\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RequestApproval extends Mailable
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
            ->subject('Cổng đóng góp hỗ trợ - Tiếp nhận yêu cầu')
            ->view('view-requets::emails.request_approval');
    }
}
