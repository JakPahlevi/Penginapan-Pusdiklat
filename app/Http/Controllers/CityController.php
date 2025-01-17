<?php

namespace App\Http\Controllers;

use App\Interfaces\BoardingHouseRepositoryInterface;
use App\Interfaces\CityRepositoryInterface;
use Illuminate\Http\Request;

class CityController extends Controller
{
    private CityRepositoryInterface $cityRepository;
    private BoardingHouseRepositoryInterface $boardingHouseRepository;


    public function __construct(
        CityRepositoryInterface $cityRepository,
        BoardingHouseRepositoryInterface $boardingHouseRepository

    ) {
        $this->cityRepository = $cityRepository;
        $this->boardingHouseRepository = $boardingHouseRepository;
    }

    public function show($slug)
    {
        $city = $this->cityRepository->getCityBySlug($slug);
        $boardingHouses = $this->boardingHouseRepository->getBoardingHouseByCitySlug($slug);
        return view('pages.city.show', compact('boardingHouses', 'city'));
    }
}
