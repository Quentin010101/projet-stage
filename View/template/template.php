<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="./Public/css/general.css">
    <?php if(isset($pageCss)):
        ?>
        <link rel="stylesheet" href="<?php echo './Public/css/' . $pageCss; ?>">
        <?php
    endif;
    ?>
</head>
<body>
    
    <?php echo $pageContent; ?>

</body>
</html>