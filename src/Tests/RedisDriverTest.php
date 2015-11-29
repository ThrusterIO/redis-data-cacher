<?php

namespace Thruster\Component\RedisDataCacher\Tests;

use Thruster\Component\RedisDataCacher\RedisDriver;

/**
 * Class RedisDriverTest
 *
 * @package Thruster\Component\RedisDataCacher\Tests
 * @author  Aurimas Niekis <aurimas@niekis.lt>
 */
class RedisDriverTest extends \PHPUnit_Framework_TestCase
{
    public function testDriverBasics()
    {
        $redisMock = $this->getMock('\stdClass', ['set', 'get', 'del']);

        $driver = new RedisDriver($redisMock);

        $redisMock->expects($this->once())
            ->method('set')
            ->with('foo:bar', 'foobar', 10)
            ->willReturn(true);

        $this->assertTrue($driver->set('foo:bar', 'foobar', 10));

        $redisMock->expects($this->once())
            ->method('get')
            ->with('foo:bar')
            ->willReturn('foobar');

        $this->assertSame('foobar', $driver->get('foo:bar'));

        $redisMock->expects($this->once())
            ->method('del')
            ->with('foo:bar')
            ->willReturn(true);

        $this->assertTrue($driver->delete('foo:bar'));
    }

    public function testBuildKey()
    {
        $driver = new RedisDriver(new \stdClass());

        $this->assertSame('foo', $driver->buildKey(['foo']));
        $this->assertSame('foo:bar', $driver->buildKey(['foo', 'bar']));
        $this->assertSame('foo:bar:foo', $driver->buildKey(['foo', 'bar', 'foo']));
        $this->assertSame('foo:bar:foo:bar', $driver->buildKey(['foo', 'bar', 'foo', 'bar']));
    }

    public function testStats()
    {
        $redisMock = $this->getMock('\stdClass', ['set', 'get', 'del']);

        $driver = new RedisDriver($redisMock);

        $redisMock->expects($this->at(0))
            ->method('get')
            ->with('foo:bar')
            ->willReturn('foobar');

        $redisMock->expects($this->at(1))
            ->method('get')
            ->with('foo:bar')
            ->willReturn(false);

        $redisMock->expects($this->at(2))
            ->method('get')
            ->with('foo:bar')
            ->willReturn(false);

        $redisMock->expects($this->at(3))
            ->method('get')
            ->with('foo:bar')
            ->willReturn('foobar');

        $redisMock->expects($this->at(4))
            ->method('get')
            ->with('foo:bar')
            ->willReturn('foobar');

        $driver->get('foo:bar');
        $driver->get('foo:bar');
        $driver->get('foo:bar');
        $driver->get('foo:bar');
        $driver->get('foo:bar');

        $this->assertEquals(['hits' => 3, 'misses' => 2], $driver->getStatistics());
    }
}
