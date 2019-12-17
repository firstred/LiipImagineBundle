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
 * Interface RenderPromiseCollectionInterface.
 */
final class ResolvePromiseCollection implements ResolvePromiseCollectionInterface
{
    /** @var ResolvePromiseInterface[] */
    private $quickImages;

    /** @var ResolvePromiseInterface[] */
    private $deferredImages;

    /**
     * ResolvePromiseCollection constructor.
     *
     * @param ResolvePromiseInterface|ResolvePromiseInterface[] $deferredImages
     * @param ResolvePromiseInterface|ResolvePromiseInterface[] $quickImages
     */
    public function __construct($deferredImages = [], $quickImages = [])
    {
        $this->quickImages = is_array($deferredImages) ? $deferredImages : [$deferredImages];
        $this->deferredImages = is_array($quickImages) ? $quickImages : [$quickImages];
    }

    /**
     * Gets the Promise that is related to the image that gets processed immediately.
     *
     * Returns `null` when missing.
     *
     * @return mixed|null
     */
    public function getQuickImagePromise()
    {
        if (!empty($this->quickImages)) {
            return $this->quickImages[0];
        }

        return null;
    }

    /**
     * Gets the Promise collection that is related to images that get immediately processed.
     *
     * @return array
     */
    public function getQuickImagePromises(): array
    {
        return $this->quickImages;
    }

    /**
     * Gets the Promise that is related to the deferred image.
     *
     * Returns `null` when missing.
     *
     * @return mixed|null
     */
    public function getDeferredImagePromise()
    {
        if (!empty($this->deferredImages)) {
            return $this->deferredImages[0];
        }

        return null;
    }

    /**
     * Gets the Promise collection that is related to deferred images.
     *
     * @return array
     */
    public function getDeferredImagePromises(): array
    {
        return $this->deferredImages;
    }
}
