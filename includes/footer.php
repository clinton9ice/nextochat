<?php
//Javascript
foreach (bottom_js as $js):
    if (is_array($js)){
        ?>
        <script type="application/javascript" src="<?= $js["url"]?>"></script>
    <?php } endforeach;?>

</body>
</html>
