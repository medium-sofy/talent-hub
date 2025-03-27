<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search()
    {
        $jobs = JobListing::query()
//            ->with('employer', 'category')
            ->where('title', 'LIKE', '%' . request('q') . '%')
            ->get();
        return view('home.results', ['home' => $jobs]);
    }
}
