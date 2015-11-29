<?php

namespace Thruster\Component\RedisDataCacher;

use Thruster\Component\DataCacher\DriverInterface;

/**
 * Class RedisDriver
 *
 * @package Thruster\Component\RedisDataCacher
 * @author  Aurimas Niekis <aurimas@niekis.lt>
 */
class RedisDriver implements DriverInterface
{
    /**
     * @var \Redis
     */
    protected $redis;

    /**
     * @var int
     */
    protected $hits;

    /**
     * @var int
     */
    protected $misses;

    public function __construct($redis)
    {
        $this->redis = $redis;
        $this->hits = 0;
        $this->misses = 0;
    }

    /**
     * @return \Redis
     */
    public function getRedis()
    {
        return $this->redis;
    }

    /**
     * @inheritDoc
     */
    public function set(string $key, string $value, int $ttl) : bool
    {
        return $this->getRedis()->set($key, $value, $ttl);
    }

    /**
     * @inheritDoc
     */
    public function get(string $key)
    {
        $result = $this->getRedis()->get($key);

        if (false === $result) {
            $this->misses++;
        } else {
            $this->hits++;
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function delete(string $key) : bool
    {
        return $this->getRedis()->del($key);
    }

    /**
     * @inheritDoc
     */
    public function buildKey(array $parts) : string
    {
        return implode(':', $parts);
    }

    /**
     * @inheritDoc
     */
    public function getStatistics() : array
    {
        return [
            'hits' => $this->hits,
            'misses' => $this->misses
        ];
    }

}
