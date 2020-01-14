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
      
          //Иначе вставляем данные, подставляя их в запрос
          session_start();
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
	move_uploaded_file($_FILES['video']['tmp_name'],'../template/video/'.$_FILES['video']['name']); {
	$_SESSION['msg'] = 'Не удалось загрузить файл';

	}
	$_SESSION['msg'] = 'Файл успешно загружен';






}else{
$_SESSION['msg'] = 'Вы не загрузили файл';

}
          
          $sql = mysqli_query($link, "INSERT INTO `films` (`film_title`, `film_about`, `quality`, `viewing_time`, `country`, `year`, `genre`, `in_roles`, `img`, `video`) 
          VALUES ('{$_POST['film_title']}','{$_POST['film_about']}','{$_POST['quality']}','{$_POST['viewing_time']}','{$_POST['country']}','{$_POST['year']}','{$_POST['genre']}','{$_POST['in_roles']}','{$_FILES['img']['name']}','{$_FILES['video']['name']}')");
     ;?><script>document.location.href = "index.php";</script><?
     
      }
 
  ?><form name="upload" enctype="multipart/form-data" method="post" action="">
    <table>
      <p align = center>Фильмы</p>
      <tr>
        <td>Название фильма</td>
        <td><input type="text" name="film_title" value="<?= isset($_GET['red_id']) ? $films['film_title'] : ''; ?>"></td>
      </tr>
      <tr>
        <td>О фильме</td>
        <td><input type="text" name="film_about" value="<?= isset($_GET['red_id']) ? $films['film_about'] : ''; ?>"></td>
      </tr>
      <tr>
        <td>Качество</td>
        <td><input type="text" name="quality" value="<?= isset($_GET['red_id']) ? $films['quality'] : ''; ?>"></td>
      </tr>
      <tr>
        <td>Время просмотра</td>
        <td><input type="text" name="viewing_time" value="<?= isset($_GET['red_id']) ? $films['viewing_time'] : ''; ?>"></td>
      </tr>
      <tr>
        <td>Страна</td>
        <td><input type="text" name="country" value="<?= isset($_GET['red_id']) ? $films['country'] : ''; ?>"></td>
      </tr>
      <tr>
        <td>Год</td>
        <td><input type="int" name="year" value="<?= isset($_GET['red_id']) ? $films['year'] : ''; ?>"></td>
      </tr>
      <tr>
        <td>Жанр</td>
        <td><input type="text" name="genre" value="<?= isset($_GET['red_id']) ? $films['genre'] : ''; ?>"></td>
      </tr>
      <tr>
        <td>В ролях</td>
        <td><input type="text" name="in_roles" value="<?= isset($_GET['red_id']) ? $films['in_roles'] : ''; ?>"></td>
      </tr>
      
     <tr>
        <td>Картинка</td>
        <td><input type="file" name="img"></td>
      </tr>
      
      <tr>
        <td>Видео</td>
        <td><input type="file" name="video"></td>
      </tr>
    
    
      <tr>
        <td colspan="2"><input type="submit" value="OK"></form></td>
      </tr>
    
    </table>
  <div id="log">Прогресс загрузки</div>
  <a href="index.php">Назад</a>
  <script>
    function log(html) {
      document.getElementById('log').innerHTML = html;
    }

    document.forms.upload.onsubmit = function() {
      var file = this.elements.video.files[0];
      if (file) {
        upload(file);
      }
      return true;
    }


    function upload(file) {

      var xhr = new XMLHttpRequest();

      // обработчики можно объединить в один,
      // если status == 200, то это успех, иначе ошибка
      xhr.onload = xhr.onerror = function() {
        if (this.status == 200) {
          log("success");
        } else {
          log("error " + this.status);
        }
      };

      // обработчик для отправки
      xhr.upload.onprogress = function(event) {
        log(event.loaded + ' / ' + event.total);
      }

      xhr.open("POST", "upload", true);
      xhr.send(file);

    }
  </script>
</body>
</html>