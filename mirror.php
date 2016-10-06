<DOCTYPE! html>
<html>
<head>
    <meta charset="utf-8">
    <title>MyMagicMirror</title>
    <meta name="description" content="My Magic Mirror">
    <!-- <meta http-equiv="refresh" content="1800" /> -->
    <link rel="stylesheet" href="mirror.css" />
</head>
<body>
    <div class="upper-left">
        <div id="clock"></div>
    </div>
    <div class="upper-right">
        <div id="weather">
        <?php
            $json_string = file_get_contents("http://api.wunderground.com/api/". file_get_contents("key.php") . "/geolookup/conditions/forecast/q/New_Zealand/Upper_Hutt.json");
            $parsed_json = json_decode($json_string);
            $location = $parsed_json->{'location'}->{'city'};
            $temp_c = $parsed_json->{'current_observation'}->{'temp_c'};
            echo "<h1>"."${temp_c}"."&deg;C</h1><h2>"."${location}"."</h2>"; 
        ?>        
        </div>
    </div>
    <script>
        setInterval(function time(){
            var currentTime = new Date();
            var currentHours = currentTime.getHours();
            var currentMinutes = currentTime.getMinutes();
            var currentSeconds = currentTime.getSeconds();
            var currentMinutesLeadingZero = currentMinutes > 9 ? currentMinutes : '0' + currentMinutes;
            var currentDate = currentTime.getDate();

            var weekday = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"]
            var currentDay = weekday[currentTime.getDay()];

            var actualmonth = ["Januray","February","March","April","May","June","July","August","September","October","November","December"];
            var currentMonth = actualmonth[currentTime.getMonth()];

            var currentTimeString = '<div class="time"><h1>' + currentHours + ":" + currentMinutesLeadingZero + '</h1><h2>' + currentDay + " " + currentDate + " " + currentMonth + "</h2></div>";
            document.getElementById("clock").innerHTML = currentTimeString;
        }, 1000);
    </script>
</body>
</html>