<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class ManagementController extends Controller
{
    public function index(){
        $categories = Category::with('task')->get();

        // Paginate tasks within each category separately
        $categories->transform(function ($category) {
            $perPage = 2;
            $currentPage = \Illuminate\Pagination\Paginator::resolveCurrentPage() ?: 1;
            $items = $category->task->slice(($currentPage - 1) * $perPage, $perPage)->all();
            $paginator = new \Illuminate\Pagination\LengthAwarePaginator($items, $category->task->count(), $perPage, $currentPage);

            // Set the path for the paginator manually
            $paginator->withPath(request()->url());

            $category->task = $paginator;

            return $category;
        });

        return view('management.index', compact('categories'));
    }
}
