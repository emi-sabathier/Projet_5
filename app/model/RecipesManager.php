<?php

namespace app\model;

class RecipesManager extends Manager
{
    private $lastId;

    /**
     * @return array
     * @throws \Exception
     */
    public function getRecipes()
    {
        try {
            $db = $this->dbconnect();
            $q = $db->query('
        SELECT COUNT(comments.id) AS nbComments,
        recipes.id AS recipeId, recipes.author_id, recipes.img_name, recipes.cat_id, recipes.dif_id,
        recipes.cooking_time, recipes.persons, recipes.recipe_title, recipes.recipe_content,
        users.nickname, categories.id AS categoryId, categories.cat_label, difficulty.id AS difficultyId, difficulty.dif_label, users.id AS userId,
        DATE_FORMAT(recipe_date, \'%d/%m/%Y à %Hh%i\')
        AS recipe_date
        FROM recipes
        LEFT JOIN comments ON recipes.id = comments.recipe_id
        INNER JOIN users ON recipes.author_id = users.id
        INNER JOIN categories ON recipes.cat_id = categories.id
        INNER JOIN difficulty ON recipes.dif_id = difficulty.id
        GROUP BY recipes.id
        ORDER BY recipe_date DESC
        ');
            $listRecipesObj = [];

            while ($recipe = $q->fetch()) {
                $dataRecipe = [
                    'recipeId' => $recipe['recipeId'],
                    'nickname' => $recipe['nickname'],
                    'image' => $recipe['img_name'],
                    'categoryId' => $recipe['cat_id'],
                    'categoryLabel' => $recipe['cat_label'],
                    'cookingTime' => $recipe['cooking_time'],
                    'persons' => $recipe['persons'],
                    'difficultyId' => $recipe['dif_id'],
                    'difficultyLabel' => $recipe['dif_label'],
                    'recipeDate' => $recipe['recipe_date'],
                    'recipeTitle' => $recipe['recipe_title'],
                    'recipeContent' => $recipe['recipe_content'],
                    'nbComments' => $recipe['nbComments']
                ];
                // array dataRecipes envoyé à l'hydratation, qui renvoie les données à $listRecipesObj
                $listRecipesObj[] = new Recipe($dataRecipe);
            }
            return $listRecipesObj;
        } catch (\PDOException $pdoE) {
            throw new \Exception($pdoE->getMessage());
        }
    }

    public function getRecipe($recipeId)
    {
        try {
            $db = $this->dbconnect();
            $q = $db->prepare
            ('SELECT
        recipes.id AS recipeId, recipes.author_id, recipes.img_name, recipes.cat_id, recipes.dif_id,
        recipes.cooking_time, recipes.persons, recipes.recipe_title, recipes.recipe_content,
        users.nickname, categories.id AS categoryId, categories.cat_label, difficulty.id AS difficultyId, difficulty.dif_label, users.id AS userId,
        DATE_FORMAT(recipe_date, \'%d/%m/%Y à %Hh%i\')
        AS recipe_date
        FROM recipes
        INNER JOIN users ON recipes.author_id = users.id
        INNER JOIN categories ON recipes.cat_id = categories.id
        INNER JOIN difficulty ON recipes.dif_id = difficulty.id
        WHERE recipes.id = ?');
            $q->execute(array($recipeId));
            $recipe = $q->fetch();
            // Soit renvoie false, ou renvoie les données recettes
            if ($recipe != false) {
                $dataRecipe = [
                    'recipeId' => $recipe['recipeId'],
                    'nickname' => $recipe['nickname'],
                    'image' => $recipe['img_name'],
                    'categoryId' => $recipe['categoryId'],
                    'categoryLabel' => $recipe['cat_label'],
                    'cookingTime' => $recipe['cooking_time'],
                    'persons' => $recipe['persons'],
                    'difficultyId' => $recipe['difficultyId'],
                    'difficultyLabel' => $recipe['dif_label'],
                    'recipeDate' => $recipe['recipe_date'],
                    'recipeTitle' => $recipe['recipe_title'],
                    'recipeContent' => $recipe['recipe_content']
                ];
                $recipeObj = new Recipe($dataRecipe);
                return $recipeObj;
            } else {
                return false;
            }
        } catch (\PDOException $pdoE) {
            throw new \Exception($pdoE->getMessage());
        }
    }

    public function getRecipesByCat($categoryId)
    {
        try {
            $db = $this->dbconnect();
            $q = $db->prepare
            ('SELECT
        recipes.id AS recipeId, recipes.author_id,  recipes.img_name, recipes.cat_id, recipes.dif_id,
        recipes.cooking_time, recipes.persons, recipes.recipe_title, recipes.recipe_content,
        users.nickname, categories.id AS categoryId, categories.cat_label, difficulty.id AS difficultyId, difficulty.dif_label, users.id AS userId,
        DATE_FORMAT(recipe_date, \'%d/%m/%Y à %Hh%i\')
        AS recipe_date
        FROM recipes
        INNER JOIN users ON recipes.author_id = users.id
        INNER JOIN categories ON recipes.cat_id = categories.id
        INNER JOIN difficulty ON recipes.dif_id = difficulty.id
        WHERE recipes.cat_id = ?');
            $q->execute(array($categoryId));
            $listRecipesObj = [];
            while ($recipe = $q->fetch()) {
                $dataRecipe = [
                    'recipeId' => $recipe['recipeId'],
                    'nickname' => $recipe['nickname'],
                    'image' => $recipe['img_name'],
                    'categoryId' => $recipe['categoryId'],
                    'categoryLabel' => $recipe['cat_label'],
                    'cookingTime' => $recipe['cooking_time'],
                    'persons' => $recipe['persons'],
                    'difficultyId' => $recipe['difficultyId'],
                    'difficultyLabel' => $recipe['dif_label'],
                    'recipeDate' => $recipe['recipe_date'],
                    'recipeTitle' => $recipe['recipe_title'],
                    'recipeContent' => $recipe['recipe_content']
                ];
                $listRecipesObj[] = new Recipe($dataRecipe);
            }
            return $listRecipesObj;

        } catch (\PDOException $pdoE) {
            throw new \Exception($pdoE->getMessage());
        }
    }

    public function deleteRecipe($recipeId)
    {
        try {
            $db = $this->dbConnect();
            $q = $db->prepare('DELETE FROM recipes WHERE id = ?');
            $q->execute(array($recipeId));
        } catch (\PDOException $pdoE) {
            throw new \Exception($pdoE->getMessage());
        }
    }

    public function createRecipe($title, $categoryId, $content, $cookingTime, $image, $persons, $difficultyId)
    {
        try {
            $db = $this->dbConnect();
            $q = $db->prepare('
            INSERT INTO recipes(recipe_title, cat_id, recipe_content, cooking_time, img_name, persons, dif_id, author_id, recipe_date) 
            VALUES(?, ?, ?, ?, ?, ?, ?, 8, NOW())');
            $q->execute(array($title, $categoryId, $content, $cookingTime, $image, $persons, $difficultyId));
            $this->lastId = $db->lastInsertId();
        } catch (\PDOException $pdoE) {
            throw new \Exception($pdoE->getMessage());
        }
    }

    public function createRecipeIngredients($ingredientId, $quantity, $unit)
    {
        try {
            $db = $this->dbConnect();
            $lastRecipeId = $this->lastId;
            $q = $db->prepare('
            INSERT INTO ingredients_recipes(ingredient_id, quantity, unit, recipe_id)
            VALUES(?, ?, ?, :recipeId )');
            $q->bindParam(':recipeId', $lastRecipeId);
            $q->execute(array($ingredientId, $quantity, $unit, $lastRecipeId));
        } catch (\PDOException $pdoE) {
            throw new \Exception($pdoE->getMessage());
        }
    }

    public function updateRecipe($title, $categoryId, $content, $cookingTime, $image, $persons, $difficultyId, $recipeId)
    {
        try {
            $db = $this->dbConnect();
            $q = $db->prepare('UPDATE recipes SET recipe_title = ?, cat_id = ?, recipe_content = ?, cooking_time = ?, img_name = ?, persons = ?, dif_id = ? WHERE id = ?');
            $q->execute(array($title, $categoryId, $content, $cookingTime, $image, $persons, $difficultyId, $recipeId));

        } catch (\PDOException $pdoE) {
            throw new \Exception($pdoE->getMessage());
        }
    }

    public function getRecipesByTitleOrContent($keyword)
    {
        try {
            $db = $this->dbConnect();
            $q = $db->prepare('
            SELECT  
            recipes.id AS recipeId, recipes.author_id, recipes.img_name, recipes.cat_id, recipes.dif_id,
            recipes.cooking_time, recipes.persons, recipes.recipe_title, recipes.recipe_content,
            users.nickname, categories.id AS categoryId, categories.cat_label, difficulty.id AS difficultyId, difficulty.dif_label, users.id AS userId,
            DATE_FORMAT(recipe_date, \'%d/%m/%Y à %Hh%i\')
            AS recipe_date
            FROM recipes
            INNER JOIN users ON recipes.author_id = users.id
            INNER JOIN categories ON recipes.cat_id = categories.id
            INNER JOIN difficulty ON recipes.dif_id = difficulty.id
            WHERE recipe_title LIKE :keyword
            ORDER BY recipe_date DESC
            ');
            $q->execute(array(':keyword' => '%' . $keyword . '%'));

            $listRecipesObj = [];

            while ($recipe = $q->fetch()) {
                $dataRecipe = [
                    'recipeId' => $recipe['recipeId'],
                    'nickname' => $recipe['nickname'],
                    'image' => $recipe['img_name'],
                    'categoryId' => $recipe['cat_id'],
                    'categoryLabel' => $recipe['cat_label'],
                    'cookingTime' => $recipe['cooking_time'],
                    'persons' => $recipe['persons'],
                    'difficultyId' => $recipe['dif_id'],
                    'difficultyLabel' => $recipe['dif_label'],
                    'recipeDate' => $recipe['recipe_date'],
                    'recipeTitle' => $recipe['recipe_title'],
                    'recipeContent' => $recipe['recipe_content']
                ];

                $listRecipesObj[] = new Recipe($dataRecipe);
            }
            return $listRecipesObj;

        } catch (\PDOException $pdoE) {
            throw new \Exception($pdoE->getMessage());
        }
    }

    public function countRecipes()
    {
        try {
            $db = $this->dbconnect();
            $q = $db->query('SELECT COUNT(id) AS nbRecipes FROM recipes');
            $nbRecipes = $q->fetch();
            $nbLines = $nbRecipes['nbRecipes'];
            return $nbLines;

        } catch (\PDOException $pdoE) {
            throw new \Exception($pdoE->getMessage());
        }
    }
}