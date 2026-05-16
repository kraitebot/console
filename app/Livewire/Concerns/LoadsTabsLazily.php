<?php

declare(strict_types=1);

namespace App\Livewire\Concerns;

trait LoadsTabsLazily
{
    /** @var array<string, bool> */
    public array $loadedTabs = [];

    protected function isTabLoaded(string $tab): bool
    {
        return $this->loadedTabs[$tab] ?? false;
    }

    protected function markTabLoaded(string $tab): void
    {
        $this->loadedTabs[$tab] = true;
    }
}
