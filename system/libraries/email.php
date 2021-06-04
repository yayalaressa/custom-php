<?php
if (!defined('BASEPATH')) die('Access Denied!');

use Snipworks\Smtp\Email;

class Email
{
	
	protected $mail;
	protected $smtp;
	protected $port;
	protected $sender;
	protected $password;
	protected $receiver;
	protected $subject;
	protected $message;
	
	
	function __construct()
	{
		// /config/config.ini
		$this->smtp = config('email.smtp');
		$this->port = config('email.port');
		$this->sender = config('email.sender');
		$this->password = config('email.password');
	}
	
	public function receiver($receiver)
	{
		$this->receiver = $receiver;
		
		return $this;
	}
	
	public function subject($subject)
	{
		$this->subject = $subject;
		
		return $this;
	}
	
	public function message($message)
	{
		$this->message = $message;
		
		return $this;
	}
	
    public function send()
    {
        $this->mail = new Email($this->smtp, $this->port);
        $this->mail->setProtocol(Email::TLS)
            ->setLogin($this->sender, $this->password)
            ->setFrom($this->sender)
            ->setSubject($this->subject)
            ->setHtmlMessage($this->message)
            ->addTo($this->receiver);

        if ($this->mail->send())
        {
            // echo 'SMTP Email has been sent' . PHP_EOL;
            return true;
        }
        
        return false;
    }

    public function log()
    {
        print_r($this->mail->getLogs());
    }

}

