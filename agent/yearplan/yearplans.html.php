<?php include_once $_SERVER['DOCUMENT_ROOT'] .'/ngcares/includes/helpers.inc.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Manage Agent: Search Results</title>
<meta http-equiv="content-type"
content="text/html; charset=utf-8"/>
</head>
<body>
<h1>Search Results</h1>
<?php if (isset($yearplans)): ?>
<table>
<tr>
<th>S/No</th>
<th>Rcc</th>
<th>Group Name</th>
<th>Startweek</th>
<th>Share Value Year</th>
<th>Welfare</th>
<th>Start Year</th>
<th>End Year</th>
<th>Status</th>
<th>Options</th></tr>
<?php 

foreach ($yearplans as $yearplan): ?>
<tr valign="top">
<td><?php htmlout($yearplan->plan_id); ?></td>
<td><?php htmlout($yearplan->rcc_name); ?></td>
<td><?php htmlout($yearplan->group_name); ?></td>
<td><?php htmlout($yearplan->start_week); ?></td>
<td><?php htmlout($yearplan->share_value); ?></td>
<td><?php htmlout($yearplan->welfare_value); ?></td>
<td><?php htmlout(''); ?></td>
<td><?php htmlout(''); ?></td>
<td><?php htmlout($yearplan->status); ?></td>
<td>
<form action="" method="post">
<div>
<input type="hidden" name="sno" value="<?php htmlout($yearplan->plan_id); ?>"/>
<input type="submit" name="action" value="Edit"/>
<input type="submit" name="action" value="Delete"/>
</div>
</form>
</td>
</tr>
<?php endforeach; ?>
</table>
<?php endif; ?>
<p><a href="?">New search</a></p>
<p><a href="..">Return to home</a></p>
<?php include '../logout.inc.html.php'; ?>
</body>
</html>