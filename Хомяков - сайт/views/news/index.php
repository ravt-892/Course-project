<?php 

require 'components/db.php';

if ( isset ($_SESSION['logged_user']) ) : 
require "template/header/header_logged.php"; ?>

    <div class="header_content">Рекомендуем вам посмотреть</div>
	<div class="container">
	    <?php foreach ($newsList as $newsItem):?>
        <div class="box">
            <a href='/films/<?php echo $newsItem['id'] ;?>'>
            <span class="img-box"><img src="/template/images/films/<?php echo $newsItem['img'];?>" alt=""></span>
            <h2><?php echo $newsItem['film_title'];?></h2>
            </a>
        </div>
        <?php endforeach;?>
    </div>
        
    </body>
    
</html>


<?php else : 
require "template/header/header.php"; ?>
    <div class="header_content">Рекомендуем вам посмотреть</div>
	<div class="container">
	    <?php foreach ($newsList as $newsItem):?>
        <div class="box">
            <a href='/films/<?php echo $newsItem['id'] ;?>'>
            <span class="img-box"><img src="/template/images/films/<?php echo $newsItem['img'];?>" alt=""></span>
            <h2><?php echo $newsItem['film_title'];?></h2>
            </a>
        </div>
        <?php endforeach;?>
    </div>
    </body>
    
</html>

<?php endif; ?>