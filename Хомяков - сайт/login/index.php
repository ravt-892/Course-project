<?php 
	require '../components/db.php';
	include ('../template/header/header.php'); 

?>


<?php	$data = $_POST;
	if ( isset($data['do_login']) )
	{
		$user = R::findOne('users', 'login = ?', array($data['login']));
		if ( $user )
		{
			//логин существует
			if ( password_verify($data['password'], $user->password) )
			{
				//если пароль совпадает, то нужно авторизовать пользователя
				$_SESSION['logged_user'] = $user;
				?><script>document.location = ".."</script><?
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
<div class="bg_form">
<div class="login_main">Авторизация пользователя</div>
<form action="" method="POST" class="form">
	<strong>Логин</strong>
	<input type="text" name="login" placeholder="Логин" value="<?php echo @$data['login']; ?>">

	<strong>Пароль</strong>
	<input type="password" name="password" placeholder="Пароль" value="<?php echo @$data['password']; ?>">

	<button type="submit" name="do_login" class="btn_login">Войти</button>
</form>
</div>