<?php
namespace RequestLimit;

use RequestLimit\StrategyInterface;
use RequestLimit\RequestLimitException;

class WindowsStrategy implements StrategyInterface{
    
    protected $window_time;//时间窗口大小
    protected $limit_nums;//限制次数

    public function __construct($limit_nums = 100,$window_time = 5)
    {
        $this->limit_nums = $limit_nums;
        $this->window_time = $window_time;   
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
        $redis_value_key = "window:key:".(string)$identifier;
        $redis_time_key = $redis_value_key.":time";
        $nowtime = time();
        $curr_nums = (int)$storage->get($redis_value_key);
        if($nowtime > (int)$storage->get($redis_time_key) + $this->window_time){
            $storage->set($redis_value_key,1);
            $storage->set($redis_time_key,$nowtime);
        }
        if($curr_nums < $this->limit_nums){
            $storage->incr($redis_value_key);
            return true;
        }
        return false;

    }
}