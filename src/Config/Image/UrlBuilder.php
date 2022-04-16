<?php

declare(strict_types=1);

namespace MediaManager\Config\Image;

use MediaManager\Config\UrlBuilderInterface;

class UrlBuilder implements UrlBuilderInterface
{
    private array $URLs = [];

    /**
     * {@inheritDoc}
     */
    public function getPublicUrl(string $dpi): ?string
    {
        return $this->URLs[$dpi] ?? null;
    }

    /**
     * @return array
     */
    public function getURLs(): array
    {
        return $this->URLs;
    }

    /**
     * @inheritDoc
     */
    public function buildUrl(string $urlPattern, array $vars, array $dpiSizes = []): void
    {
        if (!$vars) {
            return;
        }

        if (!$this->getURLs()) {
            $this->URLs[$vars['dpi']] = $this->takePathByVars($vars, $urlPattern);;
        }

        foreach (array_keys($dpiSizes) as $dpiSize) {
            $vars['dpi'] = $dpiSize;
            unset($dpiSizes[$dpiSize]);
            $this->URLs[$dpiSize] = $this->takePathByVars($vars, $urlPattern);

            $this->buildUrl($urlPattern, $vars, $dpiSizes);
        }

        array_unique($this->URLs);
    }

    /**
     * @param array $vars
     * @param string $urlPattern
     *
     * @return array|string|string[]
     */
    private function takePathByVars(array $vars, string $urlPattern)
    {
        $path = str_ireplace(array_keys($vars), array_values($vars), $urlPattern);
        $path = str_replace('{', '', str_replace('}', '', $path));

        return $path;
    }
}
