<?php

namespace App\Actions;

class GenerateArticleModelAction
{
    public function execute(array $data, int $id): array
    {
        $data['id'] = $id;

        return $data;
    }
}
