<?php

namespace Akamon\MockeryCallableMock;

use Mockery\MockInterface;

class MockeryCallableMock
{
    /** @var MockInterface */
    private $mock;

    public function __construct()
    {
        $this->mock = \Mockery::mock($this);
    }

    public function shouldBeCalled()
    {
        return $this->mock->shouldReceive('__invoke');
    }

    public function canBeCalled()
    {
        return $this->mock->shouldReceive('__invoke');
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
        return call_user_func_array($this->mock, func_get_args());
    }
}
