<?php
require_once "PHPUnit/Autoload.php";
require_once "IArticleDAO.php";
require_once "ArticleDAO.php";

class ArticleDAOTest extends PHPUnit_Extensions_Database_TestCase
{
    public function getConnection() {
        $db = new PDO(
            "mysql:host=localhost;dbname=bulletproof", 
            "root", "password");
        return $this->createDefaultDBConnection($db, "bulletproof");
    }

    public function getDataSet() {
        return $this->createXMLDataSet("seed.xml");
    }

    public function testGetArticlesNonHome() {
        $articleDAO = new ArticleDAO();
        $articles = $articleDAO->getArticles(1, false);
        $this->assertEquals(
            array(
                array("id" => 1, "title" => "Android vs iOS"),
                array("id" => 2, "title" => "Android vs Wp7"),
                array("id" => 3, "title" => "iOS 5")),
            $articles);
    }

    public function testGetArticlesNonHomeNoArticles() {
        $articleDAO = new ArticleDAO();
        $articles = $articleDAO->getArticles(2, false);
        $this->assertEquals(array(), $articles);
    }
}

