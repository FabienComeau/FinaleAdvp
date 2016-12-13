<!DOCTYPE html>
<html>
<head>
	...
	<link href="themes/prism.css" rel="stylesheet" />
</head>
<body>
	...
	<script src="prism.js"></script>
</body>
</html>


 <?php
         
            
             //instantiate the database handler
             $dbh = new DbHandler();
             
$data=$dbh->getDemoList();
var_dump($data);

?>

