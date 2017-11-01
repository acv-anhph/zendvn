<?php
include_once (MODULE_PATH . 'admin/views/toolbar.php');

$column = array('id', 'email', 'fullname');
$dataForm 		= $this->arrParam['form'];
$dataForm = array_merge(array_flip($column), $dataForm);
echo '<pre>';
print_r($dataForm);
echo '</pre>';

// Input


$inputFullName	= Helper::cmsInput('text', 'form[username]', 'username', $dataForm['username'], 'inputbox required', 40);
$inputEmail		= Helper::cmsInput('text', 'form[email]', 'email', $dataForm['email'], 'inputbox required', 40);
$inputID	= Helper::cmsInput('text', 'form[id]', 'id', $dataForm['id'], 'inputbox readonly');

// Row
$rowEmail		= Helper::cmsRowForm('Email', $inputEmail, true);
$rowID			= Helper::cmsRowForm('ID', $inputID);
$rowFullName	= Helper::cmsRowForm('Full Name', $inputFullName);


// MESSAGE
$message	= Session::get('message');
Session::delete('message');
$strMessage = Helper::cmsMessage($message);
?>
<div id="system-message-container"><?php echo $strMessage;?></div>
<div id="element-box">
    <div class="m">
        <form action="#" method="post" name="adminForm" id="adminForm" class="form-validate">
            <!-- FORM LEFT -->
            <div class="width-100 fltlft">
                <fieldset class="adminform">
                    <legend>Details</legend>
                    <ul class="adminformlist">
                        <?php echo $rowEmail . $rowFullName . $rowID;?>
                    </ul>
                    <div class="clr"></div>
                </fieldset>
            </div>
            <div class="clr"></div>
            <div>
            </div>
        </form>
        <div class="clr"></div>
    </div>
</div>

