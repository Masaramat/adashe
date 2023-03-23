<?php include_once $_SERVER['DOCUMENT_ROOT'] .'/adashenew/agent/includes/helpers.inc.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Manage RCC: Search Results</title>
<meta http-equiv="content-type"
content="text/html; charset=utf-8"/>
</head>
<body>
<h1>Search Results</h1>
<?php if (isset($rccs)): ?>
<table>
<tr>
<th>SNO</th>
<th>Name of RCC</th>
<th>Location</th>
<th>Agent</th>
<th>Options</th>
</tr>
<?php 
if(isset($message)){
    echo $message;
}
$xy = 1;
$rccs = $rccs->data;
foreach ($rccs as $rcc): ?>
<tr valign="top">
    <td><?php htmlout($xy); ?></td>
    <td><?php htmlout($rcc->rcc_name); ?></td>
    <td><?php htmlout($rcc->rcc_location); ?></td>
    <td><?php htmlout($rcc->agent_name); ?></td>
    <td>
        <form action="?" method="post">
            <input type="hidden" name="id" value="<?php htmlout($rcc->rcc_id); ?>"/>
            <input type="submit" name="action" value="Edit"/>
            <input type="submit" name="action" value="Delete"/>

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