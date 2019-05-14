<?php
namespace app\model;

class CategoriesManager extends Manager
{
    public function getCategories()
    {
        try {
            $db = $this->dbconnect();
            $q = $db->query('SELECT id, cat_label from categories');

            $listCategoriesObj = [];

            while($category = $q->fetch()) {
                $dataCategories = [
                    'id' => $category['id'],
                    'catLabel' => $category['cat_label']
                ];
                $listCategoriesObj[] = new Category($dataCategories);
            }
            return $listCategoriesObj;

        } catch (\PDOException $pdoE) {
            throw new \Exception($pdoE->getMessage());
        }
    }
}