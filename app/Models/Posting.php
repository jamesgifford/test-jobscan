<?php

namespace App\Models;

use App\Models\Skill;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'external_id',
        'title',
        'company',
        'slug'
    ];

    /**
     * The skills associated with the posting.
     */
    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }
}
