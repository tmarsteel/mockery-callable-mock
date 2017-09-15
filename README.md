# Mockery Callable Mock

```php
<?php

use Akamon\MockeryCallableMock\MockeryCallableMock;

// creating a mockery function/callable
$mock = new MockeryCallableMock();

// call it normally
$mock('foo', 'bar');
call_user_func($mock, 'foo', 'bar');

// add it expectations
$mock->shouldBeCalled(); // returns a mockery expectation, so you can use it normally

$mock->shouldBeCalled()->with('foo')->once();
$mock('foo');

$mock->shouldBeCalled()->withNoArgs()->twice();
$mock();
$mock();

// returned values
$mock->shouldBeCalled()->andReturn('foo');
$retval = $mock();

// creating stubs
$stub = new MockeryCallableMock();

$stub->canBeCalled()->with('foo')->andReturn('bar');

// verifying calls
$mock = new MockeryCallableMock();
$mock('bar');

$mock->shouldHaveBeenCalled()->with('bar');
$mock->shouldNotHaveBeenCalled('foo');

// spying
$realAction = function($arg1, $arg2) { /* ... */ }; // or
$realAction = [$this, 'methodToInvoke'];

$callableSpy = new MockeryCallableMock($realAction);

$callableSpy(); // $realAction gets invoked
$callableSpy()->shouldHaveBeenCalled();
```

## Requirements

PHP 7.0+

## Authors

* Pablo Díez - <pablodip@gmail.com>
* Tobias Marstaller - <tobias.marstaller@gmail.com>

## License

Akamon Mockery Callable Mock is licensed under the MIT License. See the LICENSE file for full details.
