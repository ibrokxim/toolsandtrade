<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Service\SearchService;

class SearchController extends Controller
{
    public function search(Request $request, SearchService $searchService)
    {
        $search = $searchService->searchByAllTypes($request);
        return response()->json($search);
    }
}
