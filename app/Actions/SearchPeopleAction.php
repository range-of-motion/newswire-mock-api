<?php

namespace App\Actions;

class SearchPeopleAction
{
    public function execute(
        ?string $query,
        array $roles,
        array $outlets,
        array $locations,
    ): array {
        $results = [];

        foreach (config('mock_data.people') as $i => $person) {
            $isResult = false;

            $person = (new GeneratePersonModelAction())->execute($person, $i + 1);

            if ($query) {
                $doesNameMatch = strpos(strtolower($person['name']), strtolower($query)) !== false;

                $isResult = $doesNameMatch;

                if (!$isResult) {
                    continue;
                }
            }

            if (count($roles) > 0) {
                foreach ($roles as $role) {
                    $hasPosition = strpos(strtolower($person['position']), strtolower($role)) !== false;

                    $isResult = $hasPosition;
                }

                if (!$isResult) {
                    continue;
                }
            }

            if (count($outlets) > 0) {
                foreach ($outlets as $outlet) {
                    $worksAtOutlet = strpos(strtolower($person['position']), strtolower($outlet)) !== false;

                    $isResult = $worksAtOutlet;
                }

                if (!$isResult) {
                    continue;
                }
            }

            if (count($locations) > 0) {
                foreach ($locations as $location) {
                    $isLocatedThere = strpos(strtolower($person['location']), strtolower($location)) !== false;

                    $isResult = $isLocatedThere;
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
