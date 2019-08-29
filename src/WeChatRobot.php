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
     * @param $config $atAll $mobiles
     */
    public function __construct(string $token, float $timeout = 3.0, bool $verify = true)
    {
        $this->config = array(
            'token'   => $token,
            'timeout' => $timeout,
            'verify'  => $verify,
        );
        $this->init();
    }

    /**
     * @param bool $atAll
     * @param array $mobiles
     * @return mixed
     */
    public function atSet(bool $atAll = true, array $mobiles = [])
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
    public function text(string $content = '')
    {
        return $this->weChatRobotService
            ->setTextMessage($content)
            ->send();
    }

    /**
     * @param array $articles
     * @return mixed
     */
    public function imageText(array $articles)
    {
        return $this->weChatRobotService
            ->setImageTextMessage($articles)
            ->send();
    }

    /**
     * @param string $markdown
     * @return mixed
     */
    public function markdown(string $markdown)
    {
        return $this->weChatRobotService
            ->setMarkdownMessage($markdown)
            ->send();
    }

}
