<?php

declare(strict_types=1);

/*
 * This file is part of the `liip/LiipImagineBundle` project.
 *
 * (c) https://github.com/liip/LiipImagineBundle/graphs/contributors
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Liip\ImagineBundle\Async;

/**
 * Interface PromiseFactoryInterface.
 */
interface PromiseFactoryInterface
{
    public function createPendingPromise(callable $resolve = null, callable $reject = null): ResolvePromiseInterface;

    public function createFulfilledPromise($value): ResolvePromiseInterface;

    public function createRejectedPromise($exception): ResolvePromiseInterface;
}
