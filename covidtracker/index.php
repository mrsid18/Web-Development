<?php
include 'logicx.php';
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/1d308a9b87.js" crossorigin="anonymous"></script>
    <title>Covid-19 Tracker</title>
</head>

<body> 


        <div class="container-fluid text-center bg-light p-4 mt-4" style="margin-right: 0!important; padding-right: 0!important;">
            <h2>Covid-19 Tracker</h2>
            <h5 class="text-muted">Stay Home Stay Safe</h5>
    
            <div class="row">
                <div class="col-md col-lg col-sm-6 text-danger card border-danger m-4 p-4">
                    <h4><strong>Confirmed</strong></h4>
                    <h6><?php echo $confirmed; ?></h6>
                </div>
                <div class="col-md col-lg col-sm-6 card text-primary border-primary m-4 p-4">
                    <h4><strong>Active</strong></h4>
                    <h6><?php echo $active; ?></h6>
                </div>
                <div class="col-md col-lg col-sm-6 card text-success border-success m-4 p-4">
                    <h4><strong>Recovered</strong></h4>
                    <h6><?php echo $recovered; ?></h6>
                </div>
                <div class="col-md col-lg col-sm-6 card text-secondary border-secondary m-4 p-4">
                    <h4><strong>Deceased</strong></h4>
                    <h6><?php echo $deceased; ?></h6>
                </div>
            </div>
        </div>
        
<div class="row">
    
    <div class="col-sm-6">
        <div class="container-fluid p-4 m-4 d-flex justify-content-center">
            <table class="table table-light table-hover">
                <thead>
                    <tr>
                        <th style="width: 25%">Countries</th>
                        <th style="width: 24%">Confirmed</th>
                        <th style="width: 17%">Active</th>
                        <th style="width: 17%">Recovered</th>
                        <th style="width: 17%">Deceased</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($data as $key => $value) {
                        $change = $value[$day]["confirmed"] - $value[$day - 1]["confirmed"];
                        $confirmed1=$value[$day]["confirmed"];
                        $deceased1=$value[$day]["deaths"];
                        $recovered1=$value[$day]["recovered"];
                        $active1 = $confirmed1 - $deceased1 - $recovered1;
                        echo ' <tr>
                            <td id="'.$key.'" onclick="showGraph(this.id)">' . $key . '</td>';
                        if ($change > 0) {
                            echo '<td>' . number_format($confirmed1) . '<i class="fas fa-arrow-up text-danger">' . ' ' . '</i><small class="text-danger">' . ' ' . number_format($change) . '</small></td>';
                        } else {
                            echo '<td>' . number_format($confirmed1) . '</td>';
                        }
                        echo '<td>' . number_format($active1) . '</td>
                            <td>' . number_format($recovered1) . '</td>
                            <td>' . number_format($deceased1) . '</td>
                </tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>


<div class="col-sm-6 container" id="chartsContainer" style="margin-right: 0!important;">
    <div class="row row-cols-1" style="padding-right: 0!important;">
    <div class="col chart" id="chart1"></div>
    <div class="col chart" id="chart2"></div>
    <div class="col chart" id="chart3"></div>
    <div class="col chart" id="chart4"></div>
    </div>
</div>
</div>
<a id="button"></a>
        <footer class="bg-light footer mt-auto py-3">

            <p class="text-center"><span class="text-muted">Copyright&copy;2020-21 Covid-19 Tracker</span></p>

        </footer>
        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

        <script src="index.js"></script>

        <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
</body>

</html>