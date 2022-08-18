<?php

namespace App\Actions;

class GeneratePersonModelAction
{
    public function execute(array $data, int $id): array
    {
        $data['id'] = $id;

        $data['bio'] = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec cursus interdum nisi, vel lobortis urna luctus non.';

        $data['beats'] = [
            'Business',
            'Economics',
            'Entrepreneurship',
        ];

        $data['notes'] = [
            [
                'title' => 'Note #1',
                'created_on' => '5/8/22',
            ], [
                'title' => 'Note #2',
                'created_on' => '5/8/22',
            ], [
                'title' => 'Note #3',
                'created_on' => '5/8/22',
            ]
        ];

        $data['contact_methods'] = [
            'emails' => ['replace_me@gmail.com'],
            'phones' => ['+31612345678'],
            'websites' => ['https://replace-me.com'],
            'addresses' => ['499 Replace Me'],
        ];

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
