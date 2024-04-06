<?php

// Параметры подключения к базе данных
$host = "127.0.0.1"; // замените на имя вашего хоста
$username = "root"; // замените на ваше имя пользователя базы данных
$password = ""; // замените на ваш пароль
$database = "rusStudy"; // замените на имя вашей базы данных

// Подключение к базе данных
$conn = new mysqli($host, $username, $password, $database);

// Проверка соединения
if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}

// Пример запроса к базе данных (вы можете изменить его согласно вашим потребностям)
$sql = "SELECT * FROM partners";
$result = $conn->query($sql);

// Обработка результатов запроса
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Обработка данных
        echo "ID: " . $row["id"] . " - Имя: " . $row["name"] . " - Email: " . $row["last_name"] . "<br>";
    }
} else {
    echo "Нет данных в базе данных.";
}

// Закрытие соединения с базой данных
$conn->close();
?>