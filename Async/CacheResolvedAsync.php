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
 * Class CacheResolvedAsync.
 */
final class CacheResolvedAsync implements CacheResolvedAsyncInterface
{
    /** @var string */
    private $path;

    /** @var string[]|null */
    private $uris;

    /** @var array|null */
    private $metadata;

    /**
     * CacheResolvedAsync constructor.
     *
     * @param string        $path
     * @param string[]|null $uris
     * @param array|null    $metadata
     */
    public function __construct(string $path, ?array $uris = null, ?array $metadata = null)
    {
        $this->path = $path;
        $this->uris = $uris;
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
    public function getUris(): ?array
    {
        return $this->uris;
    }

    /**
     * @return array|null
     */
    public function getMetadata(): ?array
    {
        return $this->metadata;
    }
}


