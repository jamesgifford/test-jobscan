<?php

namespace App\Models;

use App\Models\Skill;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    use HasFactory;

    /**
     * The skills associated with the search.
     */
    public function skills()
    {
        return $this->belongsToMany(Skill::class)->withPivot('rating');
    }
}
