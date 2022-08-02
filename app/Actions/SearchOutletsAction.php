<?php

namespace App\Actions;

class SearchOutletsAction
{
    public function execute(
        ?string $query,
        array $outlets,
    ): array {
        $results = [];

        foreach (config('mock_data.outlets') as $i => $outlet) {
            $isResult = false;

            $outlet = (new GenerateOutletModelAction())->execute($outlet, $i + 1);

            if ($query) {
                $doesNameMatch = strpos(strtolower($outlet['name']), strtolower($query)) !== false;
                $doesBioMatch = strpos(strtolower($outlet['bio']), strtolower($query)) !== false;

                if ($doesNameMatch || $doesBioMatch) {
                    $isResult = true;
                }

                if (!$isResult) {
                    continue;
                }
            }

            if (count($outlets) > 0) {
                foreach ($outlets as $o) {
                    $doesNameMatch = strpos(strtolower($outlet['name']), strtolower($o)) !== false;

                    if ($doesNameMatch) {
                        $isResult = true;
                    }
                }

                if (!$isResult) {
                    continue;
                }
            }

            if ($isResult) {
                $results[] = $outlet;
            }
        }

        return $results;
    }
}
