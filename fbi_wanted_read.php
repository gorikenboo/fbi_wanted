<?php
$csvget = array();
//csv読み取り 
$fp = fopen('data/file.csv', 'r');
while (($data = fgetcsv($fp))) {
    array_push($csvget, $data);
}

fclose($fp);

$csv_json = json_encode($csvget);
?>

<!doctype html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.79.0">
    <title>FBI Wanted</title>

    <link rel="canonical" href="https://getbootstrap.jp/docs/5.0/examples/album/">



    <!-- Bootstrap core CSS -->
    <link href=https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.0/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#7952b3">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


</head>

<body>
    <main>

        <section class="py-5 text-center container">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">FBI Wanted</h1>
                    <p class="lead text-muted">You can get the FBI wanted information very easily!</p>

                </div>
            </div>
        </section>

        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3" id="container_box">
                </div>
            </div>
        </div>
        </div>

    </main>

    <footer class="text-muted py-5">
        <div class="container">
            <p class="float-end mb-1">
                <a href="#">Top</a>
            </p>
        </div>
    </footer>


    <script src="/docs/5.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>


</body>

</html>

<script>
    let res = <?= $csv_json ?>;
    console.log(res.length);
    let aa = "";
    for (let i = 0; i < res.length; i++) {
        $("#container_box").append('<div class="col"><div class="card shadow-sm" id="img' + i + '"><img src="" class="card-img-top"> <div class = "card-body"id = "text' + i + '"> </div>');
    }
    for (let i = 0; i < res.length; i++) {
        $("#img" + i).children("img").attr("src", res[i][7]);
        $("#text" + i).html("<p>" + res[i][1] + "</p><p> " + res[i][3] + " </p>");
        $("#text" + i).children("p").attr("class", "card-text ");
    }
</script>

</html>