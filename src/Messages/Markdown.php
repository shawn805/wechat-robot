<?php

namespace Shawn\WeChatRobot;

class Markdown extends Message
{
    public function __construct($markdown)
    {
        $this->setMessage($markdown);
    }

    public function setMessage($markdown)
    {
        $this->message = [
            'msgtype'  => 'markdown',
            'markdown' => [
                'content' => $markdown
            ]
        ];
    }

}