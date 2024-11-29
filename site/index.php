<?php
	echo "Hello world!<br>";

	// Кол-во элементов
	$limit = 12;

	$start_time = microtime(true);
	$db = require 'connect.php';
	$end_time = microtime(true);

	echo $end_time - $start_time, " sec";

	$table_name = 'projects';

	$request = "SELECT * FROM {$table_name} LIMIT {$limit}";

	echo $request;

	// Получение записей для первой страницы
	$stmt = $db->prepare($request);
		//$stmt->bindValue('table_name', 'projects');
	$stmt->execute();	
	$items = $stmt->fetchAll(PDO::FETCH_ASSOC);	
	
	// Кол-во страниц 
	$stmt = $db->prepare("SELECT COUNT(id) FROM {$table_name}");
		//$stmt->bindValue(':id', 'id');
		//$stmt->bindValue(':table_name', 'projects');
	$stmt->execute();
	$total = $stmt->fetch(PDO::FETCH_COLUMN);

	echo $total;
	
	$amt = ceil($total / $limit);
?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> <!--Обязательно указываем размеры, иначе не будет смены @media -->
		<title>Документ без названия</title>
		<link rel="stylesheet" type="text/css" href="style.css" >
		<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"> </script>
		<script type="text/javascript" src="script.js"></script><!--defer-->
	</head>
	
	<body>
		<div class="projects-cards-items-content">
			<?php foreach ($items as $row): ?>
				<div class="project-card-item" id="1">
					<div class="project-card-item-header" id="11">
						<p><?php echo $row['id']?></p>
					</div>
					<div class="project-card-item-body" id="12">
						<p><?php echo $row['project_name']?></p>
					</div>.
					<div class="project-card-item-footer" id="13">
						<p>Footer</p>
					</div>
				</div>
			<?php endforeach; ?>
		</div>

		<div id="showmore-triger" data-page="1" data-max="<?php echo $amt; ?>">
			<img src="ajax-loader.gif" alt="">
		</div>
	</body>
</html>