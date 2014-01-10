<?php

namespace Akamon\MockeryCallableMock\Tests;

use Akamon\MockeryCallableMock\MockeryCallableMock;

class MockeryCallableMockTest extends \PHPUnit_Framework_TestCase
{
    public function testOnceWithNoArgs()
    {
        $mock = new MockeryCallableMock();

        $mock->should()->withNoArgs()->once();
        $mock();
    }

    public function testOnceWithAnArgument()
    {
        $mock = new MockeryCallableMock();

        $mock->should()->with('foo')->once();
        $mock('foo');
    }

    public function testTwiceWithTwoArguments()
    {
        $mock = new MockeryCallableMock();

        $mock->should()->with('foo', 'bar')->twice();
        $mock('foo', 'bar');
        $mock('foo', 'bar');
    }

    public function testReturning()
    {
        $mock = new MockeryCallableMock();

        $mock->should()->andReturn('foo');
        $this->assertSame('foo', $mock());
    }
}
