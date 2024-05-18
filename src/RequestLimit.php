<?php

namespace RequestLimit;

/**
 * Undocumented class
 */
class RequestLimit {
    protected $strategy;
    protected $storage;

    /**
     * ini
     *
     * @param StrategyInterface $strategy
     * @param StorageInterface $storage
     */
    public function __construct(StrategyInterface $strategy, StorageInterface $storage)
    {
        $this->strategy = $strategy;
        $this->storage = $storage;
    }
    /**
     * 判断是否触发了限制
     *
     * @param [type] $uid
     * @return boolean
     */
    public function isAllow($uid): bool {
        return $this->strategy->isAllow($this->storage,$uid);
    }
    
}