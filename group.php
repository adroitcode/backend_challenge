<html>

<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login_form.php");
} 

echo "<div>user_id: " . $_SESSION['user_id'] . "</div>";
echo "<a href='../backend_challenge/logout.php'>Logout</a>";

?>


<head>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src='../backend_challenge/script.js'></script>
    <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../backend_challenge/style.css">


    


</head>

<body>


    <h1>Group</h1>
    <select id="member_filter" class="selectbox">
        <option>All</option>
        <option>Week</option>
        <option>Month</option>
        <option>Year</option>
    </select>


    <table class='group' data-group_id='1' >

    </table>


</body>



<script>
    $( document ).ready(function () {
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');


        ga('create', 'UA-53884195-1', {
          // 'userId': <?php echo $_SESSION['user_id'] ?>,
          'cookieDomain': 'none'
        });

        //ga('set', 'dimension1', '<?php echo strval($_SESSION['user_id']); ?>');
        ga('send', 'pageview',{
          'dimension1': '<?php echo strval($_SESSION['user_id']); ?>'
        });
    });

</script>
</html>






