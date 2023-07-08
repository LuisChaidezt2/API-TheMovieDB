<!-- $api_key = '9f75236d530fccfbb75b9699b8e75ef6';
    $page = isset($_GET['page']) ? $_GET['page'] : 1; // Obtener el número de página de la URL o establecerlo en 1 por defecto
    $url = "https://api.themoviedb.org/3/movie/top_rated?api_key=$api_key&language=en-US&page=$page";

    $response = file_get_contents($url);
    $data = json_decode($response);
    echo '<div class="movie">';
    foreach ($data->results as $movie) {
        echo '<div class="movie-item">';
        echo '<a href="trailer.php?id='.$movie->id.'"><img class="poster" src="https://image.tmdb.org/t/p/w185'.$movie->poster_path.' "></a>';
        echo '<div class="overview">'.$movie->overview.'</div>';
        echo '<h3>'.$movie->title.'</h3>';
        echo '<div class="release-date">'.$movie->release_date.'</div>';
        echo '<div class= avg> '.$movie->vote_average.' <img class="img-star" src="img/estrellaa.png" width="20px"> </div>';
        echo '</div>';
    }
    echo '</div>'; -->
<html>
    <head>
    <link rel="stylesheet" href="../css/style.css">
    </head>

    
<body>
<ul>
        <li style="--clr:#EE82EE">
        <a href="../index.php" data-text= "&nbsp;HOME">&nbsp;HOME&nbsp;</a>
        </li>
        <li style="--clr:	#DA70D6">
        <a href="cat.php" data-text= "&nbsp;GENRES">&nbsp;GENRES&nbsp;</a>
        </li>
        <li style="--clr:#DDA0DD">
        <a href="vote.php" data-text= "&nbsp;RANK">&nbsp;RANK&nbsp;</a>
        </li>
        <li style="--clr:	#FF00FF">
        <a href="upcoming.php" data-text= "&nbsp;UPCOMING">&nbsp;UPCOMING&nbsp;</a>
        </li>
    </ul>
    <center><strong><h1 class="rated">top rated movies</h1></strong></center>
</body>
</html>

<?php
    // https://api.themoviedb.org/3/movie/top_rated?api_key=9f75236d530fccfbb75b9699b8e75ef6&language=en-US&page=1


// API Key
$api_key = '9f75236d530fccfbb75b9699b8e75ef6';
$language = 'en-US';

// Obtenemos el  numero de la page
$page_number = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$url = "https://api.themoviedb.org/3/movie/top_rated?api_key=$api_key&language=$language&page=$page_number";


$response = file_get_contents($url);
$data = json_decode($response);

// GRID
echo '<div class="movie">';
foreach ($data->results as $movie) {
    if ($movie->poster_path == null) {
        
        continue;
    }
    echo '<div class="movie-item">';
    echo '<a target="_blank" href="../trailer.php?id='.$movie->id.'"><img class="poster" src="https://image.tmdb.org/t/p/w185'.$movie->poster_path.' "></a>';
    echo '<div class="overview">'.$movie->overview.'</div>';
    echo '<h3>'.$movie->title.'</h3>';
    echo '<div class="release-date">'.$movie->release_date.'</div>';
    if ($movie->vote_average <= 2) {  
        echo '<div class="avg"> <img class="img-star" src="../img/estrellaa.png" width="20px"></div>';
      } else if ($movie->vote_average <= 4) {
        echo '<div class="avg"> <img class="img-star" src="../img/estrellaa.png" width="20px"><img class="img-star" src="../img/estrellaa.png" width="20px"></div>';
      } else if ($movie->vote_average <= 6) {
        echo '<div class="avg"> <img class="img-star" src="../img/estrellaa.png" width="20px"><img class="img-star" src="../img/estrellaa.png" width="20px"><img class="img-star" src="../img/estrellaa.png" width="20px"></div>';
      } else if ($movie->vote_average <= 8) {
        echo  '<div class="avg"> <img class="img-star" src="../img/estrellaa.png" width="20px"><img class="img-star" src="../img/estrellaa.png" width="20px"><img class="img-star" src="../img/estrellaa.png" width="20px"><img class="img-star" src="../img/estrellaa.png" width="20px"></div>';
      } else {
        echo '<div class="avg"> <img class="img-star" src="../img/estrellaa.png" width="20px"><img class="img-star" src="../img/estrellaa.png" width="20px"><img class="img-star" src="../img/estrellaa.png" width="20px"></div>';
      }
    echo '</div>';
}
echo '</div>';

// Esto es para cambiar de pagina.
$previous_page = $page_number > 1 ? $page_number - 1 : 1;
$next_page = $page_number < $data->total_pages ? $page_number + 1 : $data->total_pages;
echo '<div class="pagination">';
echo '<a href="?page='.$previous_page.'">⇜ '.$previous_page.'</a>';
echo '<a class="current" href="?page='.$page_number.'">'.$page_number.'</a>';
if ($page_number < $data->total_pages) {
    echo '<a href="?page='.$next_page.'">'.$next_page.' ⇝</a>';
}
echo '</div>';
?>



