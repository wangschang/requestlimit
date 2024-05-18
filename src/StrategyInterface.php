<?php

namespace wangschang\RateLimiter;

/**
 * 策略 interface
 */
interface StrategyInterface {
    public function isAllow(StorageInterface $storage, $identifier): bool;
}