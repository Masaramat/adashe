<?php include_once $_SERVER['DOCUMENT_ROOT'] .'/adashenew/agent/includes/helpers.inc.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title><?php htmlout($pagetitle); ?></title>
<meta http-equiv="content-type"
content="text/html; charset=utf-8"/>
<style type="text/css">
textarea {
display: block;
width: 100%;
}
</style>
</head>
<body>
<h1><?php htmlout($pagetitle); ?></h1>
<form action="?<?php htmlout($action); ?>" method="post">
<div>
<label for="rccname">RCC Name:</label>
<textarea required id="rccname" name="rccname" rows="2" cols="20"><?php htmlout($rccname);?></textarea>
</div>

<div>
<label for="rcclocation">RCC Location:</label>
<textarea required id="rcclocation" name="rcclocation" rows="2" cols="20"><?php htmlout($rcclocation);?></textarea>
</div>

<div>
<label for="agent">Agent:</label>
<select required name="agent" id="agent">
<option value="">Select one</option>
<?php foreach ($agents as $agent): ?>
<option value="<?php htmlout($agent->user_id); ?>"
<?php
if ($agent->user_id == $agentid)
echo ' selected="selected"';?>>
<?php htmlout($agent->name); ?></option>
<?php endforeach; ?>
</select>
</div>


<div>
<input type="hidden" name="id" value="<?php htmlout($id); ?>"/>
<input type="submit" value="<?php htmlout($button); ?>"/>
</div>

</form>
</body>
</html>