<?php

namespace App\Traits;

trait SlugTrait
{
    protected function generateSlug(string $name): string
    {
        $slug = str_replace('&', 'and', $name);
        $slug = str_replace(['/', ',', ' ', '.'], '-', $slug);
        $slug = preg_replace('/[^a-zA-Z0-9-]/', '-', $slug);
        $slug = preg_replace('/-+/', '-', $slug);
        return strtolower($slug);
    }
}
