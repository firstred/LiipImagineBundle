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
 * Interface ResolveCacheAsyncInterface.
 */
interface ResolveCacheAsyncInterface
{
    public function getPath(): string;

    public function getFilters(): ?array;

    public function isForce(): bool;

    public function includesQuick(): bool;

    public function getMetaData();
}
