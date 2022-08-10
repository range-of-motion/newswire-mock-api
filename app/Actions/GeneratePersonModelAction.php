<?php

namespace App\Actions;

class GeneratePersonModelAction
{
    public function execute(array $data, int $id): array
    {
        $data['id'] = $id;

        // $data['avatar_url'] = 'https://randomuser.me/api/portraits/' . ((rand(0, 1) === 1) ? 'men' : 'women') . '/' . $data['id'] . '.jpg';
        $data['bio'] = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec cursus interdum nisi, vel lobortis urna luctus non.';

        return $data;
    }
}
