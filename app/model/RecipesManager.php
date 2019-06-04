<?php

namespace app\model;

class RecipesManager extends Manager {
//	public function getAllRecipes() {
//		try {
//			$db = $this->dbconnect();
//			$q = $db->query('
//        SELECT COUNT(comments.id) AS nbComments,
//        recipes.id AS recipeId, recipes.author_id, recipes.img_name, recipes.cat_id, recipes.dif_id,
//        recipes.cooking_time, recipes.persons, recipes.recipe_title, recipes.recipe_content,
//        users.nickname, categories.id AS categoryId, categories.cat_label, difficulty.id AS difficultyId, difficulty.dif_label, users.id AS userId,
//        DATE_FORMAT(recipe_date, \'%d/%m/%Y à %Hh%i\')
//        AS recipe_date
//        FROM recipes
//        LEFT JOIN comments ON recipes.id = comments.recipe_id
//        INNER JOIN users ON recipes.author_id = users.id
//        INNER JOIN categories ON recipes.cat_id = categories.id
//        INNER JOIN difficulty ON recipes.dif_id = difficulty.id
//        GROUP BY recipes.id
//        ORDER BY recipe_date DESC
//        ');
//			$listRecipesObj = [];
//			while ($recipe = $q->fetch()) {
//				$dataRecipe = [
//					'recipeId' => $recipe['recipeId'],
//					'nickname' => $recipe['nickname'],
//					'image' => $recipe['img_name'],
//					'categoryId' => $recipe['cat_id'],
//					'categoryLabel' => $recipe['cat_label'],
//					'cookingTime' => $recipe['cooking_time'],
//					'persons' => $recipe['persons'],
//					'difficultyId' => $recipe['dif_id'],
//					'difficultyLabel' => $recipe['dif_label'],
//					'recipeDate' => $recipe['recipe_date'],
//					'recipeTitle' => $recipe['recipe_title'],
//					'recipeContent' => $recipe['recipe_content'],
//					'nbComments' => $recipe['nbComments'],
//				];
//				// array dataRecipes envoyé à l'hydratation, qui renvoie les données à $listRecipesObj
//				$listRecipesObj[] = new Recipe($dataRecipe);
//			}
//			return $listRecipesObj;
//		} catch (\PDOException $pdoE) {
//			throw new \Exception($pdoE->getMessage());
//		}
//	}
	public function getLastRecipes() {
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
        ORDER BY recipeId DESC LIMIT 4 OFFSET 0
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
					'nbComments' => $recipe['nbComments'],
				];
				// array dataRecipes envoyé à l'hydratation, qui renvoie les données à $listRecipesObj
				$listRecipesObj[] = new Recipe($dataRecipe);
			}
			return $listRecipesObj;
		} catch (\PDOException $pdoE) {
			throw new \Exception($pdoE->getMessage());
		}
	}
	public function getRecipesByPage($nbRecipesByPage, $offset) {
		try {
			$db = $this->dbconnect();
			$q = $db->prepare('
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
        ORDER BY recipeId DESC LIMIT ' . $nbRecipesByPage . ' OFFSET ' . $offset);

			$q->execute(array($nbRecipesByPage, $offset));
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
					'nbComments' => $recipe['nbComments'],
				];
				// array dataRecipes envoyé à l'hydratation, qui renvoie les données à $listRecipesObj
				// crée un objet par recette
				$listRecipesObj[] = new Recipe($dataRecipe);
			}
			return $listRecipesObj;

		} catch (\PDOException $pdoE) {
			throw new \Exception($pdoE->getMessage());
		}
	}

	public function nbRecipesByPage($nbRecipesByPage, $offset) {
		$db = $this->dbconnect();
		$q = $db->prepare('SELECT * FROM recipes ORDER BY id LIMIT ' . $nbRecipesByPage . ' OFFSET ' . $offset);
		$q->execute(array($nbRecipesByPage, $offset));
	}

	public function getRecipe($recipeId) {
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
					'recipeContent' => $recipe['recipe_content'],
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

	public function getRecipesByCat($categoryId) {
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
					'recipeContent' => $recipe['recipe_content'],
				];
				$listRecipesObj[] = new Recipe($dataRecipe);
			}
			return $listRecipesObj;

		} catch (\PDOException $pdoE) {
			throw new \Exception($pdoE->getMessage());
		}
	}

	public function deleteRecipe($recipeId) {
		try {
			$db = $this->dbConnect();
			$q = $db->prepare('DELETE FROM recipes WHERE id = ?');
			$q->execute(array($recipeId));
		} catch (\PDOException $pdoE) {
			throw new \Exception($pdoE->getMessage());
		}
	}

	public function createRecipe($title, $categoryId, $content, $cookingTime, $image, $persons, $difficultyId) {
		try {
			$db = $this->dbConnect();
			$q = $db->prepare('
            INSERT INTO recipes(recipe_title, cat_id, recipe_content, cooking_time, img_name, persons, dif_id, author_id, recipe_date)
            VALUES(?, ?, ?, ?, ?, ?, ?, 8, NOW())');
			$q->execute(array($title, $categoryId, $content, $cookingTime, $image, $persons, $difficultyId));
		} catch (\PDOException $pdoE) {
			throw new \Exception($pdoE->getMessage());
		}
	}
	public function updateRecipe($title, $categoryId, $content, $cookingTime, $image, $persons, $difficultyId, $recipeId) {
		try {
			$db = $this->dbConnect();
			$q = $db->prepare('UPDATE recipes SET recipe_title = ?, cat_id = ?, recipe_content = ?, cooking_time = ?, img_name = ?, persons = ?, dif_id = ? WHERE id = ?');
			$q->execute(array($title, $categoryId, $content, $cookingTime, $image, $persons, $difficultyId, $recipeId));

		} catch (\PDOException $pdoE) {
			throw new \Exception($pdoE->getMessage());
		}
	}

	public function getRecipesByTitleOrCategory($keyword) {
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
            WHERE recipe_title LIKE :keyword OR categories.cat_label LIKE :keyword
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
					'recipeContent' => $recipe['recipe_content'],
				];

				$listRecipesObj[] = new Recipe($dataRecipe);
			}
			return $listRecipesObj;

		} catch (\PDOException $pdoE) {
			throw new \Exception($pdoE->getMessage());
		}
	}

	public function countRecipes() {
		try {
			$db = $this->dbconnect();
			$q = $db->query('SELECT COUNT(id) AS nbRecipes FROM recipes');
			$nbRecipes = $q->fetch(); // retourne la data 7
			$nbLines = $nbRecipes['nbRecipes'];
			return $nbLines;

		} catch (\PDOException $pdoE) {
			throw new \Exception($pdoE->getMessage());
		}
	}

}