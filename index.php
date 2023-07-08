<html>
<head>
<link rel="stylesheet" href="css/style.css">
</head>

<body>
<ul>
        <li style="--clr:#EE82EE">
        <a href="index.php" data-text= "&nbsp;HOME">&nbsp;HOME&nbsp;</a>
        </li>
        <li style="--clr:	#DA70D6">
        <a href="nav/cat.php" data-text= "&nbsp;GENRES">&nbsp;GENRES&nbsp;</a>
        </li>
        <li style="--clr:#DDA0DD">
        <a href="nav/vote.php" data-text= "&nbsp;RANK">&nbsp;RANK&nbsp;</a>
        </li>
        <li style="--clr:	#FF00FF">
        <a href="nav/upcoming.php" data-text= "&nbsp;UPCOMING">&nbsp;UPCOMING&nbsp;</a>
        </li>
    </ul>
<form method="POST"  action="index.php">

	    <center><input name="movie_title" type="text" class="buscador" ></input></center> <input type="submit" name="boton" value="Search"></input>
        <label for="language">Idioma:</label>
    <select id="language" name="language" class="form-control">
      <option value="en">Inglés</option>
      <option value="es">Español</option>
      <option value="fr">Francés</option>
      <option value="it">Italiano</option>
    </select>
	    </form>
     


 




    <?php

include('functions/function.php');
$movies = getMovies($url);
displayMovies($movies);


?>

</body>
</html>
