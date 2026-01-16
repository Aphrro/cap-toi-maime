<?php

namespace App\Livewire\Concerns;

use App\Models\Page;

trait WithPageContent
{
    public ?array $pageContent = [];
    public ?array $pageMeta = [];

    /**
     * Charge le contenu d'une page depuis le CMS
     */
    protected function loadPageContent(string $slug): void
    {
        $page = Page::findBySlug($slug);

        if ($page) {
            $this->pageContent = $page->content ?? [];
            $this->pageMeta = $page->meta ?? [];
        }
    }

    /**
     * Récupère une valeur du contenu avec fallback
     */
    protected function getContent(string $key, mixed $default = null): mixed
    {
        return data_get($this->pageContent, $key, $default);
    }

    /**
     * Récupère une valeur meta avec fallback
     */
    protected function getMeta(string $key, mixed $default = null): mixed
    {
        return data_get($this->pageMeta, $key, $default);
    }
}
