<?php

namespace GGPHP\Users\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * User name
     *
     * @var string
     */
    public $name;

    /**
     * URL in client site
     *
     * @var string
     */
    public $urlLogin;

    /**
     * Password
     *
     * @var string
     */
    public $password;

    /**
     * email
     *
     * @var string
     */
    public $email;

    /**
     * Create a new message instance.
     *
     * @param $data
     */
    public function __construct($data)
    {
        $this->name = $data['name'];
        $this->urlLogin = $data['urlLogin'];
        $this->password = $data['password'];
        $this->email = $data['email'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->subject('Cổng đóng góp hỗ trợ - Thông tin tài khoản của bạn')
            ->view('view-users::emails.notification_password');
    }
}
