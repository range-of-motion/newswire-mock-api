<?php

namespace App\Actions;

class SearchArticlesAction
{
    public function execute(
        ?string $query,
        array $roles,
        array $outlets,
        array $locations,
    ): array {
        $results = [];

        foreach (config('mock_data.articles') as $i => $article) {
            $isResult = false;

            $article = (new GenerateArticleModelAction())->execute($article, $i + 1);

            if ($query) {
                $doesTitleMatch = strpos(strtolower($article['title']), strtolower($query)) !== false;

                $isResult = $doesTitleMatch;

                if (!$isResult) {
                    continue;
                }
            }

            if (count($roles) > 0) {
                // For now, if anyone filters by role, don't show
                // any articles.

                continue;
            }

            if (count($outlets) > 0) {
                foreach ($outlets as $outlet) {
                    $doesOutletMatch = strpos(strtolower($article['outlet']['name']), strtolower($outlet)) !== false;

                    $isResult = $doesOutletMatch;
                }

                if (!$isResult) {
                    continue;
                }
            }

            if (count($locations) > 0) {
                // For now, if anyone filters by location, don't show
                // any articles.

                continue;
            }

            $results[] = $article;
        }

        return $results;
    }
}
