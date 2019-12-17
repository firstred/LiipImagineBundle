<?php

declare(strict_types=1);

namespace Liip\ImagineBundle\Async;

use Exception;
use Liip\ImagineBundle\Exception\ExceptionInterface;

/**
 * Class CacheResolver.
 */
final class CacheResolver implements CacheResolverInterface
{
    /** @var CacheResolverProcessorInterface */
    private $cacheResolverProcessor;

    /** @var TransportFactoryInterface */
    private $transportFactory;

    /** @var PromiseFactoryInterface */
    private $promiseFactory;

    /**
     * CacheResolver constructor.
     *
     * @param CacheResolverProcessorInterface $cacheResolverProcessor
     */
    public function __construct(CacheResolverProcessorInterface $cacheResolverProcessor)
    {
        $this->cacheResolverProcessor = $cacheResolverProcessor;
    }

    /**
     * Resolve the cache in the background.
     *
     * @param ResolveCacheAsyncInterface $resolveCache
     *
     * @return ResolvePromiseCollectionInterface
     */
    public function resolve(ResolveCacheAsyncInterface $resolveCache): ResolvePromiseCollectionInterface
    {
        $quickImagePromise = null;

        if ($resolveCache->includesQuick()) {
            try {
                $quickImagePromise = $this->promiseFactory->createFulfilledPromise($this->cacheResolverProcessor->process($resolveCache));
            } catch (Exception | ExceptionInterface $e) {
                $quickImagePromise = $this->promiseFactory->createRejectedPromise($e);
            }
        }

        if (!($this->transportFactory instanceof TransportFactoryInterface)) {
            // No transport factory means we have to handle this synchronously
            /** @var ResolvePromiseInterface $deferredImagePromise */
            try {
                $deferredImagePromise = $this->promiseFactory->createFulfilledPromise($this->cacheResolverProcessor->process($resolveCache));
            } catch (Exception | ExceptionInterface $e) {
                $deferredImagePromise = $this->promiseFactory->createRejectedPromise($e);
            }
        } else {
            $deferredImagePromise = $this->promiseFactory->createPendingPromise(function () use (&$deferredImagePromise, $resolveCache) {
                $this->transportFactory->createTransport($resolveCache, $deferredImagePromise->resolve, $deferredImagePromise->reject);
            });
        }

        return new ResolvePromiseCollection($quickImagePromise, $deferredImagePromise);
    }

    /**
     * @param iterable|null $factories
     */
    public function setTransportFactories(iterable $factories = null): void
    {
        if (empty($factories)) {
            return;
        }

        $factories = iterator_to_array($factories->getIterator());

        $this->transportFactory = $factories[0];
    }

    /**
     * @param iterable $factories
     */
    public function setPromiseFactories(iterable $factories = null): void
    {
        if (empty($factories)) {
            return;
        }

        $factories = iterator_to_array($factories->getIterator());

        $chosenFactory = null;
        if (count($factories) >= 2) {
            foreach ($factories as $factory) {
                if (!($factory instanceof SyncPromiseFactory)) {
                    $chosenFactory = $factory;
                    break;
                }
            }
        } else {
            $chosenFactory = $factories[0];
        }

        $this->promiseFactory = $chosenFactory;
    }
}
