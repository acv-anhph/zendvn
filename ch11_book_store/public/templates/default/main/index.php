<?php require_once TEMPLATE_PATH . 'default/main/html/header.php' ?>

<div class="center_content">
    <div class="left_content">
        <?php require_once MODULE_PATH . $this->_moduleName . DS . 'views' . DS . $this->_fileView . '.php'; ?>

        <div class="clear"></div>
    </div><!--end of left content-->

    <div class="right_content">
        <?php require_once BLOCK_PATH . 'language.php'; ?>
        <?php require_once BLOCK_PATH . 'cart.php'; ?>
        <?php require_once BLOCK_PATH . 'promotion.php'; ?>
        <?php require_once BLOCK_PATH . 'category.php'; ?>
    </div><!--end of right content-->
    <div class="clear"></div>
</div><!--end of center content-->

<?php require_once TEMPLATE_PATH . 'default/main/html/footer.php' ?>

