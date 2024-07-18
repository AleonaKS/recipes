<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Поиск рецептов</title> 
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
</head>
<body>
    <header> 
        <div class="search-bar">
            <input type="text" placeholder="Введите название блюда...">
            <button type="submit"><i class="fas fa-search"></i> Поиск</button>
        </div>
    </header>
    <?php echo $recipes; ?>  
    <main>
        <!-- Фильтры и сортировка -->
        <div class="filters">
            <!-- Фильтр по категориям (добавьте категории по мере необходимости) -->
            <select name="category">
            <?php 
                $db_connection = mysqli_connect("localhost", "root", "", "cookbook");
            
                $query = "SELECT * FROM Categories";
                $result = mysqli_query($db_connection, $query);
            
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['category_id'] . "'>" . $row['name'] . "</option>";
                } 
                mysqli_close($db_connection);
                ?>
            </select>

            <!-- Сортировка по времени приготовления -->
            <select name="sort-by">
                <option value="asc">По возрастанию времени</option>
                <option value="desc">По убыванию времени</option>
            </select>

            <!-- Поля для ввода времени приготовления (часы и минуты) -->
            <input type="number" name="prep-hours" placeholder="Часы">
            <input type="number" name="prep-minutes" placeholder="Минуты">
            
            <?php 
// Подключение к базе данных
$db_connection = mysqli_connect("localhost", "root", "", "cookbook");

// Проверка соединения с базой данных
if (!$db_connection) {
    die("Connection failed: " . mysqli_connect_error());
} 
$query = " SELECT r.*
FROM Recipes r
JOIN Recipe_Category rc ON r.recipe_id = rc.recipe_id
JOIN Categories c ON rc.category_id = c.category_id
WHERE c.name = 'Завтраки'";
// $query = "SELECT * FROM recipes ORDER BY hour ASC, minute ASC";
    $result = mysqli_query($db_connection, $query);
    $recipeHTML = '';
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $recipeHTML .= '<div style="border: 1px solid #ccc; border-radius: 5px; padding: 10px; margin-bottom: 20px;">';
            $recipeHTML .= '<h2>' . $row['title'] . '</h2>';
            $recipeHTML .= '<p><strong>Совет:</strong> ' . $row['description'] . '</p>';
            $recipeHTML .= '<p><strong>Час:</strong> ' . $row['hour'] . '</p>';
            $recipeHTML .= '<p><strong>Минут:</strong> ' . $row['minute'] . '</p>';
            $recipeHTML .= '<img src="' . $row['img'] . '" alt="' . $row['title'] . '" style="max-width: 100%;">'; 
            $recipeHTML .= '</div>';
        }
    } 
    echo $recipeHTML; 
mysqli_close($db_connection);
?>



            <!-- Кнопка применения фильтров -->
            <button type="submit">Применить фильтры</button>
        </div>

        <!-- Здесь будет отображаться результат поиска -->
        <div class="search-results">
            <!-- Результаты будут отображаться здесь --> 
        </div>
        
    </main>
    
</body>
</html>
