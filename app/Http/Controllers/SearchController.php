<?php

namespace App\Http\Controllers;

use App\Models\Posting;
use App\Models\Search;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    /**
     * Create a new search
     */
    public function create(Request $request)
    {
        return view('search.create');
    }

    /**
     * Store a search
     */
    public function store(Request $request)
    {
        $search = new Search;
        $search->save();

        foreach ($request->input('skills') as $skill) {
            $search->skills()->syncWithoutDetaching([$skill['id']]);
            $search->skills()->updateExistingPivot($skill['id'], ['rating' => $skill['rating']]);
        }

        return (new Response(['url' => '/search/'.$search['id']], 200))
            ->header('Content-Type', 'application/json');
    }

    /**
     *
     */
    public function show(Search $search)
    {
        return view('search.show')->with('searchId', $search['id']);
    }

    /**
     * Get search results
     */
    public function results(Search $search)
    {
        $postings = DB::select('
            select sum(ss.rating) as score, group_concat(s.name) as skills, p.*
            from postings p
            left join posting_skill ps on ps.posting_id = p.id
            left join search_skill ss on ss.skill_id = ps.skill_id
            left join skills s on s.id = ss.skill_id
            where ss.search_id = ?
            group by p.id
            order by sum(ss.rating) desc, p.id asc
        ', [$search['id']]);

        return $postings;
    }
}
