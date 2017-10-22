<?php

$newLink = URL::createLink('admin', 'group', 'add');
$newBtn = Helper::cmsButton('New', 'toolbar-popup-new', $newLink, 'icon-32-new');

$publishLink = URL::createLink('admin', 'group', 'status', array('type' => 1));
$publishBtn = Helper::cmsButton('Publish', 'toolbar-publish', $publishLink, 'icon-32-publish', 'submit');

$unpublishLink = URL::createLink('admin', 'group', 'status', array('type' => 0));
$unpublishBtn = Helper::cmsButton('Unpublish', 'toolbar-unpublish', $unpublishLink, 'icon-32-unpublish', 'submit');

$orderingLink = URL::createLink('admin', 'group', 'ordering');
$orderingBtn = Helper::cmsButton('Ordering', 'toolbar-checkin', $orderingLink, 'icon-32-checkin', 'submit');

$deleteLink = URL::createLink('admin', 'group', 'delete');
$deleteBtn = Helper::cmsButton('Trash', 'toolbar-trash', $deleteLink, 'icon-32-trash', 'submit');

$saveLink = URL::createLink('admin', 'group', 'index');
$saveBtn = Helper::cmsButton('Save', 'toolbar-apply', $saveLink, 'icon-32-apply', 'submit');

$saveAndCloseLink = URL::createLink('admin', 'group', 'index');
$saveAndCloseBtn = Helper::cmsButton('Save & Close', 'toolbar-save', $saveAndCloseLink, 'icon-32-save', 'submit');

$saveAndNewLink = URL::createLink('admin', 'group', 'index');
$saveAndNewBtn = Helper::cmsButton('Save & New', 'toolbar-save-new', $saveAndNewLink, 'icon-32-save-new', 'submit');

$cancelLink = URL::createLink('admin', 'group', 'index');
$cancelBtn = Helper::cmsButton('Cancel', 'toolbar-cancel', $cancelLink, 'icon-32-cancel');

$btns = '';

switch ($this->arrParam['action']) {
	case 'index':
		$btns = $newBtn . $publishBtn . $unpublishBtn . $orderingBtn .$deleteBtn;
		break;
    case 'form':
        $btns = $saveBtn . $saveAndCloseBtn . $saveAndNewBtn . $cancelBtn;
        break;
}
?>

<div id="toolbar-box">
    <div class="m">
        <!-- TOOLBAR -->
        <div class="toolbar-list" id="toolbar">
            <ul><?php echo $btns; ?></ul>
            <div class="clr"></div>
        </div>
        <!-- TITLE -->
        <div class="pagetitle icon-48-groups"><h2><?php echo $this->_title; ?></h2></div>
    </div>
</div>