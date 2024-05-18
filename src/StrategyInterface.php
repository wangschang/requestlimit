<?php

namespace RequestLimit;

/**
 * 策略 interface
 */
interface StrategyInterface {
    public function isAllow(StorageInterface $storage, $identifier): bool;
}