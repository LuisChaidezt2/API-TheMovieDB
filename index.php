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


// echo $url;





// $API_KEY = 'api_key=9f75236d530fccfbb75b9699b8e75ef6';
// $url = '';

// if (isset($_POST['movie_title']) && !empty($_POST['movie_title'])) {
//     $palabra = str_replace(' ', '%20', $_POST['movie_title']); // Reemplazar espacios por "%20"
//     $url = "https://api.themoviedb.org/3/search/movie?$API_KEY&query=$palabra";
// } else {
//     $url = "https://api.themoviedb.org/3/movie/popular?$API_KEY";
// }

// $archivo = file_get_contents($url);
// $data = json_decode($archivo);

// echo '<div class="movie">';
// foreach ($data->results as $movie) {
//     // Verificar si la película tiene imagen
//     if (!empty($movie->poster_path)) {
//         echo '<div class="movie-item">';
//         echo '<img class="poster"  src="https://image.tmdb.org/t/p/w185'.$movie->poster_path.' " >';
//         echo '<div class="overview">'.$movie->overview.'</div>';
//         echo '<h3>'.$movie->title.'</h3>';
//         echo '<div class= avg>'.$movie->vote_average.'</div>';
//         echo '</div>';
//     }
// }
// echo '</div>';
?>

</body>
</html>
