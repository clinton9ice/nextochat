<?php
//Javascript
foreach (bottom_js as $js):
    if (is_array($js)){
        ?>
        <script  src="<?= $js["url"]?>"></script>
    <?php } endforeach;?>

</body>
</html>
