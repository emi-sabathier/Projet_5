<?php

namespace app\model;

class Recipe
{
    private $_recipeId;
    private $_nickname;
    private $_categoryId;
    private $_cat_label;
    private $_cooking_time;
    private $_persons;
    private $_dif_label;
    private $_difficultyId;
    private $_recipe_date;
    private $_recipe_title;
    private $_recipe_content;

    // = (array $recipes)
    public function __construct(array $recipe)
    {
        $this->hydrate($recipe);
    }

    public function hydrate($recipe)
    {
        foreach ($recipe as $key => $value) {
            $setter = 'set' . ucfirst($key);
            if (method_exists($this, $setter)) {
                $this->$setter($value);
            }
        }
    }

    /**
     * @return mixed
     */
    public function getRecipeId(): int
    {
        return $this->_recipeId;
    }

    /**
     * @param mixed $id
     */
    public function setRecipeId(int $id)
    {
        $this->_recipeId = $id;
    }

    /**
     * @return mixed
     */
    public function getNickname(): string
    {
        return $this->_nickname;
    }

    /**
     * @param mixed $nickname
     */
    public function setNickname(string $nickname)
    {
        $this->_nickname = $nickname;
    }

    /**
     * @return mixed
     */
    public function getCategoryId(): int
    {
        return $this->_categoryId;
    }

    /**
     * @param mixed $cat_id
     */
    public function setCategoryId(int $cat_id)
    {
        $this->_categoryId = $cat_id;
    }

    /**
     * @return mixed
     */
    public function getCategoryLabel(): string
    {
        return $this->_cat_label;
    }

    /**
     * @param mixed $cat_label
     */
    public function setCategoryLabel(string $cat_label)
    {
        $this->_cat_label = $cat_label;
    }

    /**
     * @return mixed
     */
    public function getCookingTime(): int
    {
        return $this->_cooking_time;
    }

    /**
     * @param mixed $cooking_time
     */
    public function setCookingTime(int $cooking_time)
    {
        $this->_cooking_time = $cooking_time;
    }

    /**
     * @return mixed
     */
    public function getPersons(): int
    {
        return $this->_persons;
    }

    /**
     * @param mixed $persons
     */
    public function setPersons(int $persons)
    {
        $this->_persons = $persons;
    }

    /**
     * @return mixed
     */
    public function getDifficultyLabel(): string
    {
        return $this->_dif_label;
    }

    /**
     * @param mixed $dif_label
     */
    public function setDifficultyLabel(string $dif_label)
    {
        $this->_dif_label = $dif_label;
    }

    /**
     * @return mixed
     */
    public function getDifficultyId(): int
    {
        return $this->_difficultyId;
    }

    /**
     * @param mixed $dif_id
     */
    public function setDifficultyId(int $dif_id)
    {
        $this->_difficultyId = $dif_id;
    }

    /**
     * @return mixed
     */
    public function getRecipeDate(): string
    {
        return $this->_recipe_date;
    }

    /**
     * @param mixed $recipe_date
     */
    public function setRecipeDate(string $recipe_date)
    {
        $this->_recipe_date = $recipe_date;
    }

    /**
     * @return mixed
     */
    public function getRecipeTitle(): string
    {
        return $this->_recipe_title;
    }

    /**
     * @param mixed $recipe_title
     */
    public function setRecipeTitle(string $recipe_title)
    {
        $this->_recipe_title = $recipe_title;
    }

    /**
     * @return mixed
     */
    public function getRecipeContent(): string
    {
        return $this->_recipe_content;
    }

    /**
     * @param mixed $recipe_content
     */
    public function setRecipeContent(string $recipe_content)
    {
        $this->_recipe_content = $recipe_content;
    }

}