<?php

require   'vendor/autoload.php';

use Predis\Client;
use RequestLimit\RequestLimit;
use RequestLimit\FileStorage;
use RequestLimit\RedisStorage;
use RequestLimit\RequestLimitException;
use RequestLimit\WindowsStrategy;
use RequestLimit\BucketStrategy;


$redis = new Client([
    'scheme' => 'tcp',
    'host'   => '127.0.0.1',
    'port'   => 6379,]);

//test
try{
    //$storgae = new FileStorage('/data/wwwlogs/requestlimit');//file storage
    $storgae = new RedisStorage($redis);//redis storage
    //$requestlimit = new RequestLimit(new WindowsStrategy(10,20),$storgae);
    $requestlimit = new RequestLimit(new BucketStrategy(1,0.1,5),$storgae);
    $uid = 1;
    if($requestlimit->isAllow($uid)){
        echo "allow";
    }else{
        echo "not allow";
    }
}catch(RequestLimitException $e){
    print_r($e->getRequestLimitMessage());
}catch(\Exception $e){
    echo $e->getMessage();
}
