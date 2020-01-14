<?php 
$table_name = 'films';

$dbOptions = array(
    'db_host' => 'localhost',
    'db_user' => 'f91591jg_learn',
    'db_pass' => 'Aneyc6LY',
    'db_name' => 'f91591jg_learn'
);

//Подключаем класс для работы с базой данных
require "components/db.class.php";
require 'components/db.php';

// Соединение с базой данных
ad::init($dbOptions);

?>
<?php if ( isset ($_SESSION['logged_user']) ) : 
require "template/header/header_logged.php"; ?>




<html>
    <head>
        <meta charset="UTF-8">
        
        
        <link href="/template/css/jquery.rating.css" rel="stylesheet" type="text/css" /> 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>

<script type="text/javascript">
window.jQuery || document.write('<script type="text/javascript" src="/template/js/jquery-1.6.2.min.js"><\/script>');
</script>

<script type="text/javascript" src="/template/js/jquery.rating-2.0.min.js"></script>

<script type="text/javascript">
$(function(){
	
	$('#rating').rating({
		fx: 'float',
        image: '/template/images/stars.png',
        loader: '/template/images/ajax-loader.gif',
        minimal: 0.5,
		url:'/components/vote.php'
	});
})
</script>
        
        




    <img src="/template/images/films/<?php echo $newsItem['img'];?>" alt="" class="img_content">
    

		    	

<table>
    <tr>
        <td>Просмотр:</td>
        <td><?php echo $newsItem['viewing_time'];?></td>
    </tr>
    <tr>
        <td>Качество:</td>
        <td><?php echo $newsItem['quality'];?></td>
    </tr>
    <tr>
        <td>Страна:</td>
        <td><?php echo $newsItem['country'];?></td>
    </tr>
    <tr>
        <td>Год:</td>
        <td><?php echo $newsItem['year'];?></td>
    </tr>
    <tr>
        <td>Жанр:</td>
        <td><?php echo $newsItem['genre'];?></td>
    </tr>
    <tr>
        <td>В ролях:</td>
        <td><?php echo $newsItem['in_roles'];?></td>
    </tr>
</table>
<div class="border-wrap">
				<div id="rating">
	                <input type="hidden" name="val" value="<?=$newsItem['vote'];?>"/>
	                <input type="hidden" name="votes" value="<?=$newsItem['voters'];?>"/>
	                <input type="hidden" name="vote-id" value="<?=$newsItem['id'];?>"/>
	            </div>
		    	</div>
<div class="about_film"><?php echo $newsItem['film_about'];?></div>

	


<video controls="controls" controlsList="nodownload" class="video">
   <source src="/template/video/<?php echo $newsItem['video'];?>" type='video/ogg; codecs="theora, vorbis"'>

  </video>
	<br><a href="../components/logout.php" class="logout">Выйти</a>
    </body>
</html>



<?php else : 

require "template/header/header.php"; ?>


<html>
    <head>
        <meta charset="UTF-8">
        
        
        <link href="/template/css/jquery.rating.css" rel="stylesheet" type="text/css" /> 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>



<script type="text/javascript" src="/template/js/jquery.rating-2.0.min.js"></script>

<script type="text/javascript">
$(function(){
	
	$('#rating').rating({
		fx: 'float',
        image: '/template/images/stars.png',
        minimal: 0.5,
	});
})
</script>
        
        




    <img src="/template/images/films/<?php echo $newsItem['img'];?>" alt="" class="img_content">
    

		    	

<table>
    <tr>
        <td>Просмотр:</td>
        <td><?php echo $newsItem['viewing_time'];?></td>
    </tr>
    <tr>
        <td>Качество:</td>
        <td><?php echo $newsItem['quality'];?></td>
    </tr>
    <tr>
        <td>Страна:</td>
        <td><?php echo $newsItem['country'];?></td>
    </tr>
    <tr>
        <td>Год:</td>
        <td><?php echo $newsItem['year'];?></td>
    </tr>
    <tr>
        <td>Жанр:</td>
        <td><?php echo $newsItem['genre'];?></td>
    </tr>
    <tr>
        <td>В ролях:</td>
        <td><?php echo $newsItem['in_roles'];?></td>
    </tr>
</table>
<a href="../login">
    <div class="border-wrap">
				<div id="rating">
	                <input type="hidden" name="val" value="<?=$newsItem['vote'];?>"/>
	                <input type="hidden" name="votes" value="<?=$newsItem['voters'];?>"/>
	                <input type="hidden" name="vote-id" value="<?=$newsItem['id'];?>"/>
	            </div>
		    	</div>
<div class="about_film"><?php echo $newsItem['film_about'];?></div>
</a>


	


<video controls="controls" controlsList="nodownload" class="video">
   <source src="/template/video/<?php echo $newsItem['video'];?>" type='video/ogg; codecs="theora, vorbis"'>

  </video>

    </body>
    
</html>




<?php endif; ?>