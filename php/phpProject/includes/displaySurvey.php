<?php 
function displaySurvey($db_conn){

	$qry = "SELECT (custId, full_name, age, student,) FROM customer;";
	
	if ($rs = $db_conn->query($qry)){
		if ($rs->num_rows > 0){
?>
			<table border="1">
			<tr><th>Select</th><th>Name</th><th>Location</th></tr>
<?php while ($row = $rs->fetch_assoc()){ ?>
			<tr>
			<td><input type="radio" name="list_select[]" value="<?php echo $row['custId']; ?>"></td>
			<td><?php echo $row['full_name']; ?></td>
			<td><?php echo $row['age']; ?></td>
			<td><?php echo $row['student']; ?></td>
			</tr>
<?php } ?>
			</table>
<?php
		} else {
			echo "<div>\n";
			echo "<p>No contacts to display</p>\n";
			echo "</div>\n";
		}
	}
}
?>
