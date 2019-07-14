<?php

namespace Shawn\WeChatRobot;

abstract class Message
{
    protected $message = [];
    protected $at;

    protected function makeAt($mobiles = [], $atAll = false)
    {
        if ($atAll) {
            return ['mentioned_list' => ['@all']];
        } else {
            return ['mentioned_mobile_list' => $mobiles];
        }
    }

    public function sendAt($mobiles = [], $atAll = false)
    {
        $this->at = $this->makeAt($mobiles, $atAll);
        return $this;
    }

    public function getBody()
    {
        $this->message[$this->message['msgtype']] = array_merge($this->at, $this->message[$this->message['msgtype']]);
        return $this->message;
    }

}