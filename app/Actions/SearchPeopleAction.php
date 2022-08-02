<?php

namespace App\Actions;

class SearchPeopleAction
{
    public function execute(
        ?string $query,
        array $outlets,
    ): array {
        $results = [];

        foreach (config('mock_data.people') as $i => $person) {
            $isResult = false;

            $person = (new GeneratePersonModelAction())->execute($person, $i + 1);

            if ($query) {
                $doesNameMatch = strpos(strtolower($person['name']), strtolower($query)) !== false;

                if ($doesNameMatch) {
                    $isResult = true;
                }

                if (!$isResult) {
                    continue;
                }
            }

            if (count($outlets) > 0) {
                foreach ($outlets as $outlet) {
                    $worksAtOutlet = strpos(strtolower($person['position']), strtolower($outlet)) !== false;

                    if ($worksAtOutlet) {
                        $isResult = true;
                    }
                }

                if (!$isResult) {
                    continue;
                }
            }

            $results[] = $person;
        }

        return $results;
    }
}
