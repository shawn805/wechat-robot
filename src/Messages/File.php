<?php

namespace Shawn\WeChatRobot\Messages;

use GuzzleHttp\Client;

class File extends Message
{
    public function __construct($mediaId)
    {
        $this->message = [
            'msgtype' => 'file',
            'file'    => [
                'media_id' => $mediaId
            ]
        ];
    }
    
}
