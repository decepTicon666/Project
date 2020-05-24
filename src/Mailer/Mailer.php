<?php

namespace App\Mailer;

use App\Mailer\Exception\MissingMailDataException;

class Mailer
{
    private const SENDER_ADDRESS = 'From: My Project <myproject@testing.com>';
    private $receiver;
    private $subject;
    private $content;

    public function setReceiver($receiver): void
    {
        $this->receiver = $receiver;
    }

    public function setSubject($subject): void
    {
        $this->subject = $subject;
    }

    public function setContent($content): void
    {
        $this->content = $content;
    }

    /**
     * @throws MissingMailDataException
     */
    public function send()
    {
        if (!$this->receiver || !$this->subject || !$this->content) {
            throw new MissingMailDataException('use receiver, subject and content to send mail');
        }

        mail($this->receiver, $this->subject, $this->content, self::SENDER_ADDRESS);
    }
}