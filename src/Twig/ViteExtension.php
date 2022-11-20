<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class ViteExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/2.x/advanced.html#automatic-escaping
            new TwigFilter('filter_name', [$this, 'doSomething']),
        ];
    }

    public function getFunctions(): array
    {
      return [
        new TwigFunction('vite_entry_script_tags', [$this, 'renderViteScriptTags'], ['is_safe' => ['html']]),
        new TwigFunction('vite_entry_link_tags', [$this, 'renderViteLinkTags'], ['is_safe' => ['html']]),
      ];
    }

    public function renderViteScriptTags(string $entryName, array $options = []): string
    {
      return $this->entrypointRenderer->renderScripts($entryName, $options);
    }
  
    public function renderViteLinkTags(string $entryName, array $options = []): string
    {
      return $this->entrypointRenderer->renderLinks($entryName, $options);
    }
}
