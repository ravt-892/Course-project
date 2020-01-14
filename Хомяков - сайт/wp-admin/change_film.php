<!doctype html>
<html lang="ru">
<head>
  <title>Фильмы</title>
  <link rel="stylesheet" href="/template/css/wp-admin.css">
  <meta name='viewport' content='width=device-width, initial-scale=1.0' charset='utf-8'>
</head>
<body>
  <?php
    $host = 'localhost';  // Хост, у нас все локально
    $user = 'f91591jg_learn';    // Имя созданного вами пользователя
    $pass = 'Aneyc6LY'; // Установленный вами пароль пользователю
    $db_name = 'f91591jg_learn';   // Имя базы данных
    $link = mysqli_connect($host, $user, $pass, $db_name); // Соединяемся с базой

    // Ругаемся, если соединение установить не удалось
    if (!$link) {
      echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
      exit;
    }

   //Если переменная film_title передана
    if (isset($_POST["film_title"])) {
        if(!empty($_FILES['img']['tmp_name'])){
	
	if(!empty($_FILES['img']['error'])){
	$_SESSION['msg'] = 'Произошла ошибка загрузки';

	}

	if($_FILES['img']['size']>2*1024*1024){
	$_SESSION['msg'] = 'Файл слишком большой';

	}
	
	switch($_FILES['img']['type']){
	
	case 'image/jpeg':
	case 'image/pjpeg':
	$type = 'jpeg';
	break;
	
	case 'image/png':
	case 'image/x-png':
	$type='png';
	break;
	
	case 'image/gif':
	$type = 'gif';
	break;
	
	default:
	$_SESSION['msg'] = 'Неправильный тип изображения';

	break;
	}
	
	move_uploaded_file($_FILES['img']['tmp_name'],'../template/images/films/'.$_FILES['img']['name']);
	move_uploaded_file($_FILES['video']['tmp_name'],'../template/video/'.$_FILES['video']['name']);



}
      //Если это запрос на обновление, то обновляем
      
      if (isset($_GET['red_id']) && empty($_FILES['img']['name']) && empty($_FILES['video']['name'])) {
          $sql = mysqli_query($link, "UPDATE `films` SET `film_title` = '{$_POST['film_title']}',`film_about` = '{$_POST['film_about']}',`quality` = '{$_POST['quality']}',`viewing_time` = '{$_POST['viewing_time']}',`country` = '{$_POST['country']}',`year` = '{$_POST['year']}',`genre` = '{$_POST['genre']}',`in_roles` = '{$_POST['in_roles']}' WHERE `id`={$_GET['red_id']}");
     ;?><script>document.location.href = "index.php";</script><?
      }
      else
      if (isset($_GET['red_id']) && empty($_FILES['video']['name'])) {
          $sql = mysqli_query($link, "UPDATE `films` SET `film_title` = '{$_POST['film_title']}',`film_about` = '{$_POST['film_about']}',`quality` = '{$_POST['quality']}',`viewing_time` = '{$_POST['viewing_time']}',`country` = '{$_POST['country']}',`year` = '{$_POST['year']}',`genre` = '{$_POST['genre']}',`in_roles` = '{$_POST['in_roles']}',`img` = '{$_FILES['img']['name']}' WHERE `id`={$_GET['red_id']}");
     ;?><script>document.location.href = "index.php";</script><?
      }
      else
      if (isset($_GET['red_id']) && empty($_FILES['img']['name'])) {
          $sql = mysqli_query($link, "UPDATE `films` SET `film_title` = '{$_POST['film_title']}',`film_about` = '{$_POST['film_about']}',`quality` = '{$_POST['quality']}',`viewing_time` = '{$_POST['viewing_time']}',`country` = '{$_POST['country']}',`year` = '{$_POST['year']}',`genre` = '{$_POST['genre']}',`in_roles` = '{$_POST['in_roles']}',`video` = '{$_FILES['video']['name']}' WHERE `id`={$_GET['red_id']}");
     ;?><script>document.location.href = "index.php";</script><?
      }
      else
      if (isset($_GET['red_id'])) {
          $sql = mysqli_query($link, "UPDATE `films` SET `film_title` = '{$_POST['film_title']}',`film_about` = '{$_POST['film_about']}',`quality` = '{$_POST['quality']}',`viewing_time` = '{$_POST['viewing_time']}',`country` = '{$_POST['country']}',`year` = '{$_POST['year']}',`genre` = '{$_POST['genre']}',`in_roles` = '{$_POST['in_roles']}',`img` = '{$_FILES['img']['name']}',`video` = '{$_FILES['video']['name']}' WHERE `id`={$_GET['red_id']}");
     ;?><script>document.location.href = "index.php";</script><?
      }
      

      


      //Если вставка прошла успешно
      if ($sql) {
        echo '<p>Успешно!</p>';
      } else {
        echo '<p>Произошла ошибка: ' . mysqli_error($link) . '</p>';
      }
    }

          
  

    //Если передана переменная red_id, то надо обновлять данные. Для начала достанем их из БД
    if (isset($_GET['red_id'])) {
      $sql = mysqli_query($link, "SELECT `id`, `film_title`, `film_about`,`quality`,`viewing_time`,`country`,`year`,`genre`,`in_roles`, `img` FROM `films` WHERE `id`={$_GET['red_id']}");
      $films = mysqli_fetch_array($sql);
    }
    
    
    
    
    
    
  ?>
  <form enctype="multipart/form-data" method="post" action="" class="form_change">
    <table>
      <p align = center>Фильмы</p>
      <tr>
        <td>Название фильма</td>
        <td><input class="change_input" type="text" name="film_title" value="<?= isset($_GET['red_id']) ? $films['film_title'] : ''; ?>"></td>
      </tr>
      <tr>
        <td>О фильме</td>
        <td><textarea class="change_input2" type="text" name="film_about"><? echo isset($_GET['red_id']) ? $films['film_about'] : ''; ?>"</textarea></td>
      </tr>
      <tr>
        <td>Качество</td>
        <td><input class="change_input" type="text" name="quality" value="<?= isset($_GET['red_id']) ? $films['quality'] : ''; ?>"></td>
      </tr>
      <tr>
        <td>Время просмотра</td>
        <td><input class="change_input" type="text" name="viewing_time" value="<?= isset($_GET['red_id']) ? $films['viewing_time'] : ''; ?>"></td>
      </tr>
      <tr>
        <td>Страна</td>
        <td><input class="change_input" type="text" name="country" value="<?= isset($_GET['red_id']) ? $films['country'] : ''; ?>"></td>
      </tr>
      <tr>
        <td>Год</td>
        <td><input class="change_input" type="int" name="year" value="<?= isset($_GET['red_id']) ? $films['year'] : ''; ?>"></td>
      </tr>
      <tr>
        <td>Жанр</td>
        <td><input class="change_input" type="text" name="genre" value="<?= isset($_GET['red_id']) ? $films['genre'] : ''; ?>"></td>
      </tr>
      <tr>
        <td>В ролях</td>
        <td><textarea class="change_input3" type="text" name="in_roles"> <? echo isset($_GET['red_id']) ? $films['in_roles'] : ''; ?></textarea></td>
      </tr>
     <tr>
        <td>Картинка</td>

             <td><img src="/template/images/films/<?=$films['img']?>"></td>
             </tr>
        <td><input type="file" name="img"></td>
      </tr>
    
    <tr>
        
             </tr>
        <td><input type="file" name="video"></td>
      </tr>
    
    
      <tr>
        <td colspan="2"><input type="submit" value="OK" onclick="return change()"></td>
      </tr>
    </table>
    
    <a href="index.php">Назад</a>
    
    <script>
    function change(){
    if (confirm("Вы действительно хотите изменить запись?")) {
  return true;
} else {
  return false;
}
        document.location.href = "index.php";
    }
        </script>
  </form>
</body>
</html>