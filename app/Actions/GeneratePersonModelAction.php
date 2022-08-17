<?php

namespace App\Actions;

class GeneratePersonModelAction
{
    public function execute(array $data, int $id): array
    {
        $data['id'] = $id;
        $data['bio'] = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec cursus interdum nisi, vel lobortis urna luctus non.';

        $data['articles'] = [];
        foreach (config('mock_data.articles') as $i => $article) {
            if ($article['author'] !== $data['name']) {
                continue;
            }

            $data['articles'][] = (new GenerateArticleModelAction())->execute($article, $i + 1);
        }

        return $data;
    }
}
