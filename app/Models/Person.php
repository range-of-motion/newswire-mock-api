<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $guarded = [
        //
    ];

    protected $appends = [
        'bio',
        'beats',
        'notes',
        'contact_methods',
    ];

    /**
     * Accessors
     */

    public function getBioAttribute()
    {
        return 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec cursus interdum nisi, vel lobortis urna luctus non.';
    }

    public function getBeatsAttribute()
    {
        return [
                'Business',
                'Economics',
                'Entrepreneurship',
            ];
    }

    public function getNotesAttribute()
    {
        return [
            [
                'title' => 'Note #1',
                'created_on' => '5/8/22',
            ], [
                'title' => 'Note #2',
                'created_on' => '5/8/22',
            ], [
                'title' => 'Note #3',
                'created_on' => '5/8/22',
            ]
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

    /**
     * Relationships
     */

    public function articles()
    {
        return $this->hasMany(Article::class, 'author_id');
    }
}
