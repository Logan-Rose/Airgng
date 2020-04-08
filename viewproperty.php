<html>
    <head>
      <link rel="stylesheet" href="home1.css">
    </head>
    <body>
        <div id="main" class="mainCenter">
            <?php
                session_start();
                $mail = $_SESSION['mail'];
                $uid =  $_SESSION['user_id'];
                $conn_string = $_SESSION['connString'];

                $dbconn = pg_connect($conn_string) or die('Connection failed');
                $q = "SELECT *
                      FROM property p
                      WHERE p.user_id = '$uid'";
                $stmt = pg_prepare($dbconn,"pt",$q);
                $result = pg_query($dbconn,$q);
                echo "
                <col>
                <col>
                <colgroup span = '7'></colgroup>
                <FORM method = 'POST' action = '/deleteProp-Host.php' id = 'form1'>
                <table id='resultable'>
                <thead>
                    <th>
                        Image
                    </th>
                    <th id='resultheader'>
                        Address
                    </th>
                    <th id='resultheader'>
                        Property Type
                    </th>
                    <th id='resultheader'>
                        Room Type
                        </th>
                    <th id='resultheader'>
                        # of Bedrooms
                    </th>
                    <th id='resultheader'>
                        # of Bathooms
                    </th>
                    <th id='resultheader'>
                        Delete
                    </th>
                </thead>
                <tbody>"
                ;
                while($row = pg_fetch_row($result)){

                    echo "<tr>";
                    $im = "SELECT image FROM property_image WHERE  property_id = ${row[0]}";
                    $res = pg_query($dbconn,$im);
                    if (pg_affected_rows($res) == 0){
                        echo 
                        "<tr>
                          <td id='resultimg'><img class = 'zoom' src = '/images/default.jpeg' heigt = '84' width = '84'/>";
                    }else{
                        echo 
                        "<tr>
                              <td id='resultimg'><img class = 'zoom' src = '/images/" . pg_fetch_result($res, 0)    .
                        "' heigt = '84' width = '84'/></td>";
                    }
                    echo "
                    <td id='resultdata'>"        . $row[1] . 
                    "</td><td id='resultdata'>" . $row[2] . 
                    "</td><td id='resultdata'>" . $row[3] . 
                    "</td><td id='resultdata'>" . $row[5] . 
                    "</td><td id='resultdata'>" . $row[4] .
                    "<tfoot><tr> <br></tr><td colspan = '1' scope = 'colgroup'> Description:</td> 
                    <td colspan = '6' scope ='colgroup'>".$row[6]."</td></tfoot>"
                    "</td><td><input type = 'submit' name = '${row[0]}' value= 'Delete'></td>"; 
                    echo "</tr>";
                }
                echo "</tbody></table></FORM>";
            ?>
            <br>
        </div>
    </body>
</html>
