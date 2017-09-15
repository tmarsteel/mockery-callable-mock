<?php
namespace Akamon\MockeryCallableMock\Tests;

class MockableCallable
{
    private $action;

    /**
     * @param callable $action
     */
    public function __construct($action = null)
    {
        $this->action = $action;
    }

    public function __invoke() {
        if ($this->action != null) {
            return call_user_func_array($this->action, func_get_args());
        }
    }
}