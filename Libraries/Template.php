<?php

class Template
{

    public function printHeader(&$title)
    {
?>
        <!doctype html>
        <html lang="en">

        <head>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
            <link rel="stylesheet" href="../CSS/PersonalProjectCSS.css">
            <link href="https://fonts.googleapis.com/css?family=Playfair+Display&display=swap" rel="stylesheet">
            <title> <?= $title ?> </title>
        </head>

        <body>
            <div class="header">
                <ul class="">
                    <li><a class="active" href="#home">Home</a></li>

                    <li><a href="../Pages/signOut.php" class="signOut">Sign Out</a></li>
                </ul>
            </div>


        <?php
        $title = "Maintenance";
    }
    public static function showFooter($Request_Id = null)
    {
        ?>

            </div>
            <!-- Optional JavaScript -->
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

            <script>
                $(document).ready(function() {
                    $('#submitWeather').click(function() {
                        var city = $("#city").val();
                        if (city != '') {
                            $.ajax({
                                url: 'http://api.openweathermap.org/data/2.5/weather?q=' + city + "&units=imperial" + "&APPID=7a92f807b550de8f7359b14e7ef99a43",
                                type: "GET",
                                dataType: "jsonp",
                                success: function(data) {
                                    var widget = show(data);
                                    $("#show").html(widget);
                                    $("#city").val('');
                                    console.log(data);
                                }
                            });
                        } else {
                            $("#error").html("<div class='alert alert-danger' style='width:25%'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Field cannot be empty</div>");
                        }

                    });

                });
                window.onload = function() {
                    document.getElementById("submitWeather").click();
                };


                function show(data) {

                    return '<div class="moveRight">' +
                        "<h3>Current weather for:  " + data.name + "," + data.sys.country + "</h3>" +
                        "<h4><strong>Weather</strong>: " + data.weather[0].main + " </h4>" +
                        "<h4><strong>Description</strong>: <img src='http://openweathermap.org/img/wn/" + data.weather[0].icon + ".png'> " + data.weather[0].description + " </h4>" +
                        "<h4><strong>Temprature</strong>: " + data.main.temp + "&deg;F </h4>" +
                        "<h4><strong>Pressure</strong>: " + data.main.pressure + " </h4>" +
                        "<h4><strong>Humidity</strong>: " + data.main.humidity + "% </h4>" +
                        "<h4><strong>Minimum Temp</strong>: " + data.main.temp_min + "&deg;F </h4>" +
                        "<h4><strong>Max Temp</strong>: " + data.main.temp_max + "&deg;F </h4>" +
                        "<h4><strong>Wind Speed</strong>: " + data.wind.speed + " </h4>" +
                        "<h4><strong>Wind Direction</strong>: " + data.wind.deg + " </h4>" +
                        '</div>' +
                        '<br />' +
                        '<br />';
                }
            </script>

        </body>
        <div class="footer">

            Copyright &copy; 2020 Christen & Mitchell Property Managment


        </div>

        </html>
<?php
    }
}
