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
 * Class ResolveCacheAsync.
 */
final class ResolveCacheAsync implements ResolveCacheAsyncInterface
{
    /** @var string */
    private $path;

    /** @var array|string[]|null */
    private $filters;

    /** @var bool */
    private $force;

    /** @var bool */
    private $quick;

    /** @var mixed|null */
    private $metadata;

    /**
     * ResolveCacheAsync constructor.
     *
     * @param string        $path
     * @param string[]|null $filters
     * @param bool          $force
     * @param bool          $quick
     * @param mixed|null    $metadata
     */
    public function __construct(string $path, ?array $filters = null, bool $force = false, $quick = false, $metadata = null)
    {
        $this->path = $path;
        $this->filters = $filters;
        $this->force = $force;
        $this->quick = $quick;
        $this->metadata = $metadata;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return string[]|null
     */
    public function getFilters(): ?array
    {
        return $this->filters;
    }

    /**
     * @return bool
     */
    public function isForce(): bool
    {
        return $this->force;
    }

    /**
     * Returns whether a quick image should be rendered, too.
     *
     * @return bool
     */
    public function includesQuick(): bool
    {
        return $this->quick;
    }

    /**
     * Returns the metadata for this cache resolver
     *
     * @return mixed|null
     */
    public function getMetadata()
    {
        return $this->metadata;
    }
}
