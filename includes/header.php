<?php include_once "config/config.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= $title ?></title>
    <?php //Meta tags
    foreach (meta as $tags):
        if (is_array($tags)) {
            ?>
            <meta <?= isset($tags["charset"]) ? 'charset="' . $tags["charset"] . '"' : "" ?>
                <?= isset($tags["name"]) ? 'name="' . $tags["name"] . '"' : "" ?>
                <?= isset($tags["content"]) ? 'content="' . $tags["content"] . '"' : "" ?>
                <?= isset($tags["http-equiv"]) ? 'http-equiv="' . $tags["http-equiv"] . '"' : "" ?>>
        <?php } endforeach; ?>

    <?php //Stylesheets
    foreach (stylesheets as $styles):
        if (is_array($styles)) {
            ?>
            <link rel="stylesheet" href="<?= $styles["url"] ?>">
        <?php } endforeach; ?>

    <?php
    //Javascript
    foreach (script as $js):
    if (is_array($js)){
        $type = !empty($js["type"]) and is_array($js["type"]) ? $js["type"] : "application/javascript"
    ?>
    <script type="<?= $type ?>" src="<?= $js["url"]?>"></script>
    <?php } endforeach;?>
</head>
