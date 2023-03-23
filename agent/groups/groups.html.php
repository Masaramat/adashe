<?php include_once $_SERVER['DOCUMENT_ROOT'] .'/adashenew/agent/includes/helpers.inc.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Manage Groups: Search Results</title>
<meta http-equiv="content-type"
content="text/html; charset=utf-8"/>
</head>
<body>
<h1>Search Results</h1>
<?php if (isset($groups)): ?>
<table>
<tr>
<th>S/No</th>
<th>Group Name</th>
<th>LCC</th>
<th>RCC</th>
<th>Agent</th>
<th>Options</th>
</tr>
<?php $xy=1; foreach ($groups as $group):  ?>
<tr valign="top">
<td><?php htmlout($xy); ?></td>
<td><?php htmlout($group->group_name); ?></td>
<td><?php htmlout($group->lcc_name); ?></td>
<td><?php htmlout($group->rcc_name); ?></td>
<td><?php htmlout($group->agent_name); ?></td>
<td>
<form action="?" method="post">
<div>
<input type="hidden" name="id" value="<?php htmlout($group->sno); ?>"/>
<input type="hidden" name="group_name" value="<?php htmlout($group->group_name); ?>"/>
<input type="hidden" name="lcc_name" value="<?php htmlout($group->lcc_name); ?>"/>
<input type="hidden" name="rcc_name" value="<?php htmlout($group->rcc_name); ?>"/>
<input type="submit" name="action" value="Edit"/>
<input type="submit" name="action" value="Delete"/>
</div>
</form>
</td>
</tr>
<?php $xy++; endforeach; ?>
</table>
<?php endif; ?>
<p><a href="?">New search</a></p>
<p><a href="..">Return to home</a></p>
<?php include '../logout.inc.html.php'; ?>
</body>
</html>