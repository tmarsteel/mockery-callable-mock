<?php

namespace Akamon\MockeryCallableMock;

use Akamon\MockeryCallableMock\Tests\MockableCallable;
use Mockery;
use Mockery\Exception\InvalidCountException;
use Mockery\MockInterface;

class MockeryCallableMock
{
    /** @var MockInterface */
    private $mock;

    public function __construct(callable $action = null)
    {
        $actionCallable = $action ?: function() {};
        $this->mock = Mockery::mock(new MockableCallable($actionCallable));
    }

    /**
     * @return \Mockery\Expectation
     */
    public function shouldBeCalled()
    {
        return $this->mock->shouldReceive('__invoke');
    }

    /**
     * @return \Mockery\Expectation
     */
    public function canBeCalled()
    {
        return $this->mock->shouldReceive('__invoke');
    }

    /**
     * @return \Mockery\Expectation
     */
    public function shouldHaveBeenCalled()
    {
        return $this->mock->shouldHaveReceived('__invoke');
    }

    /**
     * @return void
     * @throws InvalidCountException
     */
    public function shouldNotHaveBeenCalled(...$args)
    {
        $this->mock->shouldNotHaveReceived('__invoke', empty($args)? null : $args);
    }

    /**
     * @deprecated
     */
    public function should()
    {
        return $this->mock->shouldReceive('__invoke');
    }

    public function __invoke()
    {
        return call_user_func_array([$this->mock, '__invoke'], func_get_args());
    }
}
