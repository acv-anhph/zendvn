<?php

include_once (MODULE_PATH . 'admin/views/toolbar.php');
include_once (MODULE_PATH . 'admin/views/submenu.php');

// Input
$dataForm = (!empty($this->arrParam['form'])) ? $this->arrParam['form'] : array();
$inputName      = Helper::cmsInput('text', 'form[name]', 'name', (!empty($dataForm['name'])) ? $dataForm['name'] : null, 'inputbox required', 40);
$inputDes       = '<textarea name="form[description]">';
$inputDes       .= (!empty($dataForm['name'])) ? $dataForm['name'] : '';
$inputDes       .= '</textarea>';
$inputPrice     = Helper::cmsInput('text', 'form[price]', 'price', (!empty($dataForm['price'])) ? $dataForm['price'] : null, 'inputbox required', 40);
$inputSaleOff   = Helper::cmsInput('text', 'form[sale_off]', 'sale_off', (!empty($dataForm['sale_off'])) ? $dataForm['sale_off'] : null, 'inputbox', 40);
$inputCategory  = Helper::cmsInput('text', 'form[category_id]', 'category_id', (!empty($dataForm['category_id'])) ? $dataForm['category_id'] : null, 'inputbox required', 40);
$inputOrdering  = Helper::cmsInput('text', 'form[ordering]', 'ordering', (!empty($dataForm['ordering'])) ? $dataForm['ordering'] : null, 'inputbox', 40);
$inputToken     = Helper::cmsInput('hidden', 'form[token]', 'token', time());

$selectStatus = Helper::cmsSelectbox('form[status]', null, array(
    'default' => '- Select status -',
    1 => 'Publish',
    0 => 'Unpublish'
), (isset($dataForm['status'])) ? $dataForm['status'] : null, 'width: 150px');

$selectSpecial = Helper::cmsSelectbox('form[special]', null, array(
    'default' => '- Select special -',
    1 => 'Yes',
    0 => 'No'
), (isset($dataForm['special'])) ? $dataForm['special'] : null, 'width: 150px');

$selectCategory = Helper::cmsSelectbox('form[category_id]', null, $this->category, (isset($dataForm['category_id'])) ? $dataForm['category_id'] : null, 'width: 150px');
$inputPicture		= Helper::cmsInput('file', 'picture', 'picture', (!empty($dataForm['picture'])) ? $dataForm['picture'] : null, 'inputbox', 40);

$inputID        = '';
$rowID          = '';
$picture		= '';
$inputPictureHidden = '';

if (isset($this->arrParam['form']['id'])) {
    $inputID = Helper::cmsInput('text', 'form[id]', 'id', $dataForm['id'], 'readonly');
    $rowID   = Helper::cmsRowForm('ID', $inputID);
    $picture		= '<img src="'.UPLOAD_URL . 'book' . DS . '98x150-' . $dataForm['picture'].'">';
    $inputPictureHidden	= Helper::cmsInput('hidden', 'form[picture_hidden]', 'picture_hidden', (!empty($dataForm['picture'])) ? $dataForm['picture'] : null, 'inputbox', 40);
}

// Row
$rowName        = Helper::cmsRowForm('Name', $inputName, true);
$rowPicture		= Helper::cmsRowForm('Picture', $inputPicture . $picture . $inputPictureHidden);
$rowDes         = Helper::cmsRowForm('Description', $inputDes, true);
$rowPrice       = Helper::cmsRowForm('Price', $inputPrice, true);
$rowSaleOff     = Helper::cmsRowForm('Sale off', $inputSaleOff);
$rowOrdering    = Helper::cmsRowForm('Ordering', $inputOrdering);
$rowStatus      = Helper::cmsRowForm('Status', $selectStatus);
$rowCategory    = Helper::cmsRowForm('Category', $selectCategory);
$rowSpecial     = Helper::cmsRowForm('Special', $selectSpecial);


// MESSAGE
$errors  = (!empty($this->errors)) ? $this->errors : '';
$message = Session::get('message');
Session::delete('message');
$strMessage = Helper::cmsMessage($message);
?>
<div id="system-message-container"><?php echo $strMessage . $errors; ?></div>
<div id="element-box">
    <div class="m">
        <form action="#" method="post" name="adminForm" id="adminForm" class="form-validate" enctype="multipart/form-data">
            <!-- FORM LEFT -->
            <div class="width-100 fltlft">
                <fieldset class="adminform">
                    <legend>Details</legend>
                    <ul class="adminformlist">
                        <?php echo $rowName . $rowPicture . $rowDes . $rowPrice . $rowSaleOff . $rowOrdering . $rowStatus . $rowCategory . $rowSpecial; ?>
                    </ul>
                    <div class="clr"></div>
                    <div>
                        <?php echo $inputToken; ?>
                    </div>
                </fieldset>
            </div>
            <div class="clr"></div>
            <div>
            </div>
        </form>
        <div class="clr"></div>
    </div>
</div>
