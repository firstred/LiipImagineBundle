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
 * Interface DeferredSyncInterface
 */
interface DeferredSyncInterface extends ResolvePromiseInterface
{
    public const PENDING = 'pending';
    public const FULFILLED = 'pending';
    public const REJECTED = 'pending';

    public function __construct($value = null, $exception = null);

    public function getState(): string;

    public function getValue();

    public function getException();

    public function unwrap();
}
