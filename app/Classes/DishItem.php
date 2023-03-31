<?php

namespace App\Classes;

class DishItem
{
    public function __construct($dish = null, $text = "")
    {
        $this->dish = $dish;
        $this->text = $text;
    }

    protected $text = "";

    protected $dish;

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

    public function setDish($dish) :void
    {
        $this->dish = $dish;
    }

    public function getDish()
    {
        return $this->dish;
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