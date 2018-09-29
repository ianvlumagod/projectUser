<?php
    require_once("config.php");

    parse_str($_SERVER["QUERY_STRING"], $params);
    $id = $params["param"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="shortcut icon" type="image/x-icon" href="img/robLogo1.ico">
    <title>Robinsons Movieworld</title>
    <style>
* {
    box-sizing: border-box;
    heigth: 10%;    
}

.row::after {
    content: "";
    clear: both;
    display: table;
}
[class*="col-"] {
    float: left;
    padding: 15px;
}
.col-1 {width: 8.33%;}
.col-2 {width: 16.66%;}
.col-3 {width: 25%;}
.col-4 {width: 33.33%;}
.col-5 {width: 41.66%;}
.col-6 {width: 50%;}
.col-7 {width: 58.33%;}
.col-8 {width: 66.66%;}
.col-9 {width: 75%;}
.col-10 {width: 83.33%;}
.col-11 {width: 91.66%;}
.col-12 {width: 100%;}
html {
    font-family: "Lucida Sans", sans-serif;
}
.header {
    background-color: #9933cc;
    color: #ffffff;
    padding: 15px;
}
.menu ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
}
.menu li {
    padding: 8px;
    margin-bottom: 7px;
    background-color: #33b5e5;
    color: #ffffff;
    box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
}
.menu li:hover {
    background-color: #0099cc;
}
.col-9 h1{
    padding: 8px;
    margin-bottom: 7px;
    background-color: #f70800;
    color: #ffffff;
}

.col-9 p{
    padding: 8px;
    margin-bottom: 7px;
    color: #000000;
    font-size: 15px;
}

/* p.label {
    font-weight: bold;
} */

</style>
</head>

<body onload="startTime()">
    <banner>
        <div class="forBanner">
            <a href="index.php"><img class="logo" src="img/logo.png" style="height: 62px;"></a>
            <nav id="navBar">
                <ul>
                    <li><a href="#" style="color: yellow">SEE SCHEDULE</a>
                        <ul>
                            <li><a href="#" id="heh">DUMAGUETE</a></li>
                            <li><a href="#">CEBU</a></li>
                            <li><a href="#" id="heh">BACOLOD</a></li>
                            <li><a href="#">ILOCOS</a></li>
                            <li><a href="#" id="heh">CAGAYAN DE ORO</a></li>
                        </ul>
                    </li>    
                    <li><a href="nowShowing.php">NOW SHOWING</a></li>
                    <li><a href="advanceTicketSelling.php">ADVANCE TICKET SELLING</a></li>
                    <li><a href="comingSoon.php">COMING SOON</a></li>
                </ul> 
            </nav>
        </div>
    </banner>

    <div class="underBanner">
        <div class="timeBox">
            <span id="time"></span>
            |
            <span id="date"></span>
        </div>
        <div class="socialMedia">
            <ul>
                <li>
                    <a href="https://web.facebook.com/RobMovieworld/?_rdc=1&_rdr"><img class="socialMedia" src="img/facebook.png"></a>
                </li>
                <li>
                    <a href="https://www.instagram.com/robinsonsmovieworld/?hl=en"><img class="socialMedia" src="img/instagram.png"></a>
                </li>
                <li>
                    <a href="https://twitter.com/robmovieworld?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor"><img class="socialMedia" src="img/twitter.png"></a>
                </li>
            </ul>
        </div>
    </div>
    <section style="padding-bottom: 14.5%;">
        <div class="row">
            <div class='col-9'>
            
    <?php
        
        $sql = "SELECT * FROM movie WHERE idMovie = '$id'";
        if($result = mysqli_query($link, $sql)){
            if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);
                mysqli_free_result($result);
            } else{
                echo "No records matching your query were found.";
            }
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        } 
        echo "<div class='col-3 menu'>";
        echo "<ul>";
        echo "<img class='slideShow' src='" . $row['posterPath'] . "'>";
        echo "</ul>";
        echo "</div>";

        echo "<div class='col-9'>";
        echo "<h1>" . $row['movieTitle'] . "</h1>";
        echo "<p align='left'><b>MTRCB Rating:</b> " . $row['mtrcbRating'] . "</p>";
        echo "<p align='left'><b>Genre:</b> " . $row['genre'] . "</p>";
        echo "<p align='left'><b>Director:</b> " . $row['director'] . "</p>";
        echo "<p align='left'><b>Cast:</b> " . $row['cast'] . "</p>";
        echo "<p align='left'>" . $row['synopsis'] . "</p>";
        // echo "<p align='left'><b>Available in:</b> " . $row['mtrcbRating'] . "</p>";
        echo "</div>";
        // echo "<a href=''><img class='slideShow' src='" . $row['posterPath'] . "'></a>";
    ?>

        </div>
    </section>
    <!-- <div class="forFooter">
        <p>&copy;2013 Robinsons Movieworld</p>    
    </div> -->
</body>

<footer class="forFooter">
    <p>&copy;2013 Robinsons Movieworld</p>
</footer>

<script>
    const forDate = new Date();

    const months = ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'];

    let month = forDate.getMonth();
    let day = forDate.getDate();
    let year = forDate.getFullYear().toString();
    day = check1Digit(day);
    const date = months[month] + " " + day + ", " + year;
    
    document.getElementById('date').innerHTML = date;

    function startTime(){
        const forTime = new Date();
        let hour = forTime.getHours();
        let minute = forTime.getMinutes();
        let second = forTime.getSeconds();

        hour = check1Digit(hour);
        minute = check1Digit(minute);
        second = check1Digit(second);

        let time = hour + ":" + minute + ":" + second;
        document.getElementById('time').innerHTML = time;
        setInterval(startTime, 1000);
    }
    
    function check1Digit(digit){
        if(digit < 10){
            digit.toLocaleString();
            return "0"+digit;
        }
        else{
            return digit.toLocaleString();
        }
    }
</script>

</html>