<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Удаление записей из БД</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Удаление записей из базы данных</h1>
        
        <form action="delete.php" method="post">
            <div class="form-group">
                <label for="record_id">ID записи для удаления:</label>
                <input type="number" id="record_id" name="record_id" required>
            </div>
            
            <div class="form-group">
                <label for="table_name">Имя таблицы:</label>
                <input type="text" id="table_name" name="table_name" required>
            </div>
            
            <button type="submit" class="delete-btn">Удалить запись</button>
        </form>
        
        <?php
        // Подключение к базе данных и вывод списка записей
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "shops";
        
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            if(isset($_GET['table'])) {
                $table = $_GET['table'];
                echo "<h2>Содержимое таблицы: $table</h2>";
                
                $stmt = $conn->query("SELECT * FROM $table LIMIT 50");
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                if(count($results) > 0) {
                    echo "<table>";
                    echo "<tr>";
                    foreach(array_keys($results[0]) as $column) {
                        echo "<th>$column</th>";
                    }
                    echo "</tr>";
                    
                    foreach($results as $row) {
                        echo "<tr>";
                        foreach($row as $value) {
                            echo "<td>$value</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p>Таблица пуста</p>";
                }
            }
        } catch(PDOException $e) {
            echo "<p class='error'>Ошибка подключения: " . $e->getMessage() . "</p>";
        }
        ?>
    </div>
</body>
</html>