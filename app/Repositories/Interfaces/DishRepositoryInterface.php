<?php

namespace App\Repositories\Interfaces;

interface DishRepositoryInterface
{
    public function getNextByOrder($dish, $mainDefault);
    public function getChild($id);
}