<h1 align="center"> 企业微信群机器人通知wechat-robot </h1>

## 安装

```shell
$ composer require shawn805/wechat-robot
```

## 使用方法
 
```php
实例 
/**
  * @param string $token    必填参数
  * @param string $timeout    可选
  * @param string $verify    可选   
*/
$weChat = new WeChatRobot(string $token, float $timeout = 3.0, bool $verify = true);

发送文本类型
/**
  * @param string $content     消息内容
*/
$weChat->text(string $content);

markdown类型
/**
  * @param string $markdown     markdown内容
*/
$weChat->markdown(string $markdown);

图文类型
/**
  * @param array $articles     图文信息数组
*/
$articles = [
    "title" : "标题",
    "description" : "标题",
    "url" : "点击后跳转的链接",
    "picurl" : "图文消息的图片链接"  
];
$weChat->imageText($articles);
```
## License

MIT