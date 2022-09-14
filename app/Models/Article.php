<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $appends = [
        'snippet',
    ];

    /**
     * Accessors
     */

    public function getSnippetAttribute()
    {
        return 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sem justo, maximus at sagittis quis, fermentum sit amet lectus. Donec tempor mi sed metus dignissim, id condimentum odio rhoncus. Nam sit amet semper erat. Integer a purus euismod, sagittis nunc a, mollis ligula. Sed quis sollicitudin nisl. Vestibulum egestas porta arcu imperdiet elementum. Integer ut rutrum nunc. Curabitur id dui ultrices, dapibus quam ac, feugiat massa.';
    }

    /**
     * Relationships
     */

    public function outlet()
    {
        return $this->belongsTo(Outlet::class);
    }
}
