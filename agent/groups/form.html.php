<?php include_once $_SERVER['DOCUMENT_ROOT'] .'/adashenew/agent/includes/helpers.inc.php'; 
echo $groupid;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title><?php htmlout($pagetitle); ?></title>
<script src="../jquery/dist/jquery.min.js"></script>
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
	<form action="?<?php htmlout($action); ?>" method="POST">

		<div>
			<label for="rcc">RCC:</label>
			<select name="rcc" id="rcc">
				<option value="">Select one</option>
				<?php foreach ($rccs as $rcc): ?>
				<option value="<?php htmlout($rcc->rcc_id); ?>"
				<?php
				if ($rcc->rcc_id == $rccid)
				echo ' selected="selected"';?>>
				<?php htmlout($rcc->rcc_name); ?></option>
				<?php endforeach; ?>
				</select>
		</div>

		<div>
			<label for="groupname" >Group Name:</label>
			<textarea id="groupname" name="groupname" rows="2" cols="20"><?php htmlout($groupname);?></textarea>
		</div>

		<div>
			<label for="lccname"> Name of LCC:</label>
			<textarea id="lccname" name="lccname" rows="2" cols="20"><?php htmlout($lccname);?></textarea>
		</div>

		<div>
			<input type="hidden" name="group_id" value="<?php htmlout($groupid); ?>"/>
			<input type="submit" value="<?php htmlout($button); ?>"/>
		</div>

	</form>

	<script>
		// $(document).ready(function(){
		// 	const queryString = window.location.search;
		// 		url = "http://localhost/adashe_api/api/rccs/read.php";
		// 		$.ajax({
		// 			method: "GET",
		// 			url: url,
					
		// 		}).done(function(data) {
		// 			status = data['status']
		// 			message = data['message']
		// 			// alert(message)	
		// 			let i = 0;			
					
		// 			if(status == 0){
		// 				data = JSON.stringify(data['data'])
		// 				data = JSON.parse(data)
		// 				for(i=0; i<data.length; i++){
		// 					$('<option value="' + data[i]['rcc_id'] + '">' + data[i]['rcc_name'] + '</option>').appendTo('#rcc');
		// 					console.log(data[i])
		// 				}
		// 			}else if(status == 1){
		// 				// alert(status)
		// 				$('<option value="">' + message + '</option>').appendTo('#rcc');
		// 			}
					
		// 			console.log(data[0]['rcc-name'])
					
		// 		}).fail(function(){
		// 			alert("failure")
		// 		})

			
			
			
		// })
				
		
	</script>
		
	

</body>
</html>