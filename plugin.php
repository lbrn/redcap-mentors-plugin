<?php
	/**
	 * PLUGIN NAME: Mentors
	 * DESCRIPTION: A brief description of the Plugin.
	 * VERSION: The Plugin's Version Number, e.g.: 1.0
	 * AUTHOR: Name Of The Plugin Author
	 */

	// Call the REDCap Connect file in the main "redcap" directory
	require_once "../redcap_connect.php";
	// require_once APP_PATH_DOCROOT . 'ProjectGeneral/header.php';

	$data = REDCap::getData();
	$importantColumns = array(
		'f_name'        => 'First Name',
		'l_name'        => 'Last Name',
		'affiliation'   => 'Affiliation',
		'department'    => 'Department',
		'topic'         => 'Research Topic',
		'main_interest' => 'Main Interest',
		'url'           => 'Website',
		'email'         => 'Email',
	);

	$undergradMentors = array();
	$gradMentors      = array();
	$facultyMentors   = array();

	foreach ($data as $dataThing) {
		foreach ($dataThing as $row) {
			foreach ($row['mentoring'] as $academicStatus => $willAccept) {
				switch ($academicStatus) {
					case 'U':
						if ($willAccept)
							array_push($undergradMentors, $row);
						break;
					case 'G':
						if ($willAccept)
							array_push($gradMentors, $row);
						break;
					case 'F':
						if ($willAccept)
							array_push($facultyMentors, $row);
						break;
				}
			}
		}
	}

?>
<html>
	<head>
		<title>LBRN Prospective Mentors</title>
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap-theme.min.css">
		<meta charset="utf-8">
		<style>
			th { cursor: pointer; }
		</style>
	</head>
	<body class="container">
		<div class="page-header">
			<h1>LBRN Mentors</h1>
		</div>
		<ul class="nav nav-tabs">
			<li class="active"><a href="#undergrad" data-toggle="tab">Undergraduate</a></li>
			<li><a href="#graduate" data-toggle="tab">Graduate</a></li>
			<li><a href="#faculty" data-toggle="tab">Faculty</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="undergrad">
				
				<table class="table tablesorter table-hover">
					<thead>
						<?php foreach($importantColumns as $column): ?>
							<th><?php echo $column; ?></th>
						<?php endforeach; ?>
					</thead>
					<tbody>
						<?php foreach ($undergradMentors as $row): ?>
							<tr>
								<?php foreach ($row as $columnName => $value): ?>
									<?php if (in_array($importantColumns[$columnName], $importantColumns)): ?>
										<td><?php echo $value; ?></td>
									<?php endif; ?>
								<?php endforeach; ?>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<div class="tab-pane" id="graduate">
				
				<table class="table tablesorter table-hover">
					<thead>
						<?php foreach($importantColumns as $column): ?>
							<th><?php echo $column; ?></th>
						<?php endforeach; ?>
					</thead>
					<tbody>
						<?php foreach ($gradMentors as $row): ?>
							<tr>
								<?php foreach ($row as $columnName => $value): ?>
									<?php if (in_array($importantColumns[$columnName], $importantColumns)): ?>
										<td><?php echo $value; ?></td>
									<?php endif; ?>
								<?php endforeach; ?>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<div class="tab-pane" id="faculty">
				
				<table class="table tablesorter table-hover">
					<thead>
						<?php foreach($importantColumns as $column): ?>
							<th><?php echo $column; ?></th>
						<?php endforeach; ?>
					</thead>
					<tbody>
						<?php foreach ($facultyMentors as $row): ?>
							<tr>
								<?php foreach ($row as $columnName => $value): ?>
									<?php if (in_array($importantColumns[$columnName], $importantColumns)): ?>
										<td><?php echo $value; ?></td>
									<?php endif; ?>
								<?php endforeach; ?>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
		

		<?php require_once APP_PATH_DOCROOT . 'ProjectGeneral/footer.php'; ?>
		<script src="jquery.min.js"></script>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
		<script src="jquery.tablesorter.min.js"></script>
		<script>
			$(function() { 
				$(".table").tablesorter( {sortList: [[0,0], [1,0]]} ); 
			});
		</script>
	</body>
</html>