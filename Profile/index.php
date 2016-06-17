<?php
define("USE_FULL_NAME", TRUE);
define("MAX_BADGES", 20);

$first_name = "Jenny";
$last_name = "Han";
$location = "New York, NY";
$info = "Web Developer at Reiko Wireless Inc.";

if( USE_FULL_NAME == TRUE ){
  $name = $first_name . ' ' . $last_name;
} else {
  $name = $first_name;
}

$social_icons = array('twitter', 'facebook', 'google');



?>

<!doctype html>
<html>
	<head>
		<title><?php echo $name ?> | Profile</title>

    	<meta charset=utf-8 />
    	<link href="css/style.css" rel="stylesheet"/>
	</head>

	<body>
		<section class="sidebar text-center">
      <div class="avatar">
        <img src="img/Profile Photo.jpg" alt="<?php echo $name ?>">
      </div>
      <h1><?php echo $name ?></h1>
      <p><?php echo $location ?></p>
      <hr />
      <p><?php echo $info ?></p>
      <hr />
      <ul class="social">
        <?php
          foreach($social_icons as $icon){
        ?>
        <li><a href=""><span class="icon <?php echo $icon ?>"></span></a></li>
        <?php
          } 
        ?>
      </ul>
    </section>
    
    <section class="main">
    <p>Lets get started!</p>
    <p><?php echo "Hello, World!" ?></p>
    <ul>
      <?php 
        for ($counter=0; $counter <MAX_BADGES; $counter++){
          echo "<li>" . $counter . "</li>";
        }
      ?>
    </ul>
    </section>
    
    
	</body>
</html>