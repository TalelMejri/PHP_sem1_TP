<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Congrats</title>
    <style>
         #my-canvas{
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

.popup{
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%,-50%);
  background: #fff;
  width: 450px;
  height: 300px;
  box-shadow:0 25px 50px rgba(0,0,0,0.1),0 0 0 1000px rgba(255,255,255,0.95);
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 40px;
}
    </style>
</head>
<body>

        <div class="popup">
            <img src="./storage/<?=$_GET['avatar']?>" alt="">
            <h2>welcome <?= $_GET['name'] ?> </h2>
            <b id="close">X</b>
        </div>
        <canvas id="my-canvas"></canvas>
</body>
<script src="./assets/script/index.min.js"></script>
<script>
    var confettiSettings = { target: 'my-canvas' };
    var confetti = new ConfettiGenerator(confettiSettings);
    confetti.render();
    setTimeout(()=>window.location.href="./index.php",5000);
</script>
</body>
</html>