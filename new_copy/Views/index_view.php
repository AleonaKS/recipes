<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="styles.css">    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        h1 {
            text-align: left; /* Выравнивание текста по левому краю */
            font-size: 30px !important; /* Размер шрифта */
            margin-left: 20px; /* Отступ слева */
            margin-top: 20px; /* Отступ сверху */ 
        }
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
        a {
            color: white; /* изменение цвета текста на белый */
            text-decoration: none; /* удаление подчеркивания */
        }
      .top-nav {
            background-color: #333;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
        }

        .nav-icons {
            display: flex;
            align-items: center;
        }
        .nav-icons i {
            margin-right: 10px; /* Оставляем отступ между иконками */
        }

        .search-bar {
            margin: 10px;
            margin-left: 10px;
            margin-left: 20px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 500px;  
        }

        .icon-group {
            display: flex;
            align-items: center;
        }

        .icon-group i {
            margin-left: 10px;  
        }

        .navigation-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #333;
            display: flex;
            justify-content: space-around;
            padding: 20px 0;
            color: white;
        }
        .nav-button {
        display: inline-block; /* Размещаем элементы в строку */
        margin-right: 10px; /* Добавляем отступ между элементами */
        }
        /* .nav-button {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: white;
        } */
        .search-container {
        display: flex; /* Размещаем элементы в строку */
        justify-content: flex-start; /* Выравниваем элементы по левому краю */
        align-items: center; /* Выравниваем элементы по вертикали */
        margin-left: 0; /* Устанавливаем отступ слева на 0 */
        }
        .header-container {
        display: flex; /* Размещаем элементы в строку */
        align-items: center; /* Выравниваем элементы по вертикали */
        
        }
        /* Стили для контейнера */
        .recipe-container {
            display: flex; /* Отображаем элементы в ряд */
            overflow-x: auto; /* Включаем горизонтальную прокрутку */
            white-space: nowrap; /* Запрещаем перенос строк */
            overflow: hidden; /* Скрыть часть контента, который выходит за границы контейнера */
       
            margin-left: 10px; /* 为容器添加左边距 */
        }
        /* Стили для контейнера рецептов */
        .recipe-row {
            overflow-x: auto; /* Включение горизонтальной прокрутки */
            white-space: nowrap; /* Предотвращение переноса строк */
            margin-top: 20px;
        }
        /* Стили для отдельного рецепта */
        .recipe {
            display: inline-block;
            width: 200px; /* Ширина рецепта */
            text-align: center;
            margin-right: 20px;
            height: auto; /* Автоматическая высота рецепта */
            margin-bottom: 20px; /* Отступ снизу для разделения рецептов */
            margin-left: 10px; 
        }

        .recipe img {
            width: 100%;
            border-radius: 10px;
        }

        /* Стили для выпадающего списка */
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .nav-icon:hover .dropdown-content {
            display: block;
        }
    </style>
</head>
<body>  
    <div class="top-nav">
    <div class="nav-icon">
    <i class="fas fa-bars"></i> Меню
    <div class="dropdown-content">
    <a href="#">Меню на неделю</a>
    <a href="#">Калькулятор калорий</a>
    <a href="#">Подбор рецепта</a>
    <a href="#">Кухни мира</a> 
    <a href="#">Посуда и инструменты</a>
    <a href="#">Таблицы мер и весов</a> 
    </div>
</div>
        
<div class="header-container">
    <div class="search-container">
        <input type="text" class="search-bar" id="searchInput" placeholder="Поиск...">
        <a href="http://localhost/tests/Models/search.php" class="search-icon" id="searchIcon"><i class="fas fa-search"></i></a>
    </div>
    <div id="searchResults" class="search-results"></div>    
    <div class="nav-icons">
        <!-- <i class="fas fa-book" style="padding: 0 5px;"></i> -->
        <a href="http://localhost/tests/Views/add_recipe.php"><i class="fas fa-plus-circle" style="padding: 0 15px;"></i></a>
        <a href="#" class="nav-button"><i class="fas fa-shopping-basket"></i></a>
        <a href="#" class="nav-button"><i class="fas fa-heart"></i></a>
    </div>
</div>

<script>
    const searchInput = document.getElementById('searchInput');
    const searchIcon = document.getElementById('searchIcon');
    const searchResults = document.getElementById('searchResults');

    // Обработчик события при нажатии на иконку лупы
    searchIcon.addEventListener('click', function() {
        const searchTerm = searchInput.value;
        // Перенаправление на страницу поиска с передачей введенного запроса
        window.location.href = `http://localhost/tests/Models/search.php?query=${searchTerm}`;
    });

    // Обработчик события при вводе в строку поиска
    searchInput.addEventListener('input', function() {
        const searchTerm = searchInput.value; 
    });
</script>
</div>

<h1 style="margin-left: 20px;">Новые рецепты</h1>
<?php echo $lastRecipesHTML; ?>  
</div>
</div>
<h1 style="margin-left: 20px;">Что хотите приготовить?</h1>
<?php echo $categories; ?>  
</div>

</body>
</html>

