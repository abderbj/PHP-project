<?php
if(isset($_FILES['image']))
{
	$extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
	move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . $new_name);
	$data = array(
		'image_source'		=>	'images/' . $new_name
	);

	echo json_encode($data);

}
