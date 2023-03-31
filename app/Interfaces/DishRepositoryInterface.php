<?php

namespace App\Interfaces;

use App\Models\Dish;

interface DishRepositoryInterface
{
    public function setText(string $text);
    public function getText();
    public function setDish(Dish $dish);
    public function getDish();
    public function setParentId($parentId);
    public function getParentId();
    public function setChildId($childId);
    public function getChildId();
    public function setCorrectAnswer(bool $correctAnswer);
    public function isCorrectAnswer();
}