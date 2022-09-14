<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = [
        'bio',
        'unique_monthly_visitors',
        'socials',
        'beats',
        'channels',
        'contact_methods',
    ];

    /**
     * Accessors
     */

    public function getBioAttribute()
    {
        return 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sem justo, maximus at sagittis quis, fermentum sit amet lectus. Donec tempor mi sed metus dignissim, id condimentum odio rhoncus. Nam sit amet semper erat. Integer a purus euismod, sagittis nunc a, mollis ligula. Sed quis sollicitudin nisl. Vestibulum egestas porta arcu imperdiet elementum. Integer ut rutrum nunc. Curabitur id dui ultrices, dapibus quam ac, feugiat massa.';
    }

    public function getUniqueMonthlyVisitorsAttribute()
    {
        return rand(1, 1000);
    }

    public function getSocialsAttribute()
    {
        return [
            'twitter' => [
                'handle' => 'google',
                'followers' => '22.2k',
                'tweets' => '4.1k',
            ]
        ];
    }

    public function getBeatsAttribute()
    {
        return [
            'Business',
            'Economics',
            'Entrepreneurship',
            'Investments',
            'Leadership',
        ];
    }

    public function getChannelsAttribute()
    {
        return [
            'Consumer Magazine',
            'Online',
        ];
    }

    public function getContactMethodsAttribute()
    {
        return [
            'emails' => ['replace_me@gmail.com'],
            'phones' => ['+31612345678'],
            'websites' => ['https://replace-me.com'],
            'addresses' => ['499 Replace Me'],
        ];
    }
}
