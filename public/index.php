
<html>
    <head>
        <link rel="stylesheet" href="assets/css/styles.css"/>
    </head>
    <body>
        <h1> Supplement Shop </h1>
        <hr>
        <p> Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odio debitis dolores magnam modi porro accusamus commodi reiciendis quas? Nam eveniet sint obcaecati accusamus tempora odio numquam reiciendis quas eaque consequuntur. </p>
        
        <form method="post">
            <input type="submit" name="test" value="A Button!">
        </form>
    </body>
</html>

<?php
    if (array_key_exists('test', $_POST)){
        echo "Cliked!<br>";
    }
?>
