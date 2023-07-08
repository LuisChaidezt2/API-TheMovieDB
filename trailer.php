
<!DOCTYPE html>
<html>
<head>
	<title>Videos de película</title>

    <link rel="stylesheet" href="css/styletrailer.css">
	
</head>
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
<body>

<?php
$id = $_GET['id'];

$api_key = '9f75236d530fccfbb75b9699b8e75ef6';
$url = "https://api.themoviedb.org/3/movie/$id?api_key=$api_key&language=en-US";

$movie_data = file_get_contents($url);
$movie = json_decode($movie_data);
echo '<center>';
echo '<h1 class=" titlee"><strong>'.$movie->title.'</strong></h1>';
echo '<img src="https://image.tmdb.org/t/p/w500/'.$movie->poster_path.'" alt="'.$movie->title.'">';
echo '<p><strong>Release date:</strong> '.$movie->release_date.'</p>';
echo '<p><strong>Overview:</strong> '.$movie->overview.'</p>';
echo '<p><strong>Vote average:</strong> '.$movie->vote_average.'</p>';
echo '<p><strong>Genres: </strong>';
foreach ($movie->genres as $genre) {
    echo $genre->name.' ';
}
echo '</p>';
echo '</center>';



	// Verifico si proporciono un ID de peli
	if (!isset($_GET['id'])) {
	    die('Se requiere un ID de película.');
	}


	// iteracion del api para los vidiooooos
	$archivo = file_get_contents("https://api.themoviedb.org/3/movie/$id/videos?api_key=9f75236d530fccfbb75b9699b8e75ef6&language=en-US");
	$data = json_decode($archivo);

	echo '<h4 class="Trailer">Trailers</h4>';
	echo '<div class="movies-grid">';
	
	foreach ($data->results as $video) {
	    $video_id = $video->key;
	    echo '<div class="movie">';
	    echo '<iframe src="https://www.youtube.com/embed/'.$video_id.'" frameborder="0" allowfullscreen></iframe>';
	        echo '<h3>'.$video->name.'</h3>';
	    echo '</div>';
	}
	echo '</div>';
    
    // Si es diferente a me manda un error
    if (!$data) {
        die('Error al obtener los datos de la API.');
    }






?>
</body>
</html>

