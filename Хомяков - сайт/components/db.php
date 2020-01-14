<?php 
require 'libs/rb.php';
R::setup( 'mysql:host=localhost;
        dbname=f91591jg_learn','f91591jg_learn','Aneyc6LY' ); 

if ( !R::testconnection() )
{
		exit ('Нет соединения с базой данных');
}

session_start();