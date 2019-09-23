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
    protected $mobiles = [];
    /**
     * @var bool
     */
    protected $atAll = true;

    /**
     * WeChatRobot constructor.
     * @param string $atAll $mobiles
     * @param array $atAll $mobiles
     * @param bool $atAll
     */
    public function __construct($token, $mobile = [], $all = false)
    {
        $this->config = array(
            'token'   => $token,
            'timeout' => env('ROBOT_TIMEOUT',2),
            'verify'  => env('ROBOT_VERIFY',false)
        );
        $this->atSet($all, $mobile);
        $this->init();
    }

    /**
     * @param bool $atAll
     * @param array $mobiles
     * @return mixed
     */
    public function atSet($atAll = true, $mobiles = [])
    {
        $this->atAll = $atAll;
        $this->mobiles = $mobiles;
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
     * @param array $articles
     * @return mixed
     */
    public function imageText($articles)
    {
        return $this->weChatRobotService
            ->setImageTextMessage($articles)
            ->send();
    }

    /**
     * @param string $markdown
     * @return mixed
     */
    public function markdown($markdown)
    {
        return $this->weChatRobotService
            ->setMarkdownMessage($markdown)
            ->send();
    }

}
