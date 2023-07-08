<?php
// if(isset($_POST['movie_title'])){
//     $palabra= str_replace(' ', '%20', $_POST['movie_title']);
// }else{
//     $palabra='Batman';
// }


// Con esta funcion obtengo el URL, si no se ha escrito nada en el search, lo que se mostrara, seran las pelis mas populares.
function getMoviesUrl($query = null, $lang = 'en-US') {
    $API_KEY = 'api_key=9f75236d530fccfbb75b9699b8e75ef6';
    $url = '';

    if (!is_null($query)) {
        $palabra = str_replace(' ', '%20', $query);
        $url = "https://api.themoviedb.org/3/search/movie?$API_KEY&language=$lang&query=$palabra";
    } else {
        $url = "https://api.themoviedb.org/3/movie/popular?$API_KEY&language=$lang";
    }

    return $url;
}
// Esta funcion me sirve para iterar el URL de la api
function getMovies($url, $page = 1) {
    $url .= '&page=' . $page;
    $archivo = file_get_contents($url);
    $data = json_decode($archivo);
    
    $movies = array();
    foreach ($data->results as $movie) {
        if (!empty($movie->poster_path)) {
            $movies[] = $movie;
        }
    }
    
    return $movies;
}


// en esta funcion me sirve para agregar el grid de las pelis
function displayMovies($movies, $page = 1, $total_pages = 1) {
    echo '<div class="movie">';
    foreach ($movies as $movie) {
        if ($movie->poster_path == null) {
            // Si no tiene img la peli, no sale.
            continue;
        }
        echo '<div class="movie-item">';
        echo '<a target="_blank" href="trailer.php?id='.$movie->id.'"><img class="poster" src="https://image.tmdb.org/t/p/w185'.$movie->poster_path.' "></a>';
        echo '<div class="overview">'.$movie->overview.'</div>';
        echo '<h3>'.$movie->title.'</h3>';
        echo '<div class="release-date">'.$movie->release_date.'</div>';
        if ($movie->vote_average <= 2) {  
            echo '<div class="avg"> <img class="img-star" src="img/estrellaa.png" width="20px"></div>';
          } else if ($movie->vote_average <= 4) {
            echo '<div class="avg"> <img class="img-star" src="img/estrellaa.png" width="20px"><img class="img-star" src="img/estrellaa.png" width="20px"></div>';
          } else if ($movie->vote_average <= 6) {
            echo '<div class="avg"> <img class="img-star" src="img/estrellaa.png" width="20px"><img class="img-star" src="img/estrellaa.png" width="20px"><img class="img-star" src="img/estrellaa.png" width="20px"></div>';
          } else if ($movie->vote_average <= 8) {
            echo '<div class="avg"> <img class="img-star" src="img/estrellaa.png" width="20px"><img class="img-star" src="img/estrellaa.png" width="20px"><img class="img-star" src="img/estrellaa.png" width="20px"><img class="img-star" src="img/estrellaa.png" width="20px"></div>';
          } else {
            echo'<div class="avg"> <img class="img-star" src="img/estrellaa.png" width="20px"><img class="img-star" src="img/estrellaa.png" width="20px"><img class="img-star" src="img/estrellaa.png" width="20px"></div>';
          }
        echo '</div>';
    }
    echo '</div>';
}
// Aqui guardo los valores de los post para formar el url
if (isset($_POST['movie_title']) && !empty($_POST['movie_title'])) {
    $url = getMoviesUrl($_POST['movie_title'], $_POST['language']);
} elseif (isset($_POST['language']) && !empty($_POST['language'])) {
    $url = getMoviesUrl(null, $_POST['language']);
} else {
    $url = getMoviesUrl();
}
?>
