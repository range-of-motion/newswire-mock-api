<?php

namespace App\Actions;

class GenerateOutletModelAction
{
    public function execute(array $data, int $id): array
    {
        $data['id'] = $id;

        $data['bio'] = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sem justo, maximus at sagittis quis, fermentum sit amet lectus. Donec tempor mi sed metus dignissim, id condimentum odio rhoncus. Nam sit amet semper erat. Integer a purus euismod, sagittis nunc a, mollis ligula. Sed quis sollicitudin nisl. Vestibulum egestas porta arcu imperdiet elementum. Integer ut rutrum nunc. Curabitur id dui ultrices, dapibus quam ac, feugiat massa.';
        $data['unique_monthly_visitors'] = rand(1, 1000);

        $data['socials'] = [
            'twitter' => [
                'handle' => 'google',
                'followers' => '22.2k',
                'tweets' => '4.1k',
            ]
        ];

        $data['beats'] = [
            'Business',
            'Economics',
            'Entrepreneurship',
            'Investments',
            'Leadership',
        ];

        $data['channels'] = [
            'Consumer Magazine',
            'Online',
        ];

        $data['contact_information'] = [
            'emails' => ['replace_me@gmail.com'],
            'phones' => ['+31612345678'],
            'websites' => ['https://replace-me.com'],
            'addresses' => ['499 Replace Me'],
        ];

        $data['articles'] = [];
        foreach (config('mock_data.articles') as $i => $article) {
            if ($article['outlet'] !== $data['name']) {
                continue;
            }

            $data['articles'][] = (new GenerateArticleModelAction())->execute($article, $i + 1);
        }

        return $data;
    }
}
