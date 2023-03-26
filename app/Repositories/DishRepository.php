<?php

namespace App\Repositories;

use App\Interfaces\DishRepositoryInterface;
use App\Models\Dish;

class DishRepository implements DishRepositoryInterface
{
    protected $text = "";

    protected $dish;

    protected $dishFound = true;

    protected $parentId;

    protected $childId;

    protected $correctAnswer = false;

    public function setText(string $text) :void
    {
        $this->text = $text;
    }

    public function getText() :string
    {
        return $this->text;
    }

    public function setDish(Dish $dish) :void
    {
        $this->dish = $dish;
    }

    public function getDish()
    {
        return $this->dish;
    }

    public function setDishFound(bool $dishFound) :void
    {
        $this->dishFound = $dishFound;
    }

    public function isDishFound() :bool
    {
        return $this->dishFound;
    }

    public function setParentId($parentId) :void
    {
        $this->parentId = $parentId;
    }

    public function getParentId()
    {
        return $this->parentId;
    }

    public function setChildId($childId) :void
    {
        $this->childId = $childId;
    }

    public function getChildId()
    {
        return $this->childId;
    }

    public function setCorrectAnswer(bool $correctAnswer) :void
    {
        $this->correctAnswer = $correctAnswer;
    }

    public function isCorrectAnswer() :bool
    {
        return $this->correctAnswer;
    }
}