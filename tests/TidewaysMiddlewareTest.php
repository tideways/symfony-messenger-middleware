<?php

namespace Tideways\SymfonyMessenger;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Middleware\StackInterface;
use Symfony\Component\Messenger\Middleware\MiddlewareInterface;

class TidewaysMiddlewareTest extends TestCase
{
    public function testHandle(): void
    {
        $next = $this->createStub(MiddlewareInterface::class);
        $next->method('handle')->willReturn(new Envelope(new \stdClass));
        $stack = $this->createStub(StackInterface::class);
        $stack->method('next')->willReturn($next);

        $middleware = new TidewaysMiddleware();
        $middleware->handle(new Envelope(new \stdClass()), $stack);
    }
}
