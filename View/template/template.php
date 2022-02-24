<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/general.css" type="text/css">
    <link rel="stylesheet" href="css/header-footer.css" type="text/css">
    <?php if (isset($pageCss)) :
    ?>
        <link rel="stylesheet" type="text/css" href="<?php echo 'css/' . $pageCss; ?>">
    <?php
    endif;
    ?>
    <?php if (isset($pageScript)) :
        foreach ($pageScript as $script) :
    ?>
            <script src="<?php echo 'js/' . $script; ?>"></script>
    <?php
        endforeach;
    endif;
    ?>
</head>

<body>

    <?php echo $pageContent; ?>

</body>

</html>