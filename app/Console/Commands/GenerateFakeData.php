<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\Outlet;
use App\Models\Person;
use Illuminate\Console\Command;

class GenerateFakeData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fake-data:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates fake people and articles';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $positions = [
            'Editor',
            'Director',
            'Analyst',
            'Writer',
            'Publisher',
            'Manager',
            'Reporter',
            'Reviewer',
            'Intern',
            'Consultant',
        ];

        $locations = [
            // USA
            'New York, USA',
            'Houston, USA',
            'Phoenix, USA',
            'Los Angeles, USA',
            'Dallas, USA',
            'Indianapolis, USA',
            'New Orleans, USA',
            'Memphis, USA',
            'Austin, USA',
            'San Francisco, USA',

            // The Netherlands
            'Amsterdam, The Netherlands',
            'Utrecht, The Netherlands',

            // Germany
            'Berlin, Germany',
            'Frankfurt, Germany',
            'Hamburg, Germany',
            'Cologne, Germany',
            'Munich, Germany',

            // France
            'Paris, France',
            'Marseille, France',
            'Bordeaux, France',
            'Lyon, France',
        ];

        /**
         * Generate fake people
         */

        for ($i = 0; $i < 1000; $i ++) {
            echo 'Generating ' . ($i + 1) . ' of 1000 people' . PHP_EOL;

            $outlet = Outlet::query()
                ->inRandomOrder()
                ->first();

            Person::create([
                'name' => fake()->firstName . ' ' . fake()->lastName,
                'avatar_url' => 'https://picsum.photos/256',
                'position' => fake()->randomElement($positions) . ', ' . $outlet->name,
                'location' => fake()->randomElement($locations),
                'socials' => '{}',
            ]);
        }

        /**
         * Generate fake articles
         */

        for ($i = 0; $i < 1000; $i ++) {
            echo 'Generating ' . ($i + 1) . ' of 1000 articles' . PHP_EOL;

            $author = Person::query()
                ->inRandomOrder()
                ->first();

            $positionParts = explode(', ', $author->position);

            $outlet = Outlet::query()
                ->where('name', $positionParts[1])
                ->first();

            $title = fake('en_US')->realText(80);

            // 50/50 chance that the word "iPhone" appears in title
            if (rand(0, 1) === 1) {
                $titleParts = explode(' ', $title);

                $randomInsertionIndex = rand(0, count($titleParts));
                $titleParts[$randomInsertionIndex] = 'iPhone';

                $title = implode(' ', $titleParts);
            }

            Article::create([
                'author_id' => $author->id,
                'outlet_id' => $outlet->id,
                'title' => $title,
                'url' => 'https://longform.org/random',
            ]);
        }

        return 0;
    }
}
