<?php

namespace App\Http\Controllers;

use App\Interfaces\BoardingHouseRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\CityRepositoryInterface;
use App\Models\BoardingHouse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private CityRepositoryInterface $cityRepository;
    private CategoryRepositoryInterface $categoryRepository;
    private BoardingHouseRepositoryInterface $boardingHouseRepository;

    public function __construct(
        CityRepositoryInterface $cityRepository,
        CategoryRepositoryInterface $categoryRepository,
        BoardingHouseRepositoryInterface $boardingHouseRepository
    ) {
        $this->cityRepository = $cityRepository;
        $this->categoryRepository = $categoryRepository;
        $this->boardingHouseRepository = $boardingHouseRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->getAllCategories();
        $popularBoardingHouse = $this->boardingHouseRepository->getPopularBoardingHouse();
        $cities = $this->cityRepository->getAllCities();
        $boardingHouses = $this->boardingHouseRepository->getAllBoardingHouse();


        return view('pages.home', compact('categories', 'popularBoardingHouse', 'cities', 'boardingHouses'));
    }

    public function seeAll()
    {
        $boardingHouse = $this->boardingHouseRepository->getShowAllBoardingHouse();
        return view('pages.popular.popular', compact('boardingHouse'));
    }
    public function show($slug)
    {
        $boardingHouse = $this->boardingHouseRepository->getBoardingHouseBySlug($slug);
        return view('pages.popular.show', compact('boardingHouse'));
    }
}
