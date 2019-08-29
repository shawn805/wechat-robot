<?php

namespace Shawn\WeChatRobot;

class ImageText extends Message
{

    public function __construct(array $articles)
    {
        $this->setMessage($articles);
    }

    public function setMessage(array $articles)
    {
        $this->message = [
            'msgtype' => 'news',
            'news'    => [
                'articles' => [$articles]
            ]
        ];
    }
}