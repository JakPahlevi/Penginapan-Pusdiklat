<?php

namespace App\Repository;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAllCategories()
    {
        return Category::all();
    }
    public function getCategorybySlug($slug)
    {
        return Category::where('slug', $slug)->first();
    }
}