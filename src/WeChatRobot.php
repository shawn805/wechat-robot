<?php

namespace Shawn\WeChatRobot;

class WeChatRobot
{
    /**
     * @var
     */
    protected $config;
    /**
     * @var WeChatRobotService
     */
    protected $weChatRobotService;
    /**
     * @var array
     */
    protected $mobiles;
    /**
     * @var bool
     */
    protected $atAll;

    /**
     * WeChatRobot constructor.
     * @param $config $atAll $mobiles
     */
    public function __construct($config, $atAll = true, $mobiles = [])
    {
        $this->config = $config;
        $this->atAll = $atAll;
        $this->mobiles = $mobiles;
        $this->init();
    }

    /**
     * @return $this
     */
    public function init()
    {
        $this->weChatRobotService = new WeChatRobotService($this->config, $this->atAll, $this->mobiles);
        return $this;
    }

    /**
     * @param string $content
     * @return mixed
     */
    public function text($content = '')
    {
        return $this->weChatRobotService
            ->setTextMessage($content)
            ->send();
    }

    /**
     * @param $title
     * @param $description
     * @param $url
     * @param string $picUrl
     * @return mixed
     */
    public function imageText(array $articles)
    {
        return $this->weChatRobotService
            ->setImageTextMessage($articles)
            ->send();
    }

    /**
     * @param $markdown
     * @return mixed
     */
    public function markdown($markdown)
    {
        return $this->weChatRobotService
            ->setMarkdownMessage($markdown)
            ->send();
    }

    /**
     * @param $markdown
     * @return mixed
     */
    public function recordException($markdown)
    {
        return $this->weChatRobotService
            ->setExceptionMessage($markdown)
            ->send();
    }

}
