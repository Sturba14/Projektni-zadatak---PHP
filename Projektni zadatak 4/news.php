<?php
	
	if (isset($action) && $action != '') {
		$query  = "SELECT * FROM news INNER JOIN pictures ON news.more_pictures = pictures.id";
		$query .= " WHERE news.id=" . $_GET['action'];
		$result = @mysqli_query($MySQL, $query);
		$row = @mysqli_fetch_array($result);
			print '
			<div class="news">
				<img src="images/' . $row['picture1'] . '" alt="' . $row['title'] . '" title="' . $row['title'] . '">
				<img src="images/' . $row['picture2'] . '" alt="' . $row['title'] . '" title="' . $row['title'] . '">
				<img src="images/' . $row['picture3'] . '" alt="' . $row['title'] . '" title="' . $row['title'] . '">
				<h2>' . $row['title'] . '</h2>
				<p>'  . $row['description'] . '</p>
				<time datetime="' . $row['date'] . '">' . pickerDateToMysql($row['date']) . '</time>
				<br>
				<a href = "index.php?menu=2">Nazad</a>
				<hr>
			</div>';
	}
	else {
		print '<h1>Novosti i događaji</h1>';
		$query  = "SELECT * FROM news";
		$query .= " WHERE archive='N'";
		$query .= " ORDER BY date DESC";
		$result = @mysqli_query($MySQL, $query);
		while($row = @mysqli_fetch_array($result)) {
			print '
			<div class="news1">
				<img src="images/' . $row['picture'] . '" alt="' . $row['title'] . '" title="' . $row['title'] . '">
				<h2>' . $row['title'] . '</h2>';
				if(strlen($row['description']) > 200) {
					echo substr(strip_tags($row['description']), 0, 200).'... <a href="index.php?menu=' . $menu . '&amp;action=' . $row['id'] . '">Više..</a>';
				} else {
					echo strip_tags($row['description']);
				}
				print '

				<hr>
			</div>';
		}
	}
?>