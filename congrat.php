<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Congrats</title>
    <style>
        img{
            width: 400px;
            height: 400px;
        }
 #my-canvas{
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}


    </style>
</head>
<body>
        <div class="container py-5">
                <div class="text-center py-4">
                    <h2 class="section-heading text-uppercase">Welcome</h2>
                  </div>
                <div class="row ">
                        <div class="col-lg-12 text-center py-3">
                            <img class="mx-auto rounded-circle" src="./storage/<?=$_GET['avatar']?>" alt="..." />
                            <h4 class="fw-bolder py-2"><?=$_GET['name']?></h4>
                       </div>
                </div>
       </div>
        <canvas id="my-canvas"></canvas>
</body>
<script src="./assets/script/index.min.js"></script>
<script>
    var confettiSettings = { target: 'my-canvas' };
    var confetti = new ConfettiGenerator(confettiSettings);
    confetti.render();
    setTimeout(()=>window.location.href="./login",5000);
</script>
</body>
</html>