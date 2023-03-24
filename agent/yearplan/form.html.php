<?php include_once $_SERVER['DOCUMENT_ROOT'] .'/adashenew/agent/includes/helpers.inc.php'; ?>
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
	<form action="?<?php htmlout($action); ?>" method="post">

		<div>
			<label for="rcc">RCC:</label>
			<select name="rcc" id="rcc" onchange="FetchGroups(this.value)">
				<option value="">Select One</option>
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
			<label for="group">Group:</label>
			<select name="group" id="group">
			<?php 
			print_r($groups);
			foreach ($groups as $group): ?>
				<option value="<?php htmlout($group->group_id); ?>"<?php
				if ($group->group_id == $group)
				echo ' selected="selected"';?>>
				<?php htmlout($group->group_name); ?></option>
				<?php endforeach; ?>
			
			</select>
		</div>

		<div>
			<label for="ddate">Date:</label>
			<input type="date" name="ddate" id="ddate" value="<?php htmlout($startweek); ?>" />
		</div>


		<div>
			<label for="sharevalue">Share Value:</label>
			<input type="text"  id="sharevalue" name="sharevalue" value ="<?php htmlout($sharevalue);?>" />
		</div>

				
		<div>
			<label for="welfare">Welfare:</label>
			<input type="text" name="welfare" id="welfare" value="<?php htmlout($welfare); ?>" />
		</div>
		
		
		
		<div><p><hr/></p></div>		<div><p><hr/></p></div>

		
		<div>
			<input type="hidden" name="sno" value="<?php htmlout($sno); ?>"/>
			<input type="submit" value="<?php htmlout($button); ?>"/>
		</div>
		
	</form>

	<form action="" method="post">
		<div>
			<label for="membername">Member Name:</label>
			<input type="text" name="membername" id="membername" value="<?php htmlout($membername); ?>" />
		</div>

		<div>
			<label for="email">Email:</label>
			<input type="text" name="email" id="email" value="<?php htmlout($email); ?>" />
		</div>

		<div>
			<label for="phone">Phone Number:</label>
			<input type="text" name="phone" id="phone" value="<?php htmlout($phone); ?>" />
		</div>
		<div>
			<label for="address">Address:</label>
			<input type="text" name="address" id="address" value="<?php htmlout($address); ?>" />
		</div>

		<div>
			<label for="role">Member Role:</label>
			<select name="role" id="role" >
				<option value="">Select One</option>
								
			</select>
		</div>
		
		<div>
		<div>
			<label for="password">Password:</label>
			<input type="text" name="password" id="password" value="<?php htmlout($password); ?>" />
		</div>
		<input type="submit" name ="action" value="Addss"/>
		</div>
	</form>

	<?php if (isset($_SESSION['cart'])): ?>
        <table>
            <tr>

                <th>Member Name</th>
				<th>Email</th>
                <th>Phone Number</th> 
				<th>Address</th>   
				<th>Password</th>              
				<th>Role</th>
                
                <th>Options</th></tr>
                <?php foreach ($_SESSION['cart'] as $member): ?>
            <tr valign="top">

                <td><?php htmlout($member['member_name']); ?></td>
                <td><?php htmlout($member['email']); ?></td>
                <td><?php htmlout($member['phone_no']); ?></td>
				<td><?php htmlout($member['contact_address']); ?></td>
                <td><?php htmlout($member['password']); ?></td>
				<td><?php htmlout($member['position']); ?></td>
                
                <td>
                <form action="" method="POST">
				
				<div>
                <input type="hidden" name="id" value=""/>
                <input type="submit" name="action" value="Edit"/>
                <a href="./?id=<?php echo array_search($member, $_SESSION['cart']); ?>">Delete</a>                
                </div>

                </form>
                </td>
            </tr>
            <?php   endforeach;    ?>
        </table>
        <?php endif; ?>


	




	<script>

		$(document).ready(function(){
			url = "http://localhost/adashe_api/api/year_plan/get_role.php";
			$.ajax({
				method: "GET",
				url: url,
				
			}).done(function(data) {
				alert("data")					
				let i = 0;				
				if(status == 0){
					data = JSON.stringify(data['data'])
					data = JSON.parse(data)
					for(i=0; i<data.length; i++){
						$('<option value="' + data[i]['role_id'] + '">' + data[i]['position'] + '</option>').appendTo('#role');
						console.log(data[i])
					}
				}else if(status == 1){
					// alert(status)
					$("#role").html("");
					$('<option value="">' + message + '</option>').appendTo('#role');
				}
			
				
			}).fail(function(){
				alert("failure")
			})	
			
		})
				
		function FetchGroups(id) {
			$("#group").html("");
			url = "http://localhost/adashe_api/api/groups/read_single.php?column=rcc_id&value=";
			$.ajax({
				method: "GET",
				url: url.concat(id),
				
			}).done(function(data) {
				status = data['status']
				message = data['message']
				// alert(message)	
				let i = 0;			
				
				if(status == 0){
					data = JSON.stringify(data['data'])
					data = JSON.parse(data)
					for(i=0; i<data.length; i++){
						$('<option value="' + data[i]['group_id'] + '">' + data[i]['group_name'] + '</option>').appendTo('#group');
					}
				}else if(status == 1){
					// alert(status)
					$('<option value="">' + message + '</option>').appendTo('#group');
				}
				
				console.log(data[0]['group_name'])
				
			}).fail(function(){
				alert("failure")
			})
		}

		
	</script>
		
	


</body>
</html>