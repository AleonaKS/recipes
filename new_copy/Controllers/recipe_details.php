<?php
include_once('Models/RecipeModel.php');
// Подключение к базе данных
$db_connection = mysqli_connect("localhost", "root", "", "cookbook");

// Проверка соединения с базой данных
if (!$db_connection) {
    die("Connection failed: " . mysqli_connect_error());
} 

$recipeId = $_GET['id'];

$query = "SELECT * FROM recipes WHERE recipe_id = $recipeId";
    $result = mysqli_query($db_connection, $query);
    $recipeHTML = '';
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $recipeHTML .= '<div style="border: 1px solid #ccc; border-radius: 5px; padding: 10px; margin-bottom: 20px;">';
            $recipeHTML .= '<h2>' . $row['title'] . '</h2>';
            $recipeHTML .= '<p><strong>Совет:</strong> ' . $row['description'] . '</p>';
            $recipeHTML .= '<p><strong>Час:</strong> ' . $row['hour'] . '</p>';
            $recipeHTML .= '<p><strong>Минут:</strong> ' . $row['minute'] . '</p>';
            $recipeHTML .= '<p><strong>Порция:</strong> ' . $row['portia'] . '</p>';
            $recipeHTML .= '<p><strong>Калорийность:</strong> ' . $row['calories'] . '</p>';
            $recipeHTML .= '<p><strong>Белки:</strong> ' . $row['protein'] . '</p>';
            $recipeHTML .= '<p><strong>Жиры:</strong> ' . $row['fat'] . '</p>';
            $recipeHTML .= '<p><strong>Углеводы:</strong> ' . $row['carbohydrates'] . '</p>';
            $recipeHTML .= '<img src="' . $row['img'] . '" alt="' . $row['title'] . '" style="max-width: 100%;">'; 
            $recipeHTML .= '</div>';
        }
    } 
    echo $recipeHTML; 
mysqli_close($db_connection);
?>




