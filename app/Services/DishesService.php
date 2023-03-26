<?php

namespace App\Services;

use App\Models\Dish;
use App\Repositories\DishRepository;

class DishesService
{
    protected $dishRepository;

    protected $defaultFirstDish;

    public function __construct()
    {
        $this->dishRepository = new DishRepository();
        $this->defaultFirstDish = config("global.defaultFirstDish");
    }

    /**
     * @param Dish
     * 
     * @return DishRepository
     */
    public function getFirst(Dish $dish) :DishRepository
    {
        $newDish = $dish->first();
        $this->dishRepository->setText(trans("messages.question", ['name' => $newDish->name]));
        $this->dishRepository->setDish($newDish);
        return $this->dishRepository;
    }

    /**
     * @param Dish
     * 
     * @return DishRepository
     */
    public function getNext(Dish $dish) :DishRepository
    {
        $newDish = $this->getNextByOrder($dish);

        if (!$newDish) {
            $this->dishRepository->setText(trans("messages.not_found"));
            $this->dishRepository->setDishFound(false);
            $this->dishRepository->setParentId($dish->parent_id);
            return $this->dishRepository;
        }

        $this->dishRepository->setText(trans("messages.question", ['name' => $newDish->name]));
        $this->dishRepository->setDish($newDish);
        return $this->dishRepository;
    }

    /**
     * @param Dish
     * 
     * @return DishRepository
     */
    public function getChild(Dish $dish) :DishRepository
    {
        $newDish = Dish::where("parent_id", $dish->id)
            ->orderBy("id", "DESC")
            ->first();   

        if (!$newDish) {
            $this->dishRepository->setText(trans("messages.correct_answer"));
            $this->dishRepository->setCorrectAnswer(true);
            return $this->dishRepository;
        }

        $this->dishRepository->setText(trans("messages.question", ['name' => $newDish->name]));
        $this->dishRepository->setDish($newDish);

        return $this->dishRepository;
    }

    /**
     * @param Dish
     * 
     * @return DishRepository
     */
    public function newDish(Dish $dish) :DishRepository
    {
        $this->dishRepository->setText(trans("messages.new_dish", ['name' => $dish->name]));
        $this->dishRepository->setDish($dish);
        $this->dishRepository->setParentId($dish->parent_id);

        return $this->dishRepository;   
    }

    /**
     * @param Dish
     * 
     * @return DishRepository
     */
    public function loadDish(Dish $dish) :DishRepository
    {
        $this->dishRepository->setDish($dish);
        $this->dishRepository->setParentId($dish->parent_id);
        $this->dishRepository->setChildId($dish->id);
        $parent = $this->getNextByOrder($dish);

        $this->dishRepository->setText(trans("messages.new_dish", ["new" => $dish->name, "old" => $parent->name]));

        return $this->dishRepository;
    }

    /**
     * [The first dish has to be 'Massa' but the next one will be returned by DESC order]
     * 
     * @param Dish
     * 
     * @return Dish
     */
    public function getNextByOrder(Dish $dish)
    {
        $newDish = Dish::where("parent_id", $dish->parent_id)
            ->whereNot("id", $dish->id)
            ->orderBy("id", "DESC");
            
        $equal = ">";
        if ($dish->id != $this->defaultFirstDish) {
            $equal = "<";
            $newDish->whereBetween("id", [$this->defaultFirstDish, $dish->id])->whereNot("id", $this->defaultFirstDish);
        }

        return $newDish->where("id", $equal, $dish->id)->first();
    }
}

