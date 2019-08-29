<?php

namespace Shawn\WeChatRobot;

use Shawn\WeChatRobot\ImageText;
use Shawn\WeChatRobot\Markdown;
use Shawn\WeChatRobot\Message;
use Shawn\WeChatRobot\Text;
use GuzzleHttp\Client;

class WeChatRobotService
{

    protected $config;

    /**
     * @var Message
     */
    protected $message;

    /**
     * @var SendClient
     */
    protected $client;
    /**
     * @var array
     */
    protected $mobiles = [];
    /**
     * @var bool
     */
    protected $atAll = true;

    /**
     * WeChatRobotService constructor.
     * @param $config
     * @param null $client
     */
    public function __construct($config, $atAll, $mobiles)
    {
        $this->config = $config;
        $this->mobiles = $mobiles;
        $this->atAll = $atAll;

        $this->client = $this->createClient($config);

    }

    /**
     * create a guzzle client
     * @return HttpClient
     */
    protected function createClient($config)
    {
        $client = new HttpClient($config);
        return $client;
    }


    /**
     * @param $content
     * @return $this
     */
    public function setTextMessage($content)
    {
        $this->message = new Text($content);
        $this->message->sendAt($this->mobiles, $this->atAll);
        return $this;
    }

    /**
     * @param $articles
     * @return mixed
     */
    public function setImageTextMessage(array $articles)
    {
        $this->message = new ImageText($articles);
        $this->message->sendAt($this->mobiles, $this->atAll);
        return $this;
    }

    /**
     * @param $markdown
     * @return $this
     */
    public function setMarkdownMessage($markdown)
    {
        $this->message = new Markdown($markdown);
        $this->message->sendAt($this->mobiles, $this->atAll);
        return $this;
    }

    /**
     * @return bool|array
     */
    public function send()
    {
        return $this->client->send($this->message->getBody());
    }

}
