<?php 
   require_once 'data.php';
   
   
    echo'

    

    <title>logout</title>

    </head>

    <body>';

    if (isset($_SESSION['user']))
    {
       
      destroySession();
      echo '<meta http-equiv="Refresh" content="0;url=login.php">';  
    }
    else
    {

    }

    echo'

    </body>

    </html>
    ';

    //mysqli_close($connection);

?>
