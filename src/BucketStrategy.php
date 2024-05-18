<?php
namespace wangschang\RequestLimit;

use wangschang\RequestLimit\StrategyInterface;
use wangschang\RequestLimit\RequestLimitException;

class BucketStrategy implements StrategyInterface{
    
    //令牌数量
    protected $tokens;

    #速率
    protected $rate;
    #总容量
    protected $capacity;


    public function __construct($tokens,$rate,$capacity)
    {
        $this->tokens = $tokens;
        $this->rate = $rate;   
        $this->capacity = $capacity;
           
    }
    /**
     * 是否允许
     *
     * @param StorageInterface $storage
     * @param [type] $identifier
     * @return boolean
     */
    public function isAllow(StorageInterface $storage, $identifier): bool
    {
        if($identifier == ""){
            throw new RequestLimitException(RequestLimitException::ERROR_ID_IS_NULL);
        }
        $value_key = "bucket:key:".(string)$identifier;
        $time_key = $value_key.":time";
        $nowtime = time();
        $tokens = (int)$storage->get($value_key);
        if($tokens > 0){
            $storage->decr($value_key);
            return true;
        }
        $last_token_time = $storage->get($time_key);
        if(!$last_token_time){
            $storage->set($time_key,$nowtime);
            $last_token_time = $nowtime;
        }
        if($tokens < $this->capacity){
            $new_tokens = min($this->tokens,$tokens + ($nowtime - $last_token_time) * $this->rate);
            $storage->set($value_key,$new_tokens);
            $storage->set($time_key,$nowtime);
            return $this->isAllow($storage,$identifier);
        }
        
        return false;

    }
}