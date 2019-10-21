<?php
namespace cars\Controllers;
class ArticleController {
    private $articlesTable;
    private $get;
    private $post;

    public function __construct($articlesTable, array $get, array $post) {
        $this->articlesTable = $articlesTable;
        $this->get = $get;
        $this->post = $post;
    }

    public function home() {

        $articles = $this->articlesTable->findAll();

        return [
            'template' => 'home.html.php',
            'variables' => ['main' => 'home',
                            'articles' => $articles],
            'title' => "Claires's Cars - Home"
        ];
    }

    public function viewArticles() {
        $articles = $this->articlesTable->findAll();

        return [
            'template' => 'articles.html.php',
            'variables' => ['articles' => $articles],
            'title' => "Claires's Cars - Admin"
        ];
    }

    public function editArticle($errors = []) {
        if (isset($this->get['id'])){
            $article = $this->articlesTable->find('id', $this->get['id'])[0];
        } else {
            $article = false;
        }
        return [
            'template' => 'editarticle.html.php',
            'variables' => ['article' => $article,
                'errors' => $errors],
            'title' => "Claires's Cars - Admin"
        ];
    }

    public function validateArticle($article) {
        $errors = [];
        if ($article['name'] == '') {
            $errors[] = 'The name must not be blank';
        }
        if ($article['description'] == '') {
            $errors[] = 'The description must not be blank';
        }
        return $errors;
    }

    public function saveArticle() {
        $errors = $this->validateArticle($this->post['article']);
        if (count($errors) == 0) {
            $this->articlesTable->save($this->post['article']);
            if (!empty($_FILES)){
            if ($_FILES['image']['error'] == 0) {
                $fileName = $this->articlesTable->getLastInsertId() . '.jpg';
                echo $fileName;
                move_uploaded_file($_FILES['image']['tmp_name'], '../public/images/articles/' . $fileName);
            }
                return $this->viewArticles();
            } else {
                return $this->editArticle($errors);
            }
        }

    }

    public function deleteArticle() {
        $this->articlesTable->delete($this->post['id']);
        if (file_exists('images/articles/' . $this->post['id'] . '.jpg'))
        unlink('images/articles/' . $this->post['id'] . '.jpg');
        header('location: /admin/articles');
    }

}
