<?php 

//var_dump($_SESSION['user'] );


if (isset($_SESSION['user'])) {
?>	

<section>
<h1>Добрый  день, <?php echo $_SESSION['user'] ?> 
</h1>

<form action="../subscribe.php" method="post">
<input type="submit" name="logout" value="&#8592;Log Out"> 
</form>

</section>


<?php } else {

header("Location: /");

}?>