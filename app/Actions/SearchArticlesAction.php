<?php

namespace App\Actions;

class SearchArticlesAction
{
    public function execute(
        ?string $query,
        array $outlets,
    ): array {
        $results = [];

        foreach (config('mock_data.articles') as $i => $article) {
            $isResult = false;

            $article = (new GenerateArticleModelAction())->execute($article, $i + 1);

            if ($query) {
                $doesTitleMatch = strpos(strtolower($article['title']), strtolower($query)) !== false;

                if ($doesTitleMatch) {
                    $isResult = true;
                }

                if (!$isResult) {
                    continue;
                }
            }

            if (count($outlets) > 0) {
                foreach ($outlets as $outlet) {
                    $doesOutletMatch = strpos(strtolower($article['outlet']), strtolower($outlet)) !== false;

                    if ($doesOutletMatch) {
                        $isResult = true;
                    }
                }

                if (!$isResult) {
                    continue;
                }
            }

            $results[] = $article;
        }

        return $results;
    }
}
