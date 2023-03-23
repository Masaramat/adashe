<?php include_once $_SERVER['DOCUMENT_ROOT'] .'/adashewalletold/includes/helpers.inc.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Manage Groups</title>
<meta http-equiv="content-type"
content="text/html; charset=utf-8"/>
</head>
<body>
<h1>Manage Group</h1>
<p><a href="?add">Add Group</a></p>
<form action="" method="get">
<p>View Groups satisfying the following criteria:</p>

<div>
<label for="rcc">By RCC:</label>
<select name="rcc" id="rcc">
<option value="">Any RCC</option>
<?php foreach ($rccs as $rcc): ?>
<option value="<?php htmlout($rcc['rccid']); ?>"><?php htmlout($rcc['rccname']); ?></option>
<?php endforeach; ?>
</select>
</div>

<div>
<label for="agent">By Agent:</label>
<select name="agent" id="agent">
<option value="">Any Agent</option>
<?php foreach ($agents as $agent): ?>
<option value="<?php htmlout($agent['agentid']); ?>"><?php htmlout($agent['agentname']); ?></option>
<?php endforeach; ?>
</select>
</div>



<div>
<label for="text">Containing text:</label>
<input type="text" name="text" id="text"/>
</div>
<div>
<input type="hidden" name="action" value="search"/>
<input type="submit" value="Search"/>
</div>
</form>
<p><a href="..">Return to home</a></p>
</body>
</html>