
<?php include'templet/header.php' ?>
<?php include'templet/topbar.php' ?>
<?php
if(!isset($_SESSION['username'])){
   echo "<script> document.location.href='../index.php' </script>";
}else{?>

<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
      <div class="panel-group">
        <div class="panel panel-default">
          <div class="panel-heading">Grafik Voting</div>
          <canvas id="myChart" width="50" height="20"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include'templet/footer.php' ?>

 <script  type="text/javascript">
   var ctx = document.getElementById('myChart').getContext('2d');

   var myChart = new Chart(ctx, {
    type: 'bar',
    data: {

      labels: [
      <?php 
      include '../koneksi.php';
      $query = mysqli_query($koneksi, "SELECT * FROM tb_kandidat");
      while($data = mysqli_fetch_array($query)):

        echo '"'.$data['nama_calon'].'",';

      endwhile
      ?>
      ],
      datasets: [{
        label: '# of Votes',
        data: [
        <?php 
        include '../koneksi.php';
        $query = mysqli_query($koneksi, "SELECT * FROM tb_kandidat");
        while($data = mysqli_fetch_array($query)):

          echo '"'.$data['suara'].'",';

        endwhile
        ?>
        ],
        backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)'
        ],
        borderColor: [
        'rgba(255, 99, 132, 1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
        ],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      }
    }
  });
</script>

<?php } ?>