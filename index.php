<?php

session_start();
if(!isset($_SESSION['email'])){
    header("location:login.php");
}

if(isset($_POST['submit']))
{
    header("location:login.php");
    
    unset($_SESSION['email']);  
    session_destroy(); 
}

if(isset($_POST['shop']))
{
    header("location:loadShop.php");
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>TechnoGeeks</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />   
	<link rel="stylesheet" href="style2.css" /> 
</head>

<body>

<center>

<p>Welcom<b><?php echo $_SESSION['email']; ?></b>Login Succesful</p>

      
		
		<div id="main">
    <div id="header">
      <div id="logo">
        <div id="logo_text">
          <h1><a href="index.php">Techno<span class="logo_colour">Geeks</span></a></h1>
          <h2>For All your tech needs and info</h2>
        </div>
      </div>
      <div id="menubar">
        <ul id="menu">
         
         <li><a href="loadShop.php">ENTER SHOP</a></li>
         
        </ul>
      </div>
    </div>
    <div id="site_content">
      <div class="sidebar">
       

         <li><a href="https://www.popularmechanics.com/technology/">Latest News</a></li>

        
        <h5>october 22, 2020</h5>
        <p>Humans take their first trip inside a cyber loop<br /><a href="https://www.popularmechanics.com/technology/infrastructure/a34630407/virgin-hyperloop-first-manned-trip/">Read More</a></p>
        <h1>for further Info</h1>
        <ul>
          <li><a href="https://www.facebook.com/">Facebook</a></li>
          <li><a href="https://www.twitter.com/">Twitter</a></li>
          <li><a href="https://www.google.com/">Google</a></li>
          <li><a href="https://www.instagram.com/">Instagram</a></li>
        </ul>
        <h1>Search</h1>
        <form method="post" action="https://www.google.com/" id="search_form">
          <p>
            <input class="search" type="text" name="search_field" value="" />
            <input name="search" type="image" style="border: 0; margin: 0 0 -9px 5px;" src="style/.png" alt="Search" title="Search" />
          </p>
        </form>
      </div>
      <div id="content">
        <h1>Latest Tech innovations</h1>
        <p>Everywhere I turn, new technologies, products, and strategies are emerging in response to COVID-19. 
          Look at Spot, the Boston Dynamics robot dog, 
          which counted visitors and helped enforce physical distancing in a park in Singapore. 
          Or look at the explosive growth of tele-health the need for social distancing is expected to drive a 64.3 percent rise in 
          telehealth demand this year! For many, the key to overcoming COVID-19 isn't just out-lasting the virus, 
          it's out-innovating it.

          In February, we published Accentures 2020 Technology Vision.
           The annual report highlights five technology trends that will have a major impact on businesses in coming years. 
           But COVID-19 has introduced many unexpected challenges, and we have seen an incredible acceleration of technology and innovation follow. 
           Given this global shift, we've revisited our trends in a mid-year update, Driving Value and Values during COVID-19. 
           This update features leading businesses that are pushing technology years ahead of schedule. 
           And yet, not everyone has realized that innovation is the path forward.
           Gartner has predicted that global IT spending will fall eight percent in 2020,
           as CIOs prioritize mission-critical technology and services over those for transformation and growth.
           This is understandable, with customers, employees and ecosystem partners all operating within new and uncertain circumstances.
           But there is a better path forward! Everyone is taking this moment to reprioritize and re-strategize,
           and the enterprises that choose to step back from innovation will fall further and faster behind those that step forward.</p>

       <h1>FORM BELOW</h1>
       <li><a href="https://docs.google.com/forms/d/1PK75pPGgV6rgJ4vyQQ7QSuOW7FOp9vO1-elBYUW0ndo/edit">Email</a></li>
       
      </div>
    </div>
	
	<br>
	<br>
	
	  <form method="post">
           
            <input type="submit" name="submit" value="Logout" />
        </form>
    <div id="footer">
      <p><a href="store.php">Home</a> | <a>Our Work</a> | <a>About Us</a> | <a>Get Involoved</a> | <a>Contact Us</a></p>
      <p>Copyright Mihlali Solwandle
    </div>
  </div>

</center>


</body>
</html>