<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    /**
     * Get a list of skills
     */
    public function index(Request $request)
    {
        $skills = Skill::orderBy('name')->get();

        return $skills;
    }
}
