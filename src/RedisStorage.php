<?php

namespace wangschang\RequestLimit;

use wangschang\RequestLimit\StorageInterface;
use wangschang\RequestLimit\RequestLimitException;

class RedisStorage implements StorageInterface{

    protected $redis;

    public function __construct($redis) {
        $this->redis = $redis;
    }

    public function get($key) {
        return $this->redis->get($key);
    }

    public function set($key, $value) {
        $this->redis->set($key, $value);
    }

    public function incr($key) {
        $this->redis->incr($key);
    }

    public function decr($key) {
        $this->redis->decr($key);
    }
}