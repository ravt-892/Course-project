<?php 
	require 'db.php';
?>

<?php if ( isset ($_SESSION['logged_admin']) ) : ?>
  
	<!doctype html>
<html lang="ru">
<head>
    
  <title>Фильмы</title>
  <meta name='viewport' content='width=device-width, initial-scale=1.0' charset='utf-8'>
  <link rel="stylesheet" href="/template/css/wp-admin.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

</head>
<body>
  <?php
    $host = 'localhost';
    $user = 'f91591jg_learn';
    $pass = 'Aneyc6LY';
    $db_name = 'f91591jg_learn'; 
    $link = mysqli_connect($host, $user, $pass, $db_name);


    if (!$link) {
      echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
      exit;
    }


    if (isset($_GET['del_id'])) { 
  
      $sql = mysqli_query($link, "DELETE FROM `films` WHERE `id` = {$_GET['del_id']}");
      if ($sql) {
        ?><script>    document.location.href = "index.php";</script><?
      } else {
        echo '<p>Произошла ошибка: ' . mysqli_error($link) . '</p>';
      }
    }
?>
  

  <table border='1' class="films_view_table">
    <tr>
      <td align = center>Название Фильма</td>
      <td align = center colspan="2">Редактирование</td>
    </tr>
    
    <?php
      $sql = mysqli_query($link, 'SELECT `id`, `film_title` FROM `films`');
      while ($result = mysqli_fetch_array($sql)) {
        echo '<tr>' .
             "<td>{$result['film_title']}</td>" .
             "<td><a onclick='return del()' href='?del_id={$result['id']}'>Удалить</a></td>" .
             "<td><a href='change_film.php?red_id={$result['id']}'>Изменить</a></td>" .
             '</tr>';
      }
    ?>
  </table>
  
    <br><br><br><a href="add_film.php" class="btn_add">Добавить фильм</a><br>
    
    
    
<script type="text/javascript">

function del(){
    if (confirm("Вы действительно хотите удалить запись?")) {
  return true;
} else {
  return false;
}
}


</script>

 <?php 
    if ($_SESSION['logged_admin']->id == '1')
echo '<br><br><a href="signup.php" class="btn_signup">Зарегистрировать администратора</a> <br><br>';
?>

<script>
    
    idleTimer = null;
idleState = false; // состояние отсутствия
idleWait = 999000999; // время ожидания в мс. (1/1000 секунды)
 
jQuery(document).ready( function($){
  $(document).bind('mousemove keydown scroll', function(){
    clearTimeout(idleTimer); // отменяем прежний временной отрезок
    if(idleState == true){ 
      // Действия на возвращение пользователя
       $("body").append("<p>С возвращением!</p>");
    }
 
    idleState = false;
    idleTimer = setTimeout(function(){ 
      // Действия на отсутствие пользователя
    document.location = "logout.php"
    idleState = true; 
    }, idleWait);
  });
 
  $("body").trigger("mousemove"); // сгенерируем ложное событие, для запуска скрипта
});
    
</script>
</body>

</html>

	<br><a href="logout.php" class="btn_logout">Выйти</a>

<?php else : 
	$data = $_POST;
	if ( isset($data['do_login']) )
	{
		$user = R::findOne('admin', 'login = ?', array($data['login']));
		if ( $user )
		{
			//логин существует
			if ( password_verify($data['password'], $user->password) )
			{
				//если пароль совпадает, то нужно авторизовать пользователя
				$_SESSION['logged_admin'] = $user;
				?><script>document.location = "/wp-admin/"</script><?
			}else
			{
				$errors[] = 'Неверно введен пароль!';
			}

		}else
		{
			$errors[] = 'Пользователь с таким логином не найден!';
		}
		
		if ( ! empty($errors) )
		{
			//выводим ошибки авторизации
			echo '<div id="errors" style="color:red;">' .array_shift($errors). '</div><hr>';
		}

	}
?>

<link rel="stylesheet" href="/template/css/wp-admin.css">

<form action="/wp-admin/" method="POST" class="form_login">
	<strong>Логин</strong>
	<input type="text" name="login" value="<?php echo @$data['login']; ?>">

	<strong>Пароль</strong>
	<input type="password" name="password" value="<?php echo @$data['password']; ?>">

	<button type="submit" name="do_login" class="btn_login">Войти</button>
</form>

<?php endif; ?>



