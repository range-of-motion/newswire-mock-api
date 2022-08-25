<?php

namespace App\Actions;

class GenerateArticleModelAction
{
    public function execute(array $data, int $id): array
    {
        $data['id'] = $id;

        // Turn ['author' => name] into ['author' => ['id' => id, 'name' => name]]
        foreach (config('mock_data.people') as $i => $person) {
            if ($data['author'] !== $person['name']) {
                continue;
            }

            $data['author'] = [
                'id' => $i + 1,
                'name' => $person['name'],
            ];

            break;
        }

        $data['snippet'] = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sem justo, maximus at sagittis quis, fermentum sit amet lectus. Donec tempor mi sed metus dignissim, id condimentum odio rhoncus. Nam sit amet semper erat. Integer a purus euismod, sagittis nunc a, mollis ligula. Sed quis sollicitudin nisl. Vestibulum egestas porta arcu imperdiet elementum. Integer ut rutrum nunc. Curabitur id dui ultrices, dapibus quam ac, feugiat massa.';

        return $data;
    }
}
