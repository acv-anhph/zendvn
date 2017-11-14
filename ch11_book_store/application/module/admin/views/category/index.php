<?php

include_once (MODULE_PATH . 'admin/views/toolbar.php');
include_once (MODULE_PATH . 'admin/views/submenu.php');

$columnPost     = !empty($this->arrParam['filter-column']) ? $this->arrParam['filter-column'] : '';
$orderPost      = !empty($this->arrParam['filter-column-dir']) ? $this->arrParam['filter-column-dir'] : '';
$keyword        = !empty($this->arrParam['filter_search']) ? $this->arrParam['filter_search'] : '';
$filterState    = isset($this->arrParam['filter_state']) ? $this->arrParam['filter_state'] : 'default';
$lblName        = Helper::cmsTitleSost('Name', 'name', $columnPost, $orderPost);
$lblPicture		= Helper::cmsTitleSost('Picture', 'picture', $columnPost, $orderPost);
$lblStatus      = Helper::cmsTitleSost('Status', 'status', $columnPost, $orderPost);
$lblOrdering    = Helper::cmsTitleSost('Ordering', 'ordering', $columnPost, $orderPost);
$lblCreated     = Helper::cmsTitleSost('Created', 'created', $columnPost, $orderPost);
$lblCreatedBy   = Helper::cmsTitleSost('Created By', 'created_by', $columnPost, $orderPost);
$lblModified    = Helper::cmsTitleSost('Modified', 'modified', $columnPost, $orderPost);
$lblModifiedBy  = Helper::cmsTitleSost('Modified By', 'modified_by', $columnPost, $orderPost);
$lblID = Helper::cmsTitleSost('ID', 'id', $columnPost, $orderPost);

//filter
$arrStatus			= array('default' => '- Select Status -', 1 => 'Publish',  0 => 'Unpublish');
$selectboxStatus	= Helper::cmsSelectBox('filter_state', 'inputbox', $arrStatus, $filterState);

//pagination
$pagination = $this->pagination->showPagination(URL::createLink('admin', 'category', 'index'));

//message
$message = '';
if (isset($_SESSION['message'])) {
    $message = Helper::cmsMessage($_SESSION['message']);
    Session::delete('message');
}

?>

<div id="system-message-container">
    <?php echo $message; ?>
</div>

<div id="element-box">
    <div class="m">
        <div class="clr"></div>

        <form action="#" method="post" name="adminForm" id="adminForm">
            <!-- FILTER -->
            <fieldset id="filter-bar">
                <div class="filter-search fltlft">
                    <label class="filter-search-lbl" for="filter_search">Filter:</label>
                    <input type="text" name="filter_search" id="filter_search" value="<?php echo $keyword; ?>">
                    <button type="button" name="submit-keyword">Search</button>
                    <button type="button" name="clear-keyword">Clear</button>
                </div>
                <div class="filter-select fltrt">
                    <?php echo $selectboxStatus;?>
                </div>
            </fieldset>
            <div class="clr"></div>

            <table class="adminlist" id="modules-mgr">
                <!-- HEADER TABLE -->
                <thead>
                    <tr>
                        <th width="1%"><input type="checkbox" name="checkall-toggle"></th>
                        <th class="title"><?php echo $lblName; ?></th>
                        <th width="10%"><?php echo $lblPicture; ?></th>
                        <th width="10%"><?php echo $lblStatus; ?></th>
                        <th width="10%"><?php echo $lblOrdering; ?></th>
                        <th width="10%"><?php echo $lblCreated; ?></th>
                        <th width="10%"><?php echo $lblCreatedBy; ?></th>
                        <th width="10%"><?php echo $lblModified; ?></th>
                        <th width="10%"><?php echo $lblModifiedBy; ?></th>
                        <th width="1%" class="nowrap"><?php echo $lblID; ?></th>
                    </tr>
                </thead>
                <!-- FOOTER TABLE -->
                <tfoot>
                    <tr>
                        <td colspan="10">
                            <!-- PAGINATION -->
                            <div class="container">
                                <?php echo $pagination; ?>
                            </div>
                        </td>
                    </tr>
                </tfoot>
                <!-- BODY TABLE -->
                <tbody>
                    
                    <?php
                    
                    if (!empty($this->categoryList)):
                        foreach ($this->categoryList as $key => $item):
                            $i = ($key % 2 == 0) ? 'row0' : 'row1';
                            $id = $item['id'];
                            $name = $item['name'];
                            $ordering = $item['ordering'];
                            $name = $item['name'];
                            $picturePath	= UPLOAD_PATH . 'category' . DS . '60x90-' . $item['picture'];
                            $picture = (file_exists($picturePath)==true) ? '<img src="'.UPLOAD_URL . 'category' . DS . '60x90-' . $item['picture'].'">' : '' ;
                            $createdAt = Helper::dateFormat('d-m-y', $item['created']);
                            $createdBy = $item['created_by'];
                            $modifiedAt = Helper::dateFormat('d-m-y', $item['modified']);
                            $modifiedBy = $item['modified_by'];
    
                            $ordering   = '<input type="text" class="text-area-order" name="order[' . $id . ']" value="' . $item['ordering'] . '">';
                            $checkboxStr = '<input type="checkbox" id="' . $id . '" name="cid[]" value="' . $id . '">';
                            $linkStt = URL::createLink('admin', 'category', 'ajaxStatus', array('id' => $id, 'status' => $item['status']));
                            $statusStr = Helper::cmsStatus($item['status'], $linkStt, $id);

                            $linkEditCategory = URL::createLink('admin', 'category', 'form', array('id' => $id));
                            
                            ?>
                            <tr class="<?php echo $i; ?>">
                                <td class="center"><?php echo $checkboxStr; ?></td>
                                <td class="center"><a href="<?php echo $linkEditCategory; ?>"><?php echo $name; ?></a></td>
                                <td class="center"> <?php echo $picture; ?></td>
                                <td class="center"> <?php echo $statusStr; ?></td>
                                <td class="center"> <?php echo $ordering; ?></td>
                                <td class="center"> <?php echo $createdAt; ?></td>
                                <td class="center"> <?php echo $createdBy; ?></td>
                                <td class="center"> <?php echo $modifiedAt; ?></td>
                                <td class="center"> <?php echo $modifiedBy; ?></td>
                                <td class="center"> <?php echo $id; ?></td>

                            </tr>
                        <?php endforeach; endif; ?>
                </tbody>
            </table>


            <div>
                <input type="hidden" name="filter-column" value="">
                <input type="hidden" name="filter-page" value="1">
                <input type="hidden" name="filter-column-dir" value="">
        </form>
    </div>
</div>
