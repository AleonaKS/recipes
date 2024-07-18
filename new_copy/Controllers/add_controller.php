<?php
error_reporting(E_ALL);
include_once('Models/RecipeModel.php');

 
$db_connection = mysqli_connect("localhost", "root", "", "cookbook");

if (!$db_connection) {
    die("连接失败: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $recipe_name = $_POST["recipe_name"];
    $instructions = $_POST["recipe_description"];
    $ingredients = $_POST["ingredients"];
 
    $recipe_id = insert_recipe($db_connection, $recipe_name);
 
    $instruction_steps = explode("\n", $instructions);
 
    insert_instructions($db_connection, $recipe_id, $instruction_steps);
 
    foreach ($ingredients as $ingredient) {
        $ingredient_parts = explode(":", $ingredient);
        $ingredient_id = $ingredient_parts[0];
        $quantity = $ingredient_parts[1];
 
        insert_recipe_ingredient($db_connection, $recipe_id, $ingredient_id, $quantity);
    }
 
    mysqli_close($db_connection);
}

include('Views/add_recipe.php');
?>