<?php 
	
	if (isset($_POST['_action_']) && $_POST['_action_'] == 'add_news') {
		$_SESSION['message'] = '';

		$query  = "INSERT INTO news (title, description, archive)";
		$query .= " VALUES ('" . htmlspecialchars($_POST['title'], ENT_QUOTES) . "', '" . htmlspecialchars($_POST['description'], ENT_QUOTES) . "', '" . $_POST['archive'] . "')";
		$result = @mysqli_query($MySQL, $query);
		
		$ID = mysqli_insert_id($MySQL);
		
        if($_FILES['picture']['error'] == UPLOAD_ERR_OK && $_FILES['picture']['name'] != "") {
                

			$ext = strtolower(strrchr($_FILES['picture']['name'], "."));
			
            $_picture = $ID . '-' . rand(1,100) . $ext;
			copy($_FILES['picture']['tmp_name'], "news/".$_picture);
			
			if ($ext == '.jpg' || $ext == '.png' || $ext == '.gif') { 
				$_query  = "UPDATE news SET picture='" . $_picture . "'";
				$_query .= " WHERE id=" . $ID . " LIMIT 1";
				$_result = @mysqli_query($MySQL, $_query);
				$_SESSION['message'] .= '<p>Uspješno ste dodali sliku.</p>';
			}
        }
		
		
		$_SESSION['message'] .= '<p>Uspješno ste dodali novost!</p>';
		

		header("Location: index.php?menu=8&action=2");
	}
	

	if (isset($_POST['_action_']) && $_POST['_action_'] == 'edit_news') {
		$query  = "UPDATE news SET title='" . htmlspecialchars($_POST['title'], ENT_QUOTES) . "', description='" . htmlspecialchars($_POST['description'], ENT_QUOTES) . "', archive='" . $_POST['archive'] . "'";
        $query .= " WHERE id=" . (int)$_POST['edit'];
        $query .= " LIMIT 1";
        $result = @mysqli_query($MySQL, $query);
		

        if($_FILES['picture']['error'] == UPLOAD_ERR_OK && $_FILES['picture']['name'] != "") {
                

			$ext = strtolower(strrchr($_FILES['picture']['name'], "."));
            
			$_picture = (int)$_POST['edit'] . '-' . rand(1,100) . $ext;
			copy($_FILES['picture']['tmp_name'], "news/".$_picture);
			
			
			if ($ext == '.jpg' || $ext == '.png' || $ext == '.gif') { 
				$_query  = "UPDATE news SET picture='" . $_picture . "'";
				$_query .= " WHERE id=" . (int)$_POST['edit'] . " LIMIT 1";
				$_result = @mysqli_query($MySQL, $_query);
				$_SESSION['message'] .= '<p>Uspješno ste dodali sliku.</p>';
			}
        }
		
		$_SESSION['message'] = '<p>Uspješno ste izmjenili novost!</p>';
		

		header("Location: index.php?menu=8&action=2");
	}
	
	if (isset($_GET['delete']) && $_GET['delete'] != '') {
		
        $query  = "SELECT picture FROM news";
        $query .= " WHERE id=".(int)$_GET['delete']." LIMIT 1";
        $result = @mysqli_query($MySQL, $query);
        $row = @mysqli_fetch_array($result);
        @unlink("news/".$row['picture']); 

		$query  = "DELETE FROM news";
		$query .= " WHERE id=".(int)$_GET['delete'];
		$query .= " LIMIT 1";
		$result = @mysqli_query($MySQL, $query);

		$_SESSION['message'] = '<p>Uspješno ste obrisali novost!</p>';
		
		header("Location: index.php?menu=8&action=2");
	}
	
	

	if (isset($_GET['id']) && $_GET['id'] != '') {
		$query  = "SELECT * FROM news";
		$query .= " WHERE id=".$_GET['id'];
		$query .= " ORDER BY date DESC";
		$result = @mysqli_query($MySQL, $query);
		$row = @mysqli_fetch_array($result);
		print '
		<h2>News overview</h2>
		<div class="news">
			<img src="news/' . $row['picture'] . '" alt="' . $row['title'] . '" title="' . $row['title'] . '">
			<h2>' . $row['title'] . '</h2>
			' . $row['description'] . '
			<time datetime="' . $row['date'] . '">' . pickerDateToMysql($row['date']) . '</time>
			<hr>
		</div>
		<p><a href="index.php?menu='.$menu.'&amp;action='.$action.'">Back</a></p>';
	}
	
	else if (isset($_GET['add']) && $_GET['add'] != '') {
		
		print '
		<h2>Dodaj novost</h2>
		<form action="" id="news_form" name="news_form" method="POST" enctype="multipart/form-data">
			<input type="hidden" id="_action_" name="_action_" value="add_news">
			
			<label for="title">Naslov *</label>
			<input type="text" id="title" name="title" placeholder="Naslov.." required>
			<label for="description">Tekst *</label>
			<textarea id="description" name="description" placeholder="Tekst.." required></textarea>
				
			<label for="picture">Slika</label>
			<input type="file" id="picture" name="picture">';
			if ($_SESSION['user']['role'] == "1" || $_SESSION['user']['role'] == "2") {
            print '
						
			<label for="archive">Arhiviraj:</label><br />
            <input type="radio" name="archive" value="Y"> DA &nbsp;&nbsp;
			<input type="radio" name="archive" value="N" checked> NE';
			}
			print '
			
			
			<hr>
			
			<input type="submit" value="Spremi">
		</form>
		<p><a href="index.php?menu='.$menu.'&amp;action='.$action.'">Nazad</a></p>';
	}

	else if (isset($_GET['edit']) && $_GET['edit'] != '') {
		$query  = "SELECT * FROM news";
		$query .= " WHERE id=".$_GET['edit'];
		$result = @mysqli_query($MySQL, $query);
		$row = @mysqli_fetch_array($result);
		$checked_archive = false;

		print '
		<h2>Uredi novosti</h2>
		<form action="" id="news_form_edit" name="news_form_edit" method="POST" enctype="multipart/form-data">
			<input type="hidden" id="_action_" name="_action_" value="edit_news">
			<input type="hidden" id="edit" name="edit" value="' . $row['id'] . '">
			
			<label for="title">Naslov *</label>
			<input type="text" id="title" name="title" value="' . $row['title'] . '" placeholder="naslov.." required>
			<label for="description">Tekst *</label>
			<textarea id="description" name="description" placeholder="tekst.." required>' . $row['description'] . '</textarea>
				
			<label for="picture">Slika</label>
			<input type="file" id="picture" name="picture">
						
			<label for="archive">Arhiviraj:</label><br />
            <input type="radio" name="archive" value="Y"'; if($row['archive'] == 'Y') { echo ' checked="checked"'; $checked_archive = true; } echo ' /> DA &nbsp;&nbsp;
			<input type="radio" name="archive" value="N"'; if($checked_archive == false) { echo ' checked="checked"'; } echo ' /> NE
			
			<hr>
			
			<input type="submit" value="Spremi">
		</form>
		<p><a href="index.php?menu='.$menu.'&amp;action='.$action.'">Nazad</a></p>';
	}
	else {
		print '
		<h2>Novosti</h2>
		<div id="news">
			<table>
				<thead>
					<tr>
						<th width="16"></th>
						<th width="16"></th>
						<th width="16"></th>
						<th>Naslov</th>
						<th>Tekst</th>
						<th>Datum</th>
						<th width="16"></th>
					</tr>
				</thead>
				<tbody>';
				$query  = "SELECT * FROM news";
				$query .= " ORDER BY date DESC";
				$result = @mysqli_query($MySQL, $query);
				while($row = @mysqli_fetch_array($result)) {
					print '
					<tr>
						<td><a href="index.php?menu='.$menu.'&amp;action='.$action.'&amp;id=' .$row['id']. '"><img src="images/user.png" alt="user"></a></td>
						<td>';
						if ($_SESSION['user']['role'] == 1 || $_SESSION['user']['role'] == 2) {
						print '<a href="index.php?menu='.$menu.'&amp;action='.$action.'&amp;edit=' .$row['id']. '"><img src="images/edit.png" alt="uredi"></a></td>';
						}
						print '
						<td>';
						if ($_SESSION['user']['role'] == 1) {
						print '<a href="index.php?menu='.$menu.'&amp;action='.$action.'&amp;delete=' .$row['id']. '"><img src="images/delete.png" alt="obriši"></a></td>';
						}
						print '
						<td>' . $row['title'] . '</td>
						<td>';
						if(strlen($row['description']) > 80) {
                            echo substr(strip_tags($row['description']), 0, 80).'...';
                        } else {
                            echo strip_tags($row['description']);
                        }
						print '
						</td>
						<td>' . pickerDateToMysql($row['date']) . '</td>
						<td>';
							if ($row['archive'] == 'Y') { print '<img src="images/inactive.png" alt="" title="" />'; }
                            else if ($row['archive'] == 'N') { print '<img src="images/active.png" alt="" title="" />'; }
						print '
						</td>
					</tr>';
				}
			print '
				</tbody>
			</table>
			<br>
			<a href="index.php?menu=' . $menu . '&amp;action=' . $action . '&amp;add=true" class="AddLink">Dodaj novost</a>
			<br>
			<br>
		</div>';
	}
	
	@mysqli_close($MySQL);
?>