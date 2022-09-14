<?php

namespace App\Actions;

use App\Models\Person;

class SearchPeopleAction
{
    public function execute(
        ?string $query,
        array $roles,
        array $outlets,
        array $locations,
    ): array {
        $builder = Person::query();

        if ($query) {
            $builder->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($query) . '%']);
        }

        if (count($roles) > 0) {
            $builder->where(function ($builder) use ($roles) {
                foreach ($roles as $role) {
                    $builder->orWhereRaw('LOWER(position) LIKE ?', ['%' . strtolower($role) . '%']);
                }
            });
        }

        if (count($outlets) > 0) {
            $builder->where(function ($builder) use ($outlets) {
                foreach ($outlets as $outlet) {
                    $builder->orWhereRaw('LOWER(position) LIKE ?', ['%' . strtolower($outlet) . '%']);
                }
            });
        }

        if (count($locations) > 0) {
            $builder->where(function ($builder) use ($locations) {
                foreach ($locations as $location) {
                    $builder->orWhereRaw('LOWER(location) LIKE ?', ['%' . strtolower($location) . '%']);
                }
            });
        }

        $people = $builder->get()->toArray();

        return $people;
    }
}
