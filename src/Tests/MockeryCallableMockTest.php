<?php

namespace Akamon\MockeryCallableMock\Tests;

use Akamon\MockeryCallableMock\MockeryCallableMock;

class MockeryCallableMockTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldBeCalled()
    {
        $mock = new MockeryCallableMock();

        $this->assertInstanceOf('Mockery\CompositeExpectation', $mock->shouldBeCalled());
    }

    public function testCanBeCalled()
    {
        $mock = new MockeryCallableMock();

        $this->assertInstanceOf('Mockery\CompositeExpectation', $mock->canBeCalled());
    }

    public function testOnceWithNoArgs()
    {
        $mock = new MockeryCallableMock();

        $mock->shouldBeCalled()->withNoArgs()->once();
        $mock();
    }

    public function testOnceWithAnArgument()
    {
        $mock = new MockeryCallableMock();

        $mock->shouldBeCalled()->with('foo')->once();
        $mock('foo');
    }

    public function testTwiceWithTwoArguments()
    {
        $mock = new MockeryCallableMock();

        $mock->shouldBeCalled()->with('foo', 'bar')->twice();
        $mock('foo', 'bar');
        $mock('foo', 'bar');
    }

    public function testReturning()
    {
        $mock = new MockeryCallableMock();

        $mock->shouldBeCalled()->andReturn('foo');
        $this->assertSame('foo', $mock());
    }
}
