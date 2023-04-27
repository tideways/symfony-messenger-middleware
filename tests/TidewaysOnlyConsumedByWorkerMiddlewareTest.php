<?php

namespace Tideways\Tests\SymfonyMessenger;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Middleware\StackInterface;
use Symfony\Component\Messenger\Middleware\MiddlewareInterface;
use Symfony\Component\Messenger\Stamp\ConsumedByWorkerStamp;
use Tideways\SymfonyMessenger\TidewaysOnlyConsumedByWorkerMiddleware;

#[CoversClass(TidewaysOnlyConsumedByWorkerMiddleware::class)]
class TidewaysOnlyConsumedByWorkerMiddlewareTest extends TestCase
{
    public function testHandleWithOutConsumedByWorkerStamp(): void
    {
        $this->expectNotToPerformAssertions();

        $envelope = new Envelope(new \stdClass);

        $next = $this->createStub(MiddlewareInterface::class);
        $next->method('handle')->willReturn($envelope);
        $stack = $this->createStub(StackInterface::class);
        $stack->method('next')->willReturn($next);

        $middleware = new TidewaysOnlyConsumedByWorkerMiddleware();
        $middleware->handle($envelope, $stack);
    }

    public function testHandleWithConsumedByWorkerStamp(): void
    {
        $this->expectNotToPerformAssertions();

        $envelope = new Envelope(new \stdClass, [new ConsumedByWorkerStamp()]);

        $next = $this->createStub(MiddlewareInterface::class);
        $next->method('handle')->willReturn($envelope);
        $stack = $this->createStub(StackInterface::class);
        $stack->method('next')->willReturn($next);

        $middleware = new TidewaysOnlyConsumedByWorkerMiddleware();
        $middleware->handle($envelope, $stack);
    }
}
