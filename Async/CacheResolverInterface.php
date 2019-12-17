<?php

declare(strict_types=1);

namespace Liip\ImagineBundle\Async;

/**
 * Interface CacheResolverInterface.
 */
interface CacheResolverInterface
{
    public function resolve(ResolveCacheAsyncInterface $resolveCache): ResolvePromiseCollectionInterface;

    public function setTransportFactories(iterable $factories = null): void;

    public function setPromiseFactories(iterable $factories = null): void;
}
