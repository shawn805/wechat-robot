<?php

namespace Shawn\WeChatRobot;

use GuzzleHttp\Client;

class HttpClient
{
    protected $client;
    protected $config;

    /**
     * @var string
     */
    protected $hookUrl = 'https://qyapi.weixin.qq.com/cgi-bin/webhook/send?key=';

    /**
     * @var string
     */
    protected $hookFileUrl = 'https://qyapi.weixin.qq.com/cgi-bin/webhook/upload_media?key={token}&type=file';

    /**
     * @var string
     */
    protected $accessToken = '';

    public $fileId = '';

    public function __construct($config)
    {
        $this->config = $config;
        $this->setAccessToken();
        $this->client = $this->createClient();
    }

    /**
     * @return string
     */
    public function setAccessToken()
    {
        $this->accessToken = $this->config['token'];
    }

    /**
     * create a guzzle client
     * @return Client
     */
    protected function createClient()
    {
        $client = new Client([
            'timeout' => $this->config['timeout'],
        ]);
        return $client;
    }

    /**
     * @return string
     */
    public function getRobotUrl()
    {
        return $this->hookUrl . $this->accessToken;
    }

    /**
     * @return string
     */
    public function getRobotFileUrl()
    {
        return str_replace('{token}', $this->accessToken, $this->hookFileUrl);
    }

    /**
     * send file
     * @param $path
     * @return string
     */
    public function getFileMediaId($path)
    {
        $response     = $this->client->request('POST', $this->getRobotFileUrl(), [
            'multipart' => [
                [
                    'name'     => 'file_name',
                    'contents' => fopen($path, 'r')
                ]
            ]
        ]);
        $result       = $response->getBody()->getContents();
        $result       = json_decode($result, true);
        $mediaId      = !empty($result['media_id']) ? $result['media_id'] : '';
        $this->fileId = $mediaId;
    }

    /**
     * send message
     * @param $params
     * @return array
     */
    public function send($params)
    {
        $request = $this->client->post($this->getRobotUrl(), [
            'body'    => json_encode($params),
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'verify'  => $this->config['verify']
        ]);

        $result = $request->getBody()->getContents();
        return json_decode($result, true);
    }
}
