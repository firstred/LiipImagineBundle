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

use InvalidArgumentException;

/**
 * Class DeferredSync
 */
final class DeferredSync implements DeferredSyncInterface
{
    private $state;
    private $value;
    private $exception;

    public function __construct($value = null, $exception = null)
    {
        $this->state = static::PENDING;
        $this->value = $value;
        $this->exception = $exception;
    }

    public function then(callable $onResolved = null, callable $onRejected = null)
    {
        if ($this->exception) {
            $onRejected($this->exception);
            return $this;
        }

        if (isset($this->value)) {
            $onResolved($this->value);
            return $this;
        }

        return $this;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function unwrap()
    {
        return $this->exception ?: $this->value;
    }

    public function getException()
    {
        return $this->exception;
    }

    public function setState(string $state)
    {
        if (!in_array($state, [static::PENDING, static::FULFILLED, static::REJECTED])) {
            throw new InvalidArgumentException('Invalid state given');
        }

        $this->state = $state;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function resolve($value)
    {
        $this->state = static::FULFILLED;

        $this->exception = null;
        $this->value = $value;
    }

    public function reject($exception)
    {
        $this->state = static::REJECTED;

        $this->value = null;
        $this->exception = $exception;
    }
}
