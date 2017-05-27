<?php
require_once 'aliyun/AliyunClient.php';

$appkey='23654508';
$secret='68de6833fe6e22fc4d6312f80b7276c0';
$c = new AliyunClient();
$c->appkey = $appkey;
$c->secretKey = $secret;
$req = new AlibabaAliqinFcSmsNumSendRequest;
$req->setExtend("123456");
$req->setSmsType("normal");
$req->setSmsFreeSignName("王wenfan");
$req->setSmsParam("{\"code\":\"1234\"}");
$req->setRecNum("18683938831");
$req->setSmsTemplateCode("SMS_49460279");
$resp = $c->execute($req);
var_dump($resp);die;