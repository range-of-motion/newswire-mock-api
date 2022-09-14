<?php

namespace App\Actions;

use App\Models\Article;

class SearchArticlesAction
{
    public function execute(
        ?string $query,
        array $roles,
        array $outlets,
        array $locations,
    ): array {
        $builder = Article::query();

        if ($query) {
            $builder->whereRaw('LOWER(title) LIKE ?', ['%' . strtolower($query) . '%']);
        }

        if (count($roles) > 0) {
            // For now, if anyone filters by role, don't show
            // any articles.

            return [];
        }

        if (count($outlets) > 0) {
            $builder->whereHas('outlet', function ($builder) use ($outlets) {
                foreach ($outlets as $outlet) {
                    $builder->orWhereRaw('LOWER(name) LIKE ?', ['%' . strtolower($outlet) . '%']);
                }
            });
        }

        if (count($locations) > 0) {
            // For now, if anyone filters by location, don't show
            // any articles.

            return [];
        }

        $articles = $builder->get()->toArray();

        return $articles;
    }
}
