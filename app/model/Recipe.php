<?php

namespace app\model;

class Recipe implements \JsonSerializable
{
    private $_recipe_id;
    private $_nickname;
    private $_image;
    private $_category_id;
    private $_category_label;
    private $_cooking_time;
    private $_persons;
    private $_difficulty_label;
    private $_difficulty_id;
    private $_recipe_date;
    private $_recipe_title;
    private $_recipe_content;
    private $_nb_comments;

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

    public function jsonSerialize()
    {
        return [
            'id' => $this->_recipe_id,
            'image' => $this->_image,
            'title' => $this->_recipe_title,
            'date' => $this->_recipe_date,
            'nickname' => $this->_nickname,
            'time' => $this->_cooking_time,
            'category' => $this->_category_label,
            'categoryId' => $this->_category_id,
            'content' => $this->_recipe_content,
            'nbComments' => $this->_nb_comments
        ];
    }

    /**
     * @return mixed
     */
    public function getRecipeId(): int
    {
        return $this->_recipe_id;
    }

    /**
     * @param mixed $recipe_id
     */
    public function setRecipeId(int $recipe_id)
    {
        $this->_recipe_id = $recipe_id;
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
    public function getImage()
    {
        return $this->_image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->_image = $image;
    }

    /**
     * @return mixed
     */
    public function getCategoryId(): int
    {
        return $this->_category_id;
    }

    /**
     * @param mixed $category_id
     */
    public function setCategoryId(int $category_id)
    {
        $this->_category_id = $category_id;
    }

    /**
     * @return mixed
     */
    public function getCategoryLabel(): string
    {
        return $this->_category_label;
    }

    /**
     * @param mixed $category_label
     */
    public function setCategoryLabel(string $category_label)
    {
        $this->_category_label = $category_label;
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
        return $this->_difficulty_label;
    }

    /**
     * @param mixed $difficulty_label
     */
    public function setDifficultyLabel(string $difficulty_label)
    {
        $this->_difficulty_label = $difficulty_label;
    }

    /**
     * @return mixed
     */
    public function getDifficultyId(): int
    {
        return $this->_difficulty_id;
    }

    /**
     * @param mixed $difficulty_id
     */
    public function setDifficultyId(int $difficulty_id)
    {
        $this->_difficulty_id = $difficulty_id;
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

    /**
     * @return mixed
     */
    public function getNbComments() : int
    {
        return $this->_nb_comments;
    }

    /**
     * @param mixed $nb_comments
     */
    public function setNbComments(int $nb_comments)
    {
        $this->_nb_comments = $nb_comments;
    }

}