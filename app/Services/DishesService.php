<?php

namespace App\Services;

use App\Models\Dish;
use App\Classes\DishItem;
use App\Repositories\DishRepository;

class DishesService
{
    protected $dish;

    protected $defaultFirstDish;

    public function __construct($dish)
    {
        $this->dish = $dish;
        $this->defaultFirstDish = config("global.defaultFirstDish");
    }

    /**
     * @param Dish
     * 
     * @return DishItem
     */
    public function getFirst() :DishItem
    {
        $newDish = $this->dish->first();
        $text = trans("messages.question", ['name' => $newDish->name]);
        $dishItem = new DishItem($newDish, $text);
        return $dishItem;
    }

    /**
     * @param Dish
     * 
     * @return DishItem
     */
    public function getNext() :DishItem
    {
        $dishItem = new DishItem();
        $dishRepository = new DishRepository();
        $newDish = $dishRepository->getNextByOrder($this->dish, $this->defaultFirstDish);

        if (!$newDish) {
            $dishItem->setText(trans("messages.not_found"));
            $dishItem->setParentId($this->dish->parent_id);
            return $dishItem;
        }

        $dishItem->setText(trans("messages.question", ['name' => $newDish->name]));
        $dishItem->setDish($newDish);
        return $dishItem;
    }

    /**
     * @param Dish
     * 
     * @return DishItem
     */
    public function getChild() :DishItem
    {
        $dishItem = new DishItem();
        
        $dishRepository = new DishRepository();
        $newDish = $dishRepository->getChild($this->dish->id);

        if (!$newDish) {
            $dishItem->setText(trans("messages.correct_answer"));
            $dishItem->setCorrectAnswer(true);
            return $dishItem;
        }

        $dishItem->setText(trans("messages.question", ['name' => $newDish->name]));
        $dishItem->setDish($newDish);

        return $dishItem;
    }

    /**
     * @return DishItem
     */
    public function newDish() :DishItem
    {
        $text = trans("messages.new_dish", ['name' => $this->dish->name]);
        $dishItem = new DishItem($this->dish, $text);
        $dishItem->setParentId($this->dish->parent_id);
        return $dishItem;
    }

    /**
     * @return DishItem
     */
    public function loadDish() :DishItem
    {
        $dishRepository = new DishRepository();
        $parent = $dishRepository->getNextByOrder($this->dish, $this->defaultFirstDish);

        $text = trans("messages.new_dish", ["new" => isset($this->dish->name) ? $this->dish->name : '', "old" => isset($parent->name) ? $parent->name : '']);
        $dishItem = new DishItem($this->dish, $text);

        $dishItem->setParentId($this->dish->parent_id);
        $dishItem->setChildId($this->dish->id);

        return $dishItem;
    }
}

