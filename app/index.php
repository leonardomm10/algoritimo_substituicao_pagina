<?php

include 'execute.php';

$option = $_POST['optradio'];
$frames = $_POST['frames'];
$pages  = $_POST['pages'];

if (!(($option == "") || ($frames == "") || ($pages == ""))) {
  $execute = new Execute();
  $string = str_split($pages);
} else {
  $option = "";
  $msg = "Preencha todos os campos acima";
}
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
  <!-- Custom CSS -->
  <link rel="stylesheet" type="text/css" href="default.css">
  <!-- jQuery first -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
  <title>PLC</title>
</head>

<body>

  <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <div class="card w-100 h-30 text-white bg-dark" style="width: 18rem;">
      <div class="card-body">
        <div class="row">
          <div class="col-sm">
            <form method="POST" action="index.php">
              <h5>Algoritimo</h5>
              <hr>
              <div class="form-check">
                <label class="form-check-label" for="radio1">
                  <input type="radio" class="form-check-input" id="radio1" name="optradio" value="fifo" <?php if ($option == "fifo") echo "checked"; ?>>FIFO
                </label>
              </div>
              <div class="form-check">
                <label class="form-check-label" for="radio2">
                  <input type="radio" class="form-check-input" id="radio2" name="optradio" value="lru" <?php if ($option == "lru") echo "checked"; ?>>LRU
                </label>
              </div>
              <div class="form-check">
                <label class="form-check-label" for="radio3">
                  <input type="radio" class="form-check-input" id="radio3" name="optradio" value="otimo" <?php if ($option == "otimo") echo "checked"; ?>>Ótimo
                </label>
              </div>
              <div class="form-check">
                <label class="form-check-label" for="radio4">
                  <input type="radio" class="form-check-input" id="radio4" name="optradio" value="lifo" <?php if ($option == "lifo") echo "checked"; ?>>LIFO
                </label>
              </div>
          </div>
          <div class="col-sm">
            <h5>Quantidade de quadros</h5>
            <hr>
            <div class="form-group mx-sm-3 mb-2">
              <label for="frames">Digite a quantidade de quadros:</label>
              <input type="number" pattern="([0-9]|&#8734;)+" class="form-control" id="frames" name="frames" value="<?php echo $frames ?>">
            </div>
          </div>
          <div class="col-sm">
            <h5>Páginas</h5>
            <hr>
            <div class="form-group mx-sm-3 mb-2">
              <label for="pages">Digite as páginas:</label>
              <input type="text" pattern="([0-9]|&#8734;)+" class="form-control" id="pages" name="pages" value="<?php echo $pages ?>">
            </div>
            <br>
            <button type="submit" class="btn btn-primary float-right">Processar</button>
          </div>
          </form>
        </div>
      </div>
    </div>
    <hr>
    <div class="card w-100 h-30 text-white bg-dark" style="width: 18rem;">
      <div class="card-body">
        <h5>Algoritimo: <?php echo strtoupper($option); ?></h5>
        <hr>
        <table class="table table-sm table-bordered table-hover table-dark">
          <thead>
            <tr style="background-color:#181C1F">
              <?php
              for ($i = 0; $i < sizeof($string); $i++) {
                ?>
                <th scope="col"><?php echo $string[$i]; ?></th>
              <?php
              }
              ?>
            </tr>
          </thead>
          <tbody id="tableID">
            <?php
            switch ($option) {
              case "fifo":
                $execute->Fifo($string, $frames);
                break;
              case "lru":
                $execute->Lru($string, $frames);
                break;
              case "otimo":
                $execute->Otimo($string, $frames);
                break;
              case "lifo":
                $execute->Lifo($string, $frames);
                break;
              default:
                echo $msg;
                break;
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- Table JavaScript -->
  <script src="tableinverse.js"></script>
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
  </script>
</body>

</html>