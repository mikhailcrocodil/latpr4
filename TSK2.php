<?php

if( isset( $_GET[ 'Submit' ] ) ) {
        // Get input
        $id = $_GET[ 'id' ];

		//CWE-89. Код напрямую вставляет переменную $id в SQL-запрос без должной санитизации или параметризации,
		//что может привести к атакам SQL-инъекции
		
        $getid  = "SELECT first_name, last_name FROM users WHERE user_id = '$id';";
        $result = mysqli_query($GLOBALS["___mysqli_ston"],  $getid ); // Removed 'or die' to suppress mysql errors

        // Get results
        $num = @mysqli_num_rows( $result ); // The '@' character suppresses errors
        if( $num > 0 ) {
                // Feedback for end user
                $html .= '<pre>User ID exists in the database.</pre>';
        }
        else {ЫЫЫЫ
				//CWE-113 Описание проблемы: Код конкатенирует переменную $_SERVER['SERVER_PROTOCOL'] напрямую в HTTP-заголовок
				//без должной санитизации или валидации, что может привести к атакам разделения HTTP-ответа (HTTP response splitting)
                // User wasn't found, so the page wasn't!
                header( $_SERVER[ 'SERVER_PROTOCOL' ] . ' 404 Not Found' );

                // Feedback for end user
                $html .= '<pre>User ID is MISSING from the database.</pre>';
        }
		
		//CWE-200: Отсутствует обработка возможных ошибок при закрытии соединения с базой данных
        ((is_null($___mysqli_res = mysqli_close($GLOBALS["___mysqli_ston"]))) ? false : $___mysqli_res);
}

?>
