<?php

require __DIR__ . '/../vendor/autoload.php';

use Predis\Client;
use wangschang\RequestLimit\RequestLimit;
use wangschang\RequestLimit\FileStorage;
use wangschang\RequestLimit\RedisStorage;
use wangschang\RequestLimit\RequestLimitException;
use wangschang\RequestLimit\WindowsStrategy;
use wangschang\RequestLimit\BucketStrategy;


$redis = new Client([
    'scheme' => 'tcp',
    'host'   => '127.0.0.1',
    'port'   => 6379,]);

//test
//try{
    $storgae = new RedisStorage('/data/wwwlogs/requestlimit');//file storage
    $requestlimit = new RequestLimit(new WindowsStrategy(10,60),$storgae);
    $uid = 1;
    if($requestlimit->isAllow($uid)){
        echo "allow";
    }else{
        echo "not allow";
    }
// }catch(RequestLimitException $e){
//     print_r($e->getRequestLimitMessage());
// }catch(\Exception $e){
//     echo $e->getMessage();
// }
