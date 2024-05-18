<?php

namespace wangschang\RateLimiter;

/**
 * 存储的 interface
 */
interface StorageInterface {
    /**
     * set
     *
     * @param [type] $key
     * @param [type] $value
     * @return void
     */
    public function set($key, $value);
    /**
     * get value
     *
     * @param [type] $key
     * @return void
     */
    public function get($key);
    /**
     * 增加
     *
     * @param [type] $key
     * @return void
     */
    public function incr($key);
    /**
     * 减少
     *
     * @param [type] $key
     * @return void
     */
    public function decr($key);
}