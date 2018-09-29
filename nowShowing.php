<?php
    require_once("config.php");
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
</head>

<body onload="startTime()">
    <banner>
        <div class="forBanner">
            <a href="index.php"><img class="logo" src="img/logo.png"></a>
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

    <section style="padding-bottom: 105.5px;">
        <p>NOW SHOWING</p>
        <div class="slideShowContainer">

            <?php
                $sql = "SELECT * FROM movie WHERE status LIKE '%1%'";
                if($result = mysqli_query($link, $sql)){
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_array($result)){
                                echo "<a href='movieDetails.php?param=" . $row['idMovie'] . "'>" . "<img class='slideShow' src='" . $row['posterPath'] . "'></a>";
                        }
                        mysqli_free_result($result);
                    } else{
                        echo "No records matching your query were found.";
                    }
                } else{
                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                } 
            ?>
            
        </div>
    </section>
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