<?php

include_once 'toolbar/index.php';
include_once 'submenu/index.php';

// Input
$dataForm 		= (!empty($this->arrParam['form'])) ? $this->arrParam['form'] : array();
echo '<pre>';
print_r($dataForm);
echo '</pre>';
$inputName		= Helper::cmsInput('text', 'form[name]', 'name', (!empty($dataForm['name'])) ? $dataForm['name'] : null, 'inputbox required', 40);
$inputOrdering	= Helper::cmsInput('text', 'form[ordering]', 'ordering', (!empty($dataForm['ordering'])) ? $dataForm['ordering'] : null, 'inputbox', 40);
$inputToken		= Helper::cmsInput('hidden', 'form[token]', 'token', time());
$selectStatus	= Helper::cmsSelectbox('form[status]', null, array('default' => '- Select status -', 1 => 'Publish', 0 => 'Unpublish'), (isset($dataForm['status'])) ? $dataForm['status'] : null, 'width: 150px');
$selectGroupACP	= Helper::cmsSelectbox('form[group_acp]', null, array('default' => '- Select group acp -', 1 => 'Yes', 0 => 'No'), (isset($dataForm['group_acp'])) ? $dataForm['group_acp'] : null, 'width: 150px');

$inputID		= '';
$rowID			= '';
if(isset($this->arrParam['form']['id'])){
    $inputID	= Helper::cmsInput('text', 'form[id]', 'id', $dataForm['id'], 'readonly');
    $rowID		= Helper::cmsRowForm('ID', $inputID);

}
// Row
$rowName		= Helper::cmsRowForm('Name', $inputName, true);
$rowOrdering	= Helper::cmsRowForm('Ordering', $inputOrdering);
$rowStatus		= Helper::cmsRowForm('Status', $selectStatus);
$rowGroupACP	= Helper::cmsRowForm('Group ACP', $selectGroupACP);

// MESSAGE
$errors = (!empty($this->errors)) ? $this->errors : '';
$message	= Session::get('message');
Session::delete('message');
$strMessage = Helper::cmsMessage($message);
?>
<div id="system-message-container"><?php echo $strMessage . $errors;?></div>
<div id="element-box">
    <div class="m">
        <form action="#" method="post" name="adminForm" id="adminForm" class="form-validate">
            <!-- FORM LEFT -->
            <div class="width-100 fltlft">
                <fieldset class="adminform">
                    <legend>Details</legend>
                    <ul class="adminformlist">
                        <?php echo $rowName . $rowStatus . $rowGroupACP . $rowOrdering . $rowID;?>
                    </ul>
                    <div class="clr"></div>
                    <div>
                        <?php echo $inputToken;?>
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
