<?php

namespace app\model;

class CommentsManager extends Manager
{
    /**
     * Get the comments list of a recipe
     * @param $id integer
     * @return array
     */
    public function getComments($id)
    {
        try {
            $db = $this->dbconnect();
            $q = $db->prepare('
            SELECT comments.id, comments.user_id, comments.cmt_content, comments.recipe_id, recipes.recipe_title, users.nickname,
            DATE_FORMAT(cmt_date, \'%d/%m/%Y à %Hh%i\')
            AS cmt_date
            FROM comments
            INNER JOIN recipes ON comments.recipe_id = recipes.id
            INNER JOIN users ON comments.user_id = users.id WHERE recipe_id = ?
            ORDER BY cmt_date DESC');
            $q->execute(array($id));
            $listComments = [];

            while ($comment = $q->fetch()) {
                $dataComments = [
                    'id' => $comment['id'],
                    'nickname' => $comment['nickname'],
                    'date' => $comment['cmt_date'],
                    'content' => $comment['cmt_content']
                ];
                $listComments[] = new Comment($dataComments);
            }
            return $listComments;
        } catch (\PDOException $pdoE) {
            echo 'Erreur PDO : ' . $pdoE->getMessage();
        }
    }

    public function addComment()
    {
        try {
            $db = $this->dbconnect();
            $q = $db->prepare('INSERT INTO comments (post_id, author_id, content, comment_date) VALUES (?, ?, ?, NOW())');
            $q->execute(array($postId, $authorId, $comment));
        } catch (\PDOException $pdoE) {
            echo 'Erreur PDO : ' . $pdoE->getMessage();
        }
    }
}