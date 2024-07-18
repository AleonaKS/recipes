<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Добавление рецепта</title>
<style>
    body {
        margin: 20px;
    }
    label, input, select, textarea {
        
        margin-bottom: 20px; 
    }
    button {
        margin-right: 10px;  
    }
    .ingredient-row {
        margin-bottom: 10px; 
    }
    </style>
    </head>
    <body>
    <div style="text-align: center;">


    <h1>Оформление рецепта</h1>
    </div>
    <div style="margin-left: 15px;">
        <a href="#" style="text-decoration: none;">&lt; Назад</a><br><br>
        <label for="photo">(Фотография готового блюда)</label><br>
        <input type="file" id="photo"><br>
        <label for="image_link">Поле для ссылки изображения</label><br>
        <input type="text" id="image_link"><br>
        <label for="recipe_name">Название рецепта</label><br>
        <input type="text" id="recipe_name"><br>
        <label for="recipe_description">Описание рецепта</label><br>
        <textarea id="recipe_description" style="width: 200px; height: 100px;"></textarea><br>
        <label for="category">Категория</label>
        <select id="category" style="width: 150px;">
        <?php 
        $db_connection = mysqli_connect("localhost", "root", "", "cookbook");
    
        $query = "SELECT * FROM Categories";
        $result = mysqli_query($db_connection, $query);
    
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='" . $row['category_id'] . "'>" . $row['name'] . "</option>";
        } 
        mysqli_close($db_connection);
        ?>
    </select><br>

    <label for="hours">Часы:</label>
    <input type="number" id="hours" name="hours" min="0" max="23" style="width: 50px;">

    <label for="minutes">Минуты:</label>
    <input type="number" id="minutes" name="minutes" min="0" max="59" style="width: 50px;"><br>

    <label for="portions">Порции</label>
    <input type="number" id="portions" value="1" style="width: 50px;">
    <button onclick="increasePortions()">+</button>
    <button onclick="decreasePortions()">-</button><br>

    <?php
$db_connection = mysqli_connect("localhost", "root", "", "cookbook");
 
$queryUnits = "SELECT * FROM Unit";
$resultUnits = mysqli_query($db_connection, $queryUnits);
 
$queryIngredients = "SELECT * FROM Ingredients";
$resultIngredients = mysqli_query($db_connection, $queryIngredients);
 
mysqli_close($db_connection);
?>

<label for="ingredients">Ингредиенты</label><br><br>
<div id="ingredientContainer">
    <?php 
    echo '<div class="ingredient-row">';
    for ($i = 0; $i < 3; $i++) {
        // echo '<div class="ingredient-row">';
        echo '<select class="ingredient" style="width: 200px;">';
        echo '<option value="" disabled selected>Наименование</option>';
        mysqli_data_seek($resultIngredients, 0);
        while ($row = mysqli_fetch_assoc($resultIngredients)) {
            echo "<option value='" . $row['ingredient_id'] . "'>" . $row['name'] . "</option>";
        }
        echo '</select>';
        echo '<input type="number" class="count" placeholder="Количество" style="width: 100px;">';
        
        echo '<select class="unit" style="width: 80px;">';
        echo '<option value="" disabled selected>ед.измерения</option>';
       
        mysqli_data_seek($resultUnits, 0);
        while ($row = mysqli_fetch_assoc($resultUnits)) {
            echo "<option value='" . $row['unit_id'] . "'>" . $row['unit_name'] . "</option>";
        }
        echo '</select>';
        
        echo '</div>';
    }
    ?>
</div>
<button id="addIngredientButton">+</button>

<script>
const addIngredientButton = document.getElementById('addIngredientButton');
const ingredientContainer = document.getElementById('ingredientContainer');

let ingredientIndex = 1;

addIngredientButton.addEventListener('click', function() {
    const newIngredientRow = document.createElement('div');
    newIngredientRow.className = 'ingredient-row';

    newIngredientRow.innerHTML = document.querySelector('.ingredient-row').innerHTML;

    ingredientContainer.appendChild(newIngredientRow);
    ingredientIndex++;
});
</script><br>

<br><br>
<label for="cooking_steps" style="font-size: 1.2em; font-weight: bold; margin-top: 20px; margin-bottom: 20px;">Как приготовить / пошаговая инструкция</label>

<br><br>
<div id="cooking_steps_container">
    <?php  
    for ($i = 1; $i <= 3; $i++) {
        echo '<div class="cooking-step">';
        echo '<label for="step_description_' . $i . '">Шаг ' . $i . ' Описание:</label>';
        echo '<input type="text" id="step_description_' . $i . '" name="step_description_' . $i . '">';
        echo '<label for="step_image_' . $i . '">Изображение:</label>';
        echo '<input type="text" id="step_image_' . $i . '" name="step_image_' . $i . '">';
        echo '</div>';
    }
    ?>
</div>
 
<button id="add_step">+</button>

<script>
const addStepButton = document.getElementById('add_step');
const cookingStepsContainer = document.getElementById('cooking_steps_container');

let stepIndex = 4;  

addStepButton.addEventListener('click', function() {
   
    const newStepDiv = document.createElement('div');
    newStepDiv.className = 'cooking-step';
 
    newStepDiv.innerHTML = `
        <label for="step_description_${stepIndex}">Шаг ${stepIndex} Описание:</label>
        <input type="text" id="step_description_${stepIndex}" name="step_description_${stepIndex}">
        <label for="step_image_${stepIndex}">Изображение :</label>
        <input type="text" id="step_image_${stepIndex}" name="step_image_${stepIndex}">
    `;
 
    cookingStepsContainer.appendChild(newStepDiv);
 
    stepIndex++;
});
</script>
<script>
    // Функция, которая будет вызываться после нажатия кнопки "Сохранить"
    function onSaveRecipe() {
        
        var recipeSavedSuccessfully = true;

        if (recipeSavedSuccessfully) {
            window.location.href = 'search.php';
        } else {
            alert('Ошибка при сохранении рецепта. Пожалуйста, попробуйте снова.');
        }
    }
</script>
</body>
</html>