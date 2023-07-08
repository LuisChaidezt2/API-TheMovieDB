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

    <form method="get">
        <div style = "text-aling: center">
        <label for="min_date">Minimum Date:</label>
        <input class= "mindate" type="date" id="min_date" name="min_date" value="<?php echo $min_date ?? date('Y-m-d'); ?>">
        <br>
        <label for="max_date">Maximum Date:</label>
        <input class= "maxdate" type="date" id="max_date" name="max_date" value="<?php echo $max_date ?? date('Y-m-d'); ?>">
        <br>
        <input class="subup" type="submit" value="Update" style="
    width: -webkit-fill-available;
">
</div>
    </form>
    
    <?php
    $api_key = "9f75236d530fccfbb75b9699b8e75ef6";
    $language = "en-US";
    $page = 1;

    // doy por defecto unas fechas y obtengo el min_Date
    $min_date = $_GET['min_date'] ?? $min_date ?? date('2023-02-01');
    $max_date = $_GET['max_date'] ?? $max_date ?? date('2023-03-01');

    if ($max_date < $min_date) {
        // Si la fecha máxima es menor que la mínima, se establece la fecha mínima como la fecha máxima
        $max_date = $min_date;
    }

    $url = "https://api.themoviedb.org/3/discover/movie?api_key=$api_key&language=$language&page=$page&release_date.gte=$min_date&release_date.lte=$max_date";
    $response = file_get_contents($url);
    $data = json_decode($response);

    // grid
    echo '<div class="movie">';
    foreach ($data->results as $movie) {
        if ($movie->poster_path == null) {
            // Si no tiene img la peli, no sale.
            continue;
        }
        echo '<div class="movie-item">';
        echo '<a href="../trailer.php?id='.$movie->id.'" target="_blank" ><img class="poster"  src="https://image.tmdb.org/t/p/w185'.$movie->poster_path.' "></a>';
        echo '<div class="overview">'.$movie->overview.'</div>';
        echo '<h3>'.$movie->title.'</h3>';
        echo '<div class="release-date">'.$movie->release_date.'</div>';
        if ($movie->vote_average <= 2) {  
            echo '<div class="avg"> <img class="img-star" src="../img/estrellaa.png" width="20px"></div>';
          } else if ($movie->vote_average <= 4) {
            echo '<div class="avg"> <img class="img-star" src="../img/estrellaa.png" width="20px"><img class="img-star" src="../img/estrellaa.png" width="20px"></div>';
          } else if ($movie->vote_average <= 6) {
            echo '<div class="avg"> <img class="img-star" src="../img/estrellaa.png" width="20px"><img class="img-star" src="../img/estrellaa.png" width="20px"><img class="img-star" src="../img/estrellaa.png" width="20px"></div>';
          } else if ($movie->vote_average <= 7) {
            echo '<div class="avg"> <img class="img-star" src="../img/estrellaa.png" width="20px"><img class="img-star" src="../img/estrellaa.png" width="20px"><img class="img-star" src="../img/estrellaa.png" width="20px"><img class="img-star" src="../img/estrellaa.png" width="20px"><img class="img-star" src="../img/estrellaa.png" width="20px"></div>';
          } else {
             '<div class="avg"> <img class="img-star" src="../img/estrellaa.png" width="20px"><img class="img-star" src="../img/estrellaa.png" width="20px"><img class="img-star" src="../img/estrellaa.png" width="20px"></div>';
          }
        echo '</div>';
    }
    echo '</div>';
// Me lanza el numero de pagi en la q tamos
$page_number = isset($_GET['page']) ? $_GET['page'] : 1;

// Aqui es para cambiar de pagina.
echo '<div class="pagination">';
$previous_page = $page_number > 1 ? $page_number - 1 : 1;
$next_page = $page_number < $data->total_pages ? $page_number + 1 : $data->total_pages;
if ($page_number > 1) {
    echo '<a href="?page='.$previous_page.'">⇜</a>';
}
echo '<a href="?page='.$page_number.'" class="active">'.$page_number.'</a>';
if ($page_number < $data->total_pages) {
    echo '<a href="?page='.$next_page.'">⇝</a>';
}
echo '</div>';


    
    ?>
    
</body>
</html>
