<?php

namespace Tideways\Tests\SymfonyMessenger;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Middleware\StackInterface;
use Symfony\Component\Messenger\Middleware\MiddlewareInterface;
use Tideways\SymfonyMessenger\TidewaysMiddleware;

#[CoversClass(TidewaysMiddleware::class)]
class TidewaysMiddlewareTest extends TestCase
{
    public function testHandle(): void
    {
        $this->expectNotToPerformAssertions();

        $next = $this->createStub(MiddlewareInterface::class);
        $next->method('handle')->willReturn(new Envelope(new \stdClass));
        $stack = $this->createStub(StackInterface::class);
        $stack->method('next')->willReturn($next);

        $middleware = new TidewaysMiddleware();
        $middleware->handle(new Envelope(new \stdClass()), $stack);
    }
}
