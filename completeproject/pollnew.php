<html>
    <?php
    require('dbq.php');
    require('tbq.php');
    if (isset($_POST['submit'])) {
        $ip = $_SERVER['REMOTE_ADDR'];
        $ip = ip2long($ip);
        mysql_select_db('qadirdb');
        $ipaddr = "Select ip from pollingtab where ip=" . $ip;
        $con = mysql_connect('localhost', 'root', '');
        if (mysql_error($con)) {
            echo "Failed to conect" . mysql_error();
        }
        if ($_POST['submit']) {
            if (empty($_POST['p'])) {
                echo '<script type="text/javascript">alert("Select An Option please! "); </script>';
            } else {

                $a = $_POST['p'];
                $b = ("insert into pollingtab values('$a','$ip')");
                mysql_select_db('qadirdb');
                $r = mysql_query($b, $con);


                if (!$r) {
                    echo '<script type="text/javascript">alert("You Can Vote Only Once. "); </script>';
                } 
                $x = ("select * from pollingtab where YN='YES'");
                $y = mysql_query($x) or die(mysql_error());
                $count1 = mysql_num_rows($y);
                $m = ("select * from pollingtab where YN='NO'");
                $n = mysql_query($m) or die(mysql_error());
                $count2 = mysql_num_rows($n);
                $count3 = $count1 + $count2;
                $perc1 = $count1 / $count3;
                $perc2 = $count2 / $count3;
                $y = number_format(($perc1 * 100), 0);
                $n = number_format(($perc2 * 100), 0);
            }
        }
    }
    ?>
    <head>
        <link rel="stylesheet" type="text/css" href="css-graph.css" />
        <script type="text/javascript" src="jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="css-graph.js"></script>
        <script type="text/javascript">
        </script>
        <script type="text/javascript">
            var CSSGRAPH1_OPTIONS = {
                graph: 'myGraph1',
                type: 'horizontal',
                width: 150,
                height: 15,
                pattern: 'Screenshot from 2013-04-19 01:45:19.png',
                labels: "<b><?php echo $y; ?>%",
                data: '<?php echo $y; ?>',
                animate: true,
                start: 'bottom'
            }
            var CSSGRAPH2_OPTIONS = {
                graph: 'myGraph2',
                type: 'horizontal',
                width: 150,
                height: 15,
            
                pattern: 'Screenshot from 2013-04-19 01:46:31.png',
                labels: "<b><?php echo $n; ?>%",
                data: '<?php echo $n; ?>',
                animate: true,
                start: 'bottom'
            }
            jQuery(document).ready(function($) {	 
                $().cssgraph(CSSGRAPH1_OPTIONS);
                $().cssgraph(CSSGRAPH2_OPTIONS);
            });
        </script>
        <style>
            body
            {
                margin-left:200px;
                margin-right:200px;
                background:black;
            }
            #container
            {
                text-align:center;
                color:white;
            }
            #radio
            {
                text-align:left;
            }
            #result
            {	
                text-align:left;
            }
            #my
            {
                position:absolute;
                left:30%;
                right:33%;
                top:41.5%;
            }
            #my1
            {
                position:absolute;
                left:30%;
                right:33%;
                top:45.5%;	
            }	
            #center
            {
                margin-left:auto;
                margin-right:auto;
                width:700px;
                height:200px;
                background-color:grey;
                color:black;
                text-align:center;
                padding:50px;
            }
            #submit
            {
                text-align:left;
                position:absolute;
                left:25.5%;
                right:33%;
                top:49%;	
            }
        </style>
    </head>
    <body>
        <div id="container">
            <h1>This is my polling system</h1>
            <div id="center">
                <h2>This page is good or not?</h2>
                <div id="radio">
                    <form action="pollnew.php" method="POST">
                        <div>
                            <h3 align=center> Choose your option</h3>
                        </div>
                        <input type ="radio" name="p" value="YES" font color="red">YES<br>

                        <div id="myGraph1"></div><br>

                        <input type="radio" name="p" value="NO">NO<br>

                        <div id="myGraph2"></div><br>


                        <input  type="submit" name="submit" value="Vote"> 	

                        </div>
                        </div>
                    </form>




                    </body>
                    </html>
