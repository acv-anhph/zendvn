<?php

$dataForm = array(
    'username' => '',
    'fullname' => '',
    'email' => '',
    'password' => '',
);

if (isset($this->arrParam['form'])) {
    $dataForm = array_merge($dataForm, $this->arrParam['form']);
}

$rowUsername = Helper::cmsRowFormPulic('Username', Helper::cmsInput('text', 'form[username]', 'username', $dataForm['username'], 'contact_input'));
$rowFullname = Helper::cmsRowFormPulic('Fullname', Helper::cmsInput('text', 'form[fullname]', 'fullname', $dataForm['fullname'], 'contact_input'));
$rowEmail    = Helper::cmsRowFormPulic('Email', Helper::cmsInput('text', 'form[email]', 'email', $dataForm['email'], 'contact_input'));
$rowPassword = Helper::cmsRowFormPulic('Password', Helper::cmsInput('text', 'form[password]', 'password', $dataForm['password'], 'contact_input'));
$rowSubmit   = Helper::cmsRowFormPulic('', Helper::cmsInput('hidden', 'form[token]', 'token', time(), '').Helper::cmsInput('submit', 'form[submit]', 'submit', 'Đăng ký', 'register'), true);
$actionForm  = URL::createLink('default', 'user', 'register');
$errors  = (!empty($this->errors)) ? $this->errors : '';
?>
<div class="left_content">
    <div class="title"><span class="title_icon"><img src="<?php echo $imgURL; ?>/bullet1.gif" alt="" title=""/></span>Đăng
        ký thành viên
    </div>

    <div class="feat_prod_box_details">
        <div class="contact_form">
            <div class="form_subtitle">create new account</div>
            <div id="system-message-container"><?php echo $errors; ?></div>
            <form name="register" action="<?php echo $actionForm;?>" method="post">
                <?php echo $rowUsername . $rowFullname . $rowEmail . $rowPassword . $rowSubmit; ?>
            </form>
        </div>
    </div>


    <div class="clear"></div>
</div><!--end of left content-->