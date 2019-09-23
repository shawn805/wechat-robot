<?php

namespace Shawn\WeChatRobot;

class ImageText extends Message
{

    public function __construct($articles)
    {
        $this->setMessage($articles);
    }

    public function setMessage($articles)
    {
        $this->message = [
            'msgtype' => 'news',
            'news'    => [
                'articles' => [$articles]
            ]
        ];
    }
}