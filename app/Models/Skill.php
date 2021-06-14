<?php

namespace App\Models;

use App\Models\Posting;
use App\Models\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug'
    ];

    /**
     * The postings associated with the skill.
     */
    public function postings()
    {
        return $this->belongsToMany(Posting::class)->withPivot('rating');
    }

    /**
     * The searches associated with the skill.
     */
    public function searches()
    {
        return $this->belongsToMany(Search::class);
    }
}
