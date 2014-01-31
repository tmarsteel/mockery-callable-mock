# Akamon Mockery Callable Mock

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
```

## Author

Pablo Díez - <pablodip@gmail.com>

## License

Akamon Mockery Callable Mock is licensed under the MIT License. See the LICENSE file for full details.
