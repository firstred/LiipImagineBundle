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
interface ResolvePromiseCollectionInterface
{
    /**
     * Gets the Promise that is related to the image that gets processed immediately.
     *
     * Returns `null` when missing.
     *
     * @return mixed|null
     */
    public function getQuickImagePromise();

    /**
     * Gets the Promise collection that is related to images that get immediately processed.
     *
     * @return array
     */
    public function getQuickImagePromises(): array;

    /**
     * Gets the Promise that is related to the deferred image.
     *
     * Returns `null` when missing.
     *
     * @return mixed|null
     */
    public function getDeferredImagePromise();

    /**
     * Gets the Promise collection that is related to deferred images.
     *
     * @return array
     */
    public function getDeferredImagePromises(): array;
}
