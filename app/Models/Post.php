<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Qirolab\Laravel\Reactions\Contracts\ReactableInterface;
use Qirolab\Laravel\Reactions\Traits\Reactable;
use Overtrue\LaravelLike\Traits\Likeable;


class Post extends Model implements ReactableInterface
{
    use Likeable;
    use HasFactory, Reactable;

    protected $connection = 'adminaccount';

    protected $fillable = ['title'];

    public function getDescriptionAttribute()
    {
        return Str::limit($this->body, 200, '...');
    }
}
