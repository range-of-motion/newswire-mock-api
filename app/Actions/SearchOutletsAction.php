<?php

namespace App\Actions;

use App\Models\Outlet;

class SearchOutletsAction
{
    public function execute(
        ?string $query,
        array $roles,
        array $outlets,
        array $locations,
    ): array {
        $builder = Outlet::query()
            ->with(['articles.author', 'articles.outlet']);

        if ($query) {
            $builder->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($query) . '%']);
                // ->orWhereRaw('LOWER(bio) LIKE ?', ['%' . strtolower($query) . '%']); // Not yet in use because bio isn't stored in database yet
        }

        if (count($roles) > 0) {
            // For now, if anyone filters by role, don't show
            // any outlets.

            return [];
        }

        if (count($outlets) > 0) {
            $builder->where(function ($builder) use ($outlets) {
                foreach ($outlets as $outlet) {
                    $builder->orWhereRaw('LOWER(name) = ?', [strtolower($outlet)]);
                }
            });
        }

        if (count($locations) > 0) {
            $builder->where(function ($builder) use ($locations) {
                foreach ($locations as $location) {
                    $builder->orWhereRaw('LOWER(location) = ?', [strtolower($location)]);
                }
            });
        }

        $outlets = $builder->get()->toArray();

        return $outlets;
    }
}
