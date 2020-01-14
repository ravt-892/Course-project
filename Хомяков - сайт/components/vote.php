<?php 
/* Конфигурация базы данных. Добавьте свои данные */
$dbOptions = array(
    'db_host' => 'localhost',
    'db_user' => 'f91591jg_learn',
    'db_pass' => 'Aneyc6LY',
    'db_name' => 'f91591jg_learn',
);

//Имя таблицы, в которой хранятся заметки
$table_name = 'films';


//Подключаем класс для работы с базой данных
require "db.class.php";

// Соединение с базой данных
ad::init($dbOptions);

$use_cookie = true; //защита от накруток
$expires = 3600 * 24 * 31; //время жизни кук в секундах (сейчас установлено 31 день)


$page_id = (!empty($_GET['id']))? intval($_GET['id']): false;



if(isset($_POST['score']) && isset($_POST['vote-id'])){
	
	$page_id = intval($_POST['vote-id']);
	
	$cookie_name = 'page_'.$page_id;
	
	//Проверяем куки
	if($use_cookie && isset($_COOKIE[$cookie_name])){
		
		$data['status'] = 'ERR';
		$data['msg'] = 'Вы уже голосовали за эту заметку';
	}
	else{
		
		//Обновляем рейтинг и количество проголосовавших
		ad::query('UPDATE '.$table_name.' SET vote = (vote*voters + '.floatval($_POST['score']).')/(voters + 1), voters = voters + 1 WHERE id = '.$page_id);
		if(ad::affected_rows() == 1){
			
			$data['status'] = 'OK';
			$data['msg'] = 'Спасибо. Ваш голос учтен.';
			
			//Устанавливаем куки
			if($use_cookie) setcookie($cookie_name,$page_id,time() + $expires);

		}
		else{
			
			$data['status'] = 'ERR';
			$data['msg'] = 'Произошла ошибка';
		}
	}
}
else{
	
	$data['status'] = 'ERR';
	$data['msg'] = 'Вы не передали нужные данные!';
}

echo json_encode($data);