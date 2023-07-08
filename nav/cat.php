<?php
$api_key = '9f75236d530fccfbb75b9699b8e75ef6';

$genres_url = "https://api.themoviedb.org/3/genre/movie/list?api_key=$api_key&language=en-US";
$genres_response = file_get_contents($genres_url);
$genres_data = json_decode($genres_response);

// Obtengo el Numero de page y lo declaro como 1
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 1;
}

// hago que el genero por definido sea de accion.
if (isset($_GET['genre_id'])) {
  $genre_id = $_GET['genre_id'];
} else {
  // Si no se ha seleccionado un género, sera por defecto en "Acción" el cual el id es 28
  $genre_id = 28;
}

$movies_url = "https://api.themoviedb.org/3/discover/movie?api_key=$api_key&language=en-US&sort_by=popularity.desc&include_adult=false&include_video=false&page=$page&with_genres=$genre_id";
$movies_response = file_get_contents($movies_url);
$movies_data = json_decode($movies_response);

// GRID de las pelis  
$movies_list = '<div class="movies-grid">';
$movies_list .= '<div class="movie">';
foreach ($movies_data->results as $movie) {
  // Este isset me sirve para ver si la pelicula tiene una img
  if (isset($movie->poster_path) && !is_null($movie->poster_path)) {
    $movies_list .= '<div class="moviee">';
    $movies_list .= '<div class="overview">' . $movie->overview . '</div>';
    $movies_list .= '<a target="_blank" href="../trailer.php?id='.$movie->id.'"><img class="poster" src="https://image.tmdb.org/t/p/w185'.$movie->poster_path.' "></a>';
    $movies_list .= '<h3>' . $movie->title . '</h3>';
    $movies_list .= '<div class="release-date">'.$movie->release_date.'</div>';
    if ($movie->vote_average <= 2) {  
      $movies_list .= '<div class="avg"> <img class="img-star" src="../img/estrellaa.png" width="20px"></div>';
    } else if ($movie->vote_average <= 4) {
      $movies_list .= '<div class="avg"> <img class="img-star" src="../img/estrellaa.png" width="20px"><img class="img-star" src="../img/estrellaa.png" width="20px"></div>';
    } else if ($movie->vote_average <= 6) {
      $movies_list .= '<div class="avg"> <img class="img-star" src="../img/estrellaa.png" width="20px"><img class="img-star" src="../img/estrellaa.png" width="20px"><img class="img-star" src="../img/estrellaa.png" width="20px"></div>';
    } else if ($movie->vote_average <= 8) {
      $movies_list .= '<div class="avg"> <img class="img-star" src="../img/estrellaa.png" width="20px"><img class="img-star" src="../img/estrellaa.png" width="20px"><img class="img-star" src="../img/estrellaa.png" width="20px"><img class="img-star" src="../img/estrellaa.png" width="20px"></div>';
    } else {
      $movies_list .= '<div class="avg"> <img class="img-star" src="../img/estrellaa.png" width="20px"><img class="img-star" src="../img/estrellaa.png" width="20px"><img class="img-star" src="../img/estrellaa.png" width="20px"></div>';
    }
    
    // $movies_list .= '<div class= avg> '.$movie->vote_average.' <img class="img-star" src="../img/estrellaa.png" width="20px"> </div>';
    $movies_list .= '</div>';
  }
}
$movies_list .= '</div>';
$movies_list .= '</div>';
if($movie->vote_average <= 2){ 


}
// echo $movies_list;



?>
<!DOCTYPE html>
<html>
<head>
  <title>Películas por género</title>
  
  <link rel="stylesheet" href="../css/style.css">

  <style>
    
  </style>
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
  
  <center>
    <strong>
      <h1 class="cattit"> CATEGORY</h1>
    </strong>
  </center>
  
  <div class="categoryy">
    <?php foreach ($genres_data->genres as $genre): ?>
      <a class="genre-button" href="?genre_id=<?= $genre->id ?>"><?= $genre->name ?></a>
    <?php endforeach; ?>
  </div>

  <?php if (isset($movies_list)): ?>
    <center>
      <h2 class="typefilm"><?= $genres_data->genres[array_search($genre_id, array_column($genres_data->genres, 'id'))]->name ?></h2>
    </center>
    
    <?= $movies_list ?>
    
  
  <?php endif; ?>
<?php
  $previous_page = $page > 1 ? $page - 1 : 1;
$next_page = $page < $movies_data->total_pages ? $page + 1 : $movies_data->total_pages;
echo '<div class="pagination">';
echo '<a href="?genre_id=' . $genre_id . '&page='.$previous_page.'">⇜ '.$previous_page.'</a>';
echo '<a class="current" href="?genre_id=' . $genre_id . '&page='.$page.'">'.$page.'</a>';
if ($page < $movies_data->total_pages) {
    echo '<a href="?genre_id=' . $genre_id . '&page='.$next_page.'">'.$next_page.' ⇝</a>';
}
echo '</div>';
?>

</body>
</html>
