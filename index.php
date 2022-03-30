<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Ice Cream Parlour Sales</title>
      <link href="/Line_Graph_PHP/icon.png" rel="icon" type="image/png">
  </head>
  <body style="background: linear-gradient(90deg, #f6e2fe, #71b7e6f0)">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="container pt-3">
      <h2 class="text-center"><b>Sales Report</b></h2>
      <div>
        <canvas id="myChart" height="100" weight="100"></canvas>
      </div>
    </div>
    <?php
    //Connecting to the Database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "salesreport";

    //Create a connection
    $conn = mysqli_connect($servername, $username, $password, $database);
    //Die if connection was not successful
    if (!$conn) {
      die("Sorry we failed to connect: ". mysqli_connect_error());
    }
    else{
      $sql = "SELECT * FROM `soldicecream`";
      $result = mysqli_query($conn, $sql);

      //Find the number of records returned
      $num = mysqli_num_rows($result);

      //Saving data from database to php arrays
      if($num> 0){
        for ($labels=array(), $ice=array(), $i=0; $row = mysqli_fetch_assoc($result); $i++) { 
          $labels[$i] = $row['day'];
          $ice[$i] = $row['icecream'];
        }
      }
    }
    ?>
    <script>
      var passedArray = <?php echo json_encode($labels); ?>;
      var element = <?php echo json_encode($ice); ?>;
      var ctx = document.getElementById("myChart").getContext('2d');
      var myChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: passedArray,
          datasets: [{
            label:'Number of Ice-Cream Sold',
            data: element,
            backgroundColor: "yellow"
          }]
        }
      })
    </script>
  </body>
</html>