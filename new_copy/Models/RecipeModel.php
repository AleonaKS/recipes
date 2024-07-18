<?php
class RecipeModel {
    private $db_connection;
    private $recipeId;

    public function __construct($db_connection, $recipeId) {
        $this->db_connection = $db_connection;
        $this->recipeId = $recipeId;
    } 
    public function getCategory() {
        $query = "SELECT * FROM Categories";
        $result = mysqli_query($this->db_connection, $query);
        
        $categoriesHTML = ''; 
 
        $categoriesHTML .= '<div class="outer-container">';

        // Создаем один большой контейнер
        $categoriesHTML .= '<div class="big-container">';

        $count = 0; // Счетчик для отслеживания количества категорий

        while ($row = mysqli_fetch_assoc($result)) {
            // Начинаем средний контейнер после каждых трех категорий
            if ($count % 4 === 0 && $count !== 0) {
                $categoriesHTML .= '</div><div class="big-container">';
            }

            // Начинаем средний контейнер
            $categoriesHTML .= '<div class="middle-container">';

            // Добавляем маленький контейнер для каждого элемента
            $categoriesHTML .= '<div class="category-item">';
            $categoriesHTML .= '<img src="' . $row['link'] . '" alt="' . $row['name'] . '">';
            $categoriesHTML .= '<span class="category-name">' . $row['name'] . '</span>'; // Название категории
            $categoriesHTML .= '</div>';

            // Закрываем средний контейнер
            $categoriesHTML .= '</div>';

            $count++;
        }

        // Закрываем большой контейнер
        $categoriesHTML .= '</div>';

        // Закрываем внешний контейнер
        $categoriesHTML .= '</div>';
        
        return $categoriesHTML;
    }

    public function getLastRecipesHTML() {
        $query = "SELECT * FROM recipes";
        $result = mysqli_query($this->db_connection, $query);
        $recipesHTML = '<div style="overflow-x: auto; white-space: nowrap; height: 200px; margin-left: 20px;">'; // Включаем горизонтальную прокрутку и запрещаем перенос строк
        while ($row = mysqli_fetch_assoc($result)) {
            $recipesHTML .= '<div style="display: inline-block; margin-right: 20px;">'; // Отображаем рецепты в ряд и и и добавляем отступ между ними
            $recipesHTML .= '<a href="http://localhost/tests/Controllers/recipe_details.php?id=' . $row['recipe_id'] . '" target="_blank">';
            $recipesHTML .= '<img src="' . $row['img'] . '" alt="' . $row['title'] . '" style="max-height: 150px; border-radius: 10px;">';
            $recipesHTML .= '</a>';
            $recipesHTML .= '<p style="margin-top: 5px;">' . $row['title'] . '</p>';
            $recipesHTML .= '</div>';
        }
        $recipesHTML .= '</div>'; // Закрыть контейнер с рецептами
        return $recipesHTML;
    }


public function getAllRecipes() {
    $query = "SELECT * FROM recipes";
    $result = mysqli_query($this->db_connection, $query);
    $recipesHTML = '';

    while ($row = mysqli_fetch_assoc($result)) {
        $recipesHTML .= '<div style="border: 1px solid #ccc; border-radius: 5px; padding: 10px; margin-bottom: 20px;">';
        $recipesHTML .= '<h2>' . $row['title'] . '</h2>';
        $recipesHTML .= '<p><strong>Description:</strong> ' . $row['description'] . '</p>';
        $recipesHTML .= '<p><strong>Hour:</strong> ' . $row['hour'] . '</p>';
        $recipesHTML .= '<p><strong>Minute:</strong> ' . $row['minute'] . '</p>';
        $recipesHTML .= '<p><strong>Portia:</strong> ' . $row['portia'] . '</p>';
        $recipesHTML .= '<p><strong>Calories:</strong> ' . $row['calories'] . '</p>';
        $recipesHTML .= '<p><strong>Protein:</strong> ' . $row['protein'] . '</p>';
        $recipesHTML .= '<p><strong>Fat:</strong> ' . $row['fat'] . '</p>';
        $recipesHTML .= '<p><strong>Carbohydrates:</strong> ' . $row['carbohydrates'] . '</p>';
        $recipesHTML .= '<img src="' . $row['img'] . '" alt="' . $row['title'] . '" style="max-width: 100%;">'; 
        $recipesHTML .= '</a>';
        $recipesHTML .= '</div>';
    }
    return $recipesHTML;
}

// Метод для получения информации о рецепте по его ID
public function getRecipeDetailsHTML() {
    $query = "SELECT * FROM recipes WHERE recipe_id = $recipeId";
    $result = mysqli_query($this->db_connection, $query);
    $recipeHTML = '';
    // Обработка результатов
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $recipeHTML .= '<div style="border: 1px solid #ccc; border-radius: 5px; padding: 10px; margin-bottom: 20px;">';
            $recipeHTML .= '<h2>' . $row['title'] . '</h2>';
            $recipeHTML .= '<p><strong>Description:</strong> ' . $row['description'] . '</p>';
            $recipeHTML .= '<p><strong>Hour:</strong> ' . $row['hour'] . '</p>';
            $recipeHTML .= '<p><strong>Minute:</strong> ' . $row['minute'] . '</p>';
            $recipeHTML .= '<p><strong>Portia:</strong> ' . $row['portia'] . '</p>';
            $recipeHTML .= '<p><strong>Calories:</strong> ' . $row['calories'] . '</p>';
            $recipeHTML .= '<p><strong>Protein:</strong> ' . $row['protein'] . '</p>';
            $recipeHTML .= '<p><strong>Fat:</strong> ' . $row['fat'] . '</p>';
            $recipeHTML .= '<p><strong>Carbohydrates:</strong> ' . $row['carbohydrates'] . '</p>';
            $recipeHTML .= '<img src="' . $row['img'] . '" alt="' . $row['title'] . '" style="max-width: 100%;">'; 
            $recipeHTML .= '</div>';
        }
    } 
    return $recipeHTML;
    }
}
    // public function getAllRecipes() {
    //     $query = "SELECT * FROM recipes";
    //     $result = mysqli_query($this->db_connection, $query);
    //     $recipes = [];
    //     while ($row = mysqli_fetch_assoc($result)) {
    //         $recipes[] = $row;
    //     }
    //     return $recipes;
    // }


// class Recipe {
//     public $title;
//     public $description;
//     public $hour;
//     public $minute;
//     public $portia;
//     public $calories;
//     public $protein;
//     public $fat;
//     public $carbohydrates;
//     public $img;

//     // Конструктор для инициализации объекта Recipe
//     public function __construct($title, $description, $hour, $minute, $portia, $calories, $protein, $fat, $carbohydrates, $img) {
//         $this->title = $title;
//         $this->description = $description;
//         $this->hour = $hour;
//         $this->minute = $minute;
//         $this->portia = $portia;
//         $this->calories = $calories;
//         $this->protein = $protein;
//         $this->fat = $fat;
//         $this->carbohydrates = $carbohydrates;
//         $this->img = $img;
//     }
// }

// class RecipeDatabase {
//     private $db_connection;

//     // Конструктор для установки соединения с базой данных
//     public function __construct($db_connection) {
//         $this->db_connection = $db_connection;
//     }

//     // Метод для получения всех рецепепептов
//     public function getAllRecipes() {
//         $query = "SELECT * FROM recipes";
//         $result = mysqli_query($this->db_connection, $query);
//         $recipes = [];
//         while ($row = mysqli_fetch_assoc($result)) {
//             $recipe = new Recipe($row['title'], $row['description'], $row['hour'], $row['minute'], $row['portia'], $row['calories'], $row['protein'], $row['fat'], $row['carbohydrates'], $row['img']);
//             $recipes[] = $recipe;
//         }
//         return $recipes;
//     }
// }
?>

    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Categories</title>
    <link rel="stylesheet" type="text/css" href="Views/styles.css"> <!-- Подключаем CSS файл -->
</head>
</html>
