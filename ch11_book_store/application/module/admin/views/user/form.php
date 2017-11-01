<?php

include_once (MODULE_PATH . 'admin/views/toolbar.php');
include_once (MODULE_PATH . 'admin/views/submenu.php');

// Input
$dataForm = (!empty($this->arrParam['form'])) ? $this->arrParam['form'] : array();

$inputUsername = Helper::cmsInput('text', 'form[username]', 'username', (!empty($dataForm['username'])) ? $dataForm['username'] : null, 'inputbox required', 40);
$inputEmail    = Helper::cmsInput('text', 'form[email]', 'email', (!empty($dataForm['email'])) ? $dataForm['email'] : null, 'inputbox required', 40);
$inputFullName = Helper::cmsInput('text', 'form[fullname]', 'fullname', (!empty($dataForm['fullname'])) ? $dataForm['fullname'] : null, 'inputbox', 40);
$inputPassword = Helper::cmsInput('text', 'form[password]', 'password', (!empty($dataForm['password'])) ? $dataForm['password'] : null, 'inputbox required', 40);
$inputOrdering = Helper::cmsInput('text', 'form[ordering]', 'ordering', (!empty($dataForm['ordering'])) ? $dataForm['ordering'] : null, 'inputbox', 40);
$inputToken    = Helper::cmsInput('hidden', 'form[token]', 'token', time());

$selectStatus = Helper::cmsSelectbox('form[status]', null, array(
    'default' => '- Select status -',
    1 => 'Publish',
    0 => 'Unpublish'
), (isset($dataForm['status'])) ? $dataForm['status'] : null, 'width: 150px');

$selectGroup = Helper::cmsSelectbox('form[group_id]', null, $this->selectbox, (isset($dataForm['group_id'])) ? $dataForm['group_id'] : null, 'width: 150px');

$inputID = '';
$rowID   = '';
if (isset($this->arrParam['form']['id'])) {
    $inputID = Helper::cmsInput('text', 'form[id]', 'id', $dataForm['id'], 'readonly');
    $rowID   = Helper::cmsRowForm('ID', $inputID);
}

// Row
$rowUsername = Helper::cmsRowForm('User name', $inputUsername, true);
$rowPassword = Helper::cmsRowForm('Password', $inputPassword, true);
$rowFullname = Helper::cmsRowForm('Full name', $inputFullName);
$rowEmail    = Helper::cmsRowForm('email', $inputEmail, true);
$rowOrdering = Helper::cmsRowForm('Ordering', $inputOrdering);
$rowStatus   = Helper::cmsRowForm('Status', $selectStatus);
$rowGroup    = Helper::cmsRowForm('Status', $selectGroup);

// MESSAGE
$errors  = (!empty($this->errors)) ? $this->errors : '';
$message = Session::get('message');
Session::delete('message');
$strMessage = Helper::cmsMessage($message);
?>
<div id="system-message-container"><?php echo $strMessage . $errors; ?></div>
<div id="element-box">
    <div class="m">
        <form action="#" method="post" name="adminForm" id="adminForm" class="form-validate">
            <!-- FORM LEFT -->
            <div class="width-100 fltlft">
                <fieldset class="adminform">
                    <legend>Details</legend>
                    <ul class="adminformlist">
                        <?php echo $rowUsername . $rowEmail . $rowPassword .$rowFullname . $rowStatus . $rowOrdering . $rowGroup . $rowID; ?>
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
