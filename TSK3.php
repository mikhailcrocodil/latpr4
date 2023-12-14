<?php

if (isset($_GET['Submit'])) {
    // Получение ввода
    $id = $_GET['id'];

    // Проверка базы данных
    $getid = "SELECT first_name, last_name FROM users WHERE user_id = ?";
    $stmt = mysqli_prepare($GLOBALS["___mysqli_ston"], $getid);
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Получение результатов
    $num = mysqli_num_rows($result);
    if ($num > 0) {
        // Обратная связь для конечного пользователя
        echo '<pre>User ID существует в базе данных.</pre>';
    } else {
        // Пользователь не найден, поэтому и страница тоже!
        header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');

        // Обратная связь для конечного пользователя
        echo '<pre>User ID ОТСУТСТВУЕТ в базе данных.</pre>';
    }

    ((is_null($___mysqli_res = mysqli_close($GLOBALS["___mysqli_ston"]))) ? false : $___mysqli_res);
}

?>