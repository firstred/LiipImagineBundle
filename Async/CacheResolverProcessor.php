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

use Exception;
use Liip\ImagineBundle\Imagine\Filter\FilterManager;
use Liip\ImagineBundle\Service\FilterService;

/**
 * Class ResolveCacheProcessorAsync.
 */
class CacheResolverProcessor implements CacheResolverProcessorInterface
{
    /** @var FilterManager */
    private $filterManager;

    /** @var FilterService */
    private $filterService;

    /**
     * @param FilterManager     $filterManager
     * @param FilterService     $filterService
     */
    public function __construct(
        FilterManager $filterManager,
        FilterService $filterService
    ) {
        $this->filterManager = $filterManager;
        $this->filterService = $filterService;
    }

    /**
     * @param ResolveCacheAsyncInterface $resolveCacheAsync
     *
     * @return mixed
     *
     * @throws Exception
     */
    public function process(ResolveCacheAsyncInterface $resolveCacheAsync): CacheResolvedAsync
    {
        /** @var ResolveCacheAsyncInterface $resolveCacheAsync */
        $filters = $resolveCacheAsync->getFilters() ?: array_keys($this->filterManager->getFilterConfiguration()->all());
        $path = $resolveCacheAsync->getPath();
        $uris = [];
        foreach ($filters as $filter) {
            if ($resolveCacheAsync->isForce()) {
                $this->filterService->bustCache($path, $filter);
            }

            $uris[$filter] = $this->filterService->getUrlOfFilteredImage($path, $filter);
        }

        return new CacheResolvedAsync($path, $uris);
    }
}
