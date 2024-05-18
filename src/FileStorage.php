<?php

namespace wangschang\RateLimiter;

use wangschang\RateLimiter\StorageInterface;
use wangschang\RateLimiter\RequestLimitException;

class FileStorage implements StorageInterface{

    protected $path;

    public function __construct($path = '')
    {   
        if($path == ''){
            $this->path = '';//默认地址
        }else{
            $this->path = $path;
        }
        
        if(!is_dir($this->path)){
            throw new RequestLimitException(RequestLimitException::ERROR_FILE_NOT_DIR);
        }
        if(!is_writable($this->path)){
            throw new RequestLimitException(RequestLimitException::ERROR_FILE_NOT_WRITE);
        }
    }
    /**
     * 文件名称
     *
     * @param [type] $key
     * @return void
     */
    public function getfilename($key){
        $filename = $this->path."/".md5($key).".txt";
        return $filename;
    }
    /**
     * set
     *
     * @param [type] $key
     * @param [type] $value
     * @return void
     */
    public function set($key, $value){
        $filename = (String)$this->getfilename($key);
        file_put_contents($filename,$value);
    }
    /**
     * get value
     *
     * @param [type] $key
     * @return void
     */
    public function get($key){
        $filename = (String)$this->getfilename($key);
        return trim(file_get_contents($filename));
    }
    /**
     * 增加
     *
     * @param [type] $key
     * @return void
     */
    public function incr($key){
        $value = (int)$this->get($key);
        $this->set($key,$value + 1);
    }
    
    /**
     * 减少
     *
     * @param [type] $key
     * @return void
     */
    public function decr($key){
        $this->set($key,max(0,(int)$this->get($key) - 1));
    }
}