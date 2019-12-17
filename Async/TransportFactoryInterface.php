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
 * Interface TransportFactoryInterface.
 */
interface TransportFactoryInterface
{
    public function createTransport(ResolveCacheAsyncInterface $resolveCacheAsync, callable $resolve = null, callable $reject = null);
}
