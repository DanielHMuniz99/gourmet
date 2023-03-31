<?php

namespace App\Repositories;

use App\Models\Dish;
use App\Repositories\Interfaces\DishRepositoryInterface;

class DishRepository extends AbstractRepository implements DishRepositoryInterface
{
    protected $model = Dish::class;

    /**
     * [The first dish has to be 'Massa' but the next one will be returned by DESC order]
     * 
     * @param Dish
     * 
     * @return Dish
     */
    public function getNextByOrder($dish, $mainDefault)
    {
        return $this->model->where("parent_id", $dish->parent_id)
            ->whereNot("id", $dish->id)
            ->where("id", ">", $dish->id)
            ->orderBy("id", "ASC")
            ->first();
    }

    public function getChild($id)
    {
        return $this->model->where("parent_id", $id)
            ->orderBy("id", "ASC")
            ->first();   
    }
}