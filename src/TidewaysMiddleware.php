<?php

namespace Tideways\SymfonyMessenger;

use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\Middleware\MiddlewareInterface;
use Symfony\Component\Messenger\Middleware\StackInterface;

class TidewaysMiddleware implements MiddlewareInterface
{
    public function handle(Envelope $envelope, StackInterface $stack): Envelope
    {
        if (!class_exists('Tideways\Profiler')) {
            return $stack->next()->handle($envelope, $stack);
        }

        \Tideways\Profiler::start();
        \Tideways\Profiler::setTransactionName(get_class($envelope->getMessage()));

        try {
            return $stack->next()->handle($envelope, $stack);
        } catch (HandlerFailedException $e) {
            \Tideways\Profiler::logException($e);

            throw $e;
        } finally {
            \Tideways\Profiler::stop();
        }
    }
}
