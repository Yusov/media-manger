<?php

declare(strict_types=1);

namespace MediaManager\Config;

interface UrlBuilderInterface
{
    /**
     * @return string|null
     */
    public function getPublicUrl(string $dpi): ?string;

    /**
     * Build URL according provided @vars and provided pattern of url
     *
     * @param string $urlPattern
     * @param array $vars
     *
     * @return void
     */
    public function buildUrl(string $urlPattern, array $vars): void;
}
