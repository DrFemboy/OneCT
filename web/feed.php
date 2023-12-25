<?php
	require_once "../include/config.php";
?>

<!DOCTYPE html
<html lang='ru'>
<head>
	<?php include '../include/html/head.php'; ?>
    <title>Стена</title>
</head>
<body>
	<div class="header">
		<?php if(isset($_SESSION['user'])): ?>
			<a href="allusers.php">Все пользователи</a>
			<a href="index.php">Домой</a>
		<?php else : ?>
			<a href="allusers.php">Все пользователи</a>
			<a href="login.php">Войти</a>
			<a href="reg.php">Регистрироваться</a>
		<?php endif; ?>
	</div>
	<div class="main_app">
		<?php
			$stena = mysqli_query($db, "SELECT * FROM post ORDER BY date DESC");	 		
					
			while($list = mysqli_fetch_assoc($stena)){
				echo('<div class="post">');

				$user = mysqli_fetch_assoc(mysqli_query($db, "SELECT name, id FROM users WHERE id = '" .$list['id_user']. "'"));
					
					echo('<b>');
						echo('<a class="user" href="user.php?id=' .$user['id']. '">');
							echo(strip_tags($user['name']));
						echo('</a>');
					echo('</b><br>');
					echo('<span class="date">');
						echo($list['date']);
					echo('</span><br>');	

				$user = mysqli_fetch_assoc(mysqli_query($db, "SELECT name, id FROM users WHERE id = '" .$list['id_who']. "'"));

					echo('<b>От имени: ');
						echo('<a class="user" href="user.php?id=' .$user['id']. '">');
							echo(strip_tags($user['name']));
						echo('</a>');
					echo('</b>');
					
						if(!empty(trim($list['img']))){
							echo('<img width="100%" src="' .$list['img']. '">');
						} else {
							echo('');
						}

						echo('<p>' .strip_tags($list['post']). '</p>');
				echo('</div>');
			};
		?>
	</div>
</body>
</html>