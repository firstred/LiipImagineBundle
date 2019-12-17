<?php

declare(strict_types=1);

namespace Liip\ImagineBundle\Async;

use Exception;

/**
 * Class SyncPromiseFactory.
 */
final class SyncPromiseFactory implements PromiseFactoryInterface
{
    public function createPendingPromise(callable $resolve = null, callable $reject = null): ResolvePromiseInterface
    {
        return new DeferredSync($resolve, $reject);
    }

    public function createFulfilledPromise($value): ResolvePromiseInterface
    {
        $deferred = new DeferredSync();
        $deferred->resolve($value);

        return $deferred;
    }

    public function createRejectedPromise($exception): ResolvePromiseInterface
    {
        $deferred = new DeferredSync();
        $deferred->reject($exception);

        return $deferred;
    }
}
