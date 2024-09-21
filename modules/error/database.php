<?php
if(!defined('_INCODE')) die('Access deined');

?>
<div class="" style="width:600px; padding: 20px 30px; text-align: center;">
    <h3> Error relative to database</h3>
    <p> <?php echo $exception->getMessage(); ?></p>
    <p> <?php  echo $exception->getFile(); ?> </p>
    <p> <?php  echo $exception->getLine(); ?> </p>
</div>