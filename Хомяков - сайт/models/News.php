<?php


class News
{

	/** Returns single news items with specified id
	* @rapam integer &id
	*/

	public static function getNewsItemByID($id)
	{
		$id = intval($id);

		if ($id) {
/*			$host = 'localhost';
			$dbname = 'php_base';
			$user = 'root';
			$password = '';
			$db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);*/
			$db = Db::getConnection();
			$result = $db->query('SELECT * FROM films WHERE id=' . $id);

			/*$result->setFetchMode(PDO::FETCH_NUM);*/
			$result->setFetchMode(PDO::FETCH_ASSOC);

			$newsItem = $result->fetch();

			return $newsItem;
		}

	}

	/**
	* Returns an array of news items
	*/
	public static function getNewsList() {
/*		$host = 'localhost';
		$dbname = 'php_base';
		$user = 'root';
		$password = '';
		$db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);*/

		$db = Db::getConnection();
		$newsList = array();

		$result = $db->query('SELECT id, film_title, film_about, quality, viewing_time, country, year, genre, in_roles, img, vote, voters, video FROM films LIMIT 11');

		$i = 0;
		while($row = $result->fetch()) {
			$newsList[$i]['id'] = $row['id'];
			$newsList[$i]['film_title'] = $row['film_title'];
			$newsList[$i]['film_about'] = $row['film_about'];
			$newsList[$i]['quality'] = $row['quality'];
			$newsList[$i]['viewing_time'] = $row['viewing_time'];
			$newsList[$i]['country'] = $row['country'];
			$newsList[$i]['year'] = $row['year'];
			$newsList[$i]['genre'] = $row['genre'];
			$newsList[$i]['in_roles'] = $row['in_roles'];
			$newsList[$i]['img'] = $row['img'];
			$newsList[$i]['vote'] = $row['vote'];
			$newsList[$i]['voters'] = $row['voters'];
			$newsList[$i]['video'] = $row['video'];
			$i++;
		}

		return $newsList;
	
}

}