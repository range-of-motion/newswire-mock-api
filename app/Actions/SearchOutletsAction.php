<?php

namespace App\Actions;

class SearchOutletsAction
{
    public function execute(
        ?string $query,
        array $roles,
        array $outlets,
        array $locations,
    ): array {
        $results = [];

        foreach (config('mock_data.outlets') as $i => $outlet) {
            $isResult = false;

            $outlet = (new GenerateOutletModelAction())->execute($outlet, $i + 1);

            if ($query) {
                $doesNameMatch = strpos(strtolower($outlet['name']), strtolower($query)) !== false;
                $doesBioMatch = strpos(strtolower($outlet['bio']), strtolower($query)) !== false;

                $isResult = $doesNameMatch || $doesBioMatch;

                if (!$isResult) {
                    continue;
                }
            }

            if (count($roles) > 0) {
                // For now, if anyone filters by role, don't show
                // any outlets.

                continue;
            }

            if (count($outlets) > 0) {
                foreach ($outlets as $o) {
                    $doesNameMatch = strpos(strtolower($outlet['name']), strtolower($o)) !== false;

                    $isResult = $doesNameMatch;
                }

                if (!$isResult) {
                    continue;
                }
            }

            if (count($locations) > 0) {
                foreach ($locations as $location) {
                    $isLocatedThere = strpos(strtolower($outlet['location']), strtolower($location)) !== false;

                    $isResult = $isLocatedThere;
                }

                if (!$isResult) {
                    continue;
                }
            }

            $results[] = $outlet;
        }

        return $results;
    }
}
