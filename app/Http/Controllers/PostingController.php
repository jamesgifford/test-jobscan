<?php

namespace App\Http\Controllers;

use App\Models\Posting;
use Illuminate\Http\Request;

class PostingController extends Controller
{
    /**
     * Get a list of postings
     */
    public function index(Request $request)
    {
        $postings = Posting::all();

        return $postings;
    }
}
