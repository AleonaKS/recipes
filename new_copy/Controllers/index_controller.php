<?php
include_once('Models/RecipeModel.php');

// Подключение к базе данных
$db_connection = mysqli_connect("localhost", "root", "", "cookbook");

// Проверка соединения с базой данных
if (!$db_connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Создание экземпляра модели
$recipeModel = new RecipeModel($db_connection, $recipeId = null);
// Получение данных из модели 
$lastRecipesHTML = $recipeModel->getLastRecipesHTML();

$category = new RecipeModel($db_connection, $recipeId = null);
// Получение данных из модели 
$categories = $category->getCategory();
// $recipeThis = new RecipeModel($db_connection);
// $recipeId = $_GET['id'];
// $recipeOne = $recipeThis->getRecipeDetailsHTML($recipeId); 



$recipeModelAll = new RecipeModel($db_connection, $recipeId = null);
$recipes = $recipeModelAll->getAllRecipes(); 

// Включение представления
include('Views/index_view.php');

?>