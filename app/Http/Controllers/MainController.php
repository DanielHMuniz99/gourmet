<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use App\Services\DishesService;
use App\Repositories\DishRepository;
use App\Classes\DishItem;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use App\Repositories\Interfaces\DishRepositoryInterface;

class MainController extends BaseController
{
    /**
     * @return View
     */
    public function index() :View
    {
        $dishRepository = new DishItem();
        $dishRepository->setText(trans("messages.start"));
        return view("index", ["dish" => $dishRepository]);
    }

    /**
     * @param DishRepository
     * @param int
     * 
     * @return View
     */
    public function next(DishRepositoryInterface $dishRepository, int $id) :View
    {
        $dish = $dishRepository->getById($id);
        $dishesService = new DishesService($dish);
        $newDish = $dishesService->getNext();
        if (!$newDish->getDish()) {
            return view("store", ["dish" => $newDish]);
        }

        return view("form", ["dish" => $newDish]);
    }

    /**
     * @param DishRepository
     * @param int
     * 
     * @return View
     */
    public function child(DishRepositoryInterface $dishRepository, int $id) :View
    {
        $dish = $dishRepository->getById($id);
        $dishesService = new DishesService($dish);
        $newDish = $dishesService->getChild();
        return view("form", ["dish" => $newDish]);
    }

    /**
     * @return View
     */
    public function start() :View
    {
        $dishesService = new DishesService(new DishRepository());
        $dish = $dishesService->getFirst();
        return view("form", ["dish" => $dish]);
    }

    /**
     * @param DishRepository
     * @param Request
     * 
     * @return JsonResponse
     */
    public function store(DishRepositoryInterface $dishRepository, Request $request) :JsonResponse
    {
        $store = $dishRepository->create($request->all());
        $dishesService = new DishesService($store);
        $dish = $dishesService->newDish();
        return response()->json(["id" => $store->id, "parent_id" => $store->parent_id]);
    }

    /**
     * @param DishRepository
     * @param Request
     * @param int
     * 
     * @return JsonResponse
     */
    public function update(DishRepositoryInterface $dishRepository, Request $request, int $id) :JsonResponse
    {
        $dishRepository->update($id, ["parent_id" => $request->input("parent_id")]);
        $dish = $dishRepository->getById($id);
        return response()->json(["id" => $dish->id, "parent_id" => $dish->parent_id]);
    }

    /**
     * @param DishRepository
     * @param int
     * 
     * @return View
     */
    public function load(DishRepositoryInterface $dishRepository, int $id) :View
    {
        $dish = $dishRepository->getById($id);
        $dishesService = new DishesService($dish);
        $dishRepository = $dishesService->loadDish();
        return view("store", ["dish" => $dishRepository]);
    }
}
