<?php

use App\Models\Outlet;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private array $outlets = [
        [
            'logo_url' => 'https://yt3.ggpht.com/Iv4QbKjK63MB70UvQ22FnTWF8KN3-2qZ2FqeFDiI-HVmidR7GJKo6UrVSwR6vsyHvmdm1pfirrg=s900-c-k-c0x00ffffff-no-rj',
            'name' => 'ABC News',
            'category' => 'Television',
            'location' => 'New York, USA',

            'socials' => [
                'twitter' => [
                    'handle' => 'abc_news',
                    'tweets' => '11k',
                    'followers' => '2.4k',
                ]
            ],
        ], [
            'logo_url' => 'https://play-lh.googleusercontent.com/Q4c136t3lerNkkRN5YHvcdGPSB-4KH3R8KbpCwA5Fks8DirzpVouTtoafBukp0cQ-4kP',
            'name' => 'CBS News',
            'category' => 'Television',
            'location' => 'New York, USA',

            'socials' => [],
        ], [
            'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/66/CNN_International_logo.svg/1200px-CNN_International_logo.svg.png',
            'name' => 'CNN',
            'category' => 'Television',
            'location' => 'Atlanta, USA',

            'socials' => [],
        ], [
            'logo_url' => 'http://awakenedtograce.com/wp-content/uploads/2019/12/fox-news-logo.jpg',
            'name' => 'Fox News',
            'category' => 'Television',
            'location' => 'New York, USA',

            'socials' => [],
        ], [
            'logo_url' => 'https://images-na.ssl-images-amazon.com/images/I/31dWAvGOQQL.png',
            'name' => 'MSNBC',
            'category' => 'Television',
            'location' => 'New York, USA',

            'socials' => [],
        ], [
            'logo_url' => 'https://media-cldnry.s-nbcnews.com/image/upload/newscms/2020_26/3392750/nbcnews_color_2_8.jpg',
            'name' => 'NBC News',
            'category' => 'Television',
            'location' => 'New York, USA',

            'socials' => [],
        ], [
            'logo_url' => 'https://www.ntvp.nl/wp-content/uploads/New-York-Times-Logo8x6_0-555x416.png',
            'name' => 'The New York Times',
            'category' => 'Newspaper',
            'location' => 'New York, USA',

            'socials' => [],
        ], [
            'logo_url' => 'https://play-lh.googleusercontent.com/aaMI1sQacFxeudBB81-fPIkpiu4M1fXpRX4FMPwWOJ8yuhk8t4cvzu65r7VrFrd9bg',
            'name' => 'USA Today',
            'category' => 'Newspaper',
            'location' => 'Virginia, USA',

            'socials' => [],
        ], [
            'logo_url' => 'https://play-lh.googleusercontent.com/eksxaPfxbTVb6VTl5aj1sXLpKc_N9Z6AZ3_5Oq6JhTXmgEQza-1v58a66p_ID0phE2Zv',
            'name' => 'The Wall Street Journal',
            'category' => 'Newspaper',
            'location' => 'New York, USA',

            'socials' => [],
        ], [
            'logo_url' => 'https://play-lh.googleusercontent.com/JDrO88srYGmqrOeyqtT1al3JQD0IKRS-OO7PDMjETiPuDNgCC45wJF8LIBH-QOcTMTE',
            'name' => 'The Washington Post',
            'category' => 'Newspaper',
            'location' => 'Washington, USA',

            'socials' => [],
        ],
    ];

    public function up(): void
    {
        foreach ($this->outlets as $outlet) {
            Outlet::create([
                'logo_url' => $outlet['logo_url'],
                'name' => $outlet['name'],
                'category' => $outlet['category'],
                'location' => $outlet['location'],
                'socials' => json_encode($outlet['socials'], JSON_FORCE_OBJECT),
            ]);
        }
    }

    public function down(): void
    {
        foreach ($this->outlets as $outlet) {
            $target = Outlet::query()
                ->where('name', $outlet['name'])
                ->first();

            if (!$target) {
                continue;
            }

            $target->delete();
        }
    }
};
