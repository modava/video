<?php
\modava\video\assets\VideoAsset::register($this);
\modava\video\assets\VideoCustomAsset::register($this);
?>
<?php $this->beginContent('@backend/views/layouts/main.php'); ?>
<?php echo $content ?>
<?php $this->endContent(); ?>
