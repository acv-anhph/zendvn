<?php
$model 	= new Model();
$cateID = null;
if(isset($this->arrParam['book_id'])){
    $bookID	= $this->arrParam['book_id'];
    $queryCate	= "SELECT `category_id` FROM `".BOOK_TABLE."` WHERE id = '$bookID'";
    $resultCate	= $model->fetchRow($queryCate);
    $cateID		= $resultCate['category_id'];
}else if(isset($this->arrParam['category_id'])){
    $cateID	= $this->arrParam['category_id'];
}

$query	= "SELECT `id`, `name` FROM `".CATEGORY_TABLE."` WHERE `status`  = 1 ORDER BY `ordering` ASC";

$listCats	= $model->fetchAll($query);

$xhtml		= '';
if(!empty($listCats)){
    foreach($listCats as $key => $value){
        $link	= URL::createLink('default', 'book', 'list', array('category_id' => $value['id']));
        $name	 = $value['name'];
        if($cateID == $value['id']){
            $xhtml	.= '<li><a class="active" title="'.$name.'" href="'.$link.'">'.$name.'</a></li>';
        }else{
            $xhtml	.= '<li><a title="'.$name.'" href="'.$link.'">'.$name.'</a></li>';
        }
    }
}
?>
<div class="right_box">

    <div class="title">
        <span class="title_icon"><img src="<?php echo $this->_dirImg; ?>/bullet5.gif" alt="" title="" /></span>Categories
    </div>

    <ul class="list">
        <?php echo $xhtml;?>
    </ul>
</div>
<div class="clear"></div>