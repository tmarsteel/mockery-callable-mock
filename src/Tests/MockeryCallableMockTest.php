<?php

namespace Akamon\MockeryCallableMock\Tests;

use Akamon\MockeryCallableMock\MockeryCallableMock;
use Mockery\Exception\InvalidCountException;

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

    public function testShouldHaveBeenCalled()
    {
        $mock = new MockeryCallableMock();

        $mock->canBeCalled()->withAnyArgs()->andReturn('foo');
        $mock('bar');

        $mock->shouldHaveBeenCalled()->with('bar');
    }

    /**
     * @expectedException \Mockery\Exception\InvalidCountException
     */
    public function testShouldNotHaveBeenCalled()
    {
        $mock = new MockeryCallableMock();

        $mock->canBeCalled()->withAnyArgs()->andReturn('foo');
        $mock();

        $mock->shouldNotHaveBeenCalled();
    }

    /**
     * @expectedException \Mockery\Exception\InvalidCountException
     */
    public function testShouldNotHaveBeenCalledWithMatchingArgs()
    {
        $mock = new MockeryCallableMock();

        $mock->canBeCalled()->withAnyArgs()->andReturn('foo');
        $mock('bar');

        $mock->shouldNotHaveBeenCalled('bar');
    }
    
    public function testShouldNotHaveBeenCalledWithNonMatchingArgs()
    {
        $mock = new MockeryCallableMock();

        $mock->canBeCalled()->withAnyArgs()->andReturn('foo');
        $mock('bar');

        $mock->shouldNotHaveBeenCalled('bob');
    }

    public function testSpyingFunctionality() {
        $actionCalled = false;
        $action = function() use (&$actionCalled) {
            $actionCalled = true;
            return "i ran!";
        };

        $mock = new MockeryCallableMock($action);
        $returnValue = $mock();

        $this->assertEquals("i ran!", $returnValue);
        $this->assertTrue($actionCalled);
        $mock->shouldHaveBeenCalled();
    }
}
