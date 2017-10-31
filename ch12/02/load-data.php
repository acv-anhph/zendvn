<?php
require_once 'function.php';

$filmData	= createData();

$position	= $_POST['position'];
$newArray	= getElements($filmData, $position, 4);

$xhtml = '';
if(!empty($newArray)){
$xhtml = '<div class="row film-info">';
    foreach($newArray as $key => $value){
    $xhtml .= '<div class="col-md-3">
        <div class="thumbnail">
            <img src="data/'.$value['image'].'" alt="'.$value['name'].'">
            <div class="caption">
                <h3>'.$value['name'].'</h3>
                <p>'.$value['year'].'</p>
            </div>
        </div>
    </div>';
    }
    $xhtml .= '</div>';
}
echo $xhtml;