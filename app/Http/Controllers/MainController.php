<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use App\Services\DishesService;
use App\Repositories\DishRepository;
use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;

class MainController extends BaseController
{
    protected $dishesService;

    public function __construct()
    {
        $this->dishesService = new DishesService();
    }

    /**
     * @return View
     */
    public function index() :View
    {
        $dishRepository = new DishRepository();
        $dishRepository->setText(trans("messages.start"));

        return view("index", ["dish" => $dishRepository]);
    }

    /**
     * @return View
     */
    public function next(int $id) :View
    {
        $dish = Dish::find($id);
        $newDish = $this->dishesService->getNext($dish);

        if (!$newDish->isDishFound()) {
            return view("store", ["dish" => $newDish]);
        }

        return view("form", ["dish" => $newDish]);
    }

    /**
     * @return View
     */
    public function start() :View
    {
        $dish = $this->dishesService->getFirst(new Dish());
        return view("form", ["dish" => $dish]);
    }

    /**
     * @return View
     */
    public function child(int $id) :View
    {
        $dish = Dish::find($id);
        $newDish = $this->dishesService->getChild($dish);
        return view("form", ["dish" => $newDish]);
    }

    /**
     * @param Request
     * 
     * @return JsonResponse
     */
    public function store(Request $request) :JsonResponse
    {
        $store = Dish::create($request->all());
        $dish = $this->dishesService->newDish($store);
        return response()->json(["id" => $store->id, "parent_id" => $store->parent_id]);
    }

    /**
     * @param Request
     * @param int
     * 
     * @return JsonResponse
     */
    public function update(Request $request, int $id) :JsonResponse
    {
        $dish = Dish::find($id);
        $dish->parent_id = $request->input("parent_id");
        $dish->save();
        return response()->json(["id" => $dish->id, "parent_id" => $dish->parent_id]);
    }

        /**
     * @param request
     * 
     * @return View
     */
    public function load(int $id) :View
    {
        $dish = Dish::find($id);

        $dishRepository = $this->dishesService->loadDish($dish);

        return view("store", ["dish" => $dishRepository]);
    }

}
