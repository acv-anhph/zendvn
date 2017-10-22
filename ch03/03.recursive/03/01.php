<?php
$menu = array();
$menu[] = array('id' => 1, 'name' => 'home', 'parents' => 0);
$menu[] = array('id' => 2, 'name' => 'about', 'parents' => 0);
$menu[] = array('id' => 3, 'name' => 'new', 'parents' => 0);
$menu[] = array('id' => 4, 'name' => 'product', 'parents' => 0);
$menu[] = array('id' => 5, 'name' => 'contact', 'parents' => 0);
$menu[] = array('id' => 6, 'name' => 'tin trong nuoc', 'parents' => 3);
$menu[] = array('id' => 7, 'name' => 'tin nuoc ngoai', 'parents' => 3);
$menu[] = array('id' => 8, 'name' => 'cong nghe thong tin', 'parents' => 6);
$menu[] = array('id' => 9, 'name' => 'lap trinh', 'parents' => 6);
$menu[] = array('id' => 10, 'name' => 'IT', 'parents' => 7);
$menu[] = array('id' => 11, 'name' => 'programming', 'parents' => 7);
$menu[] = array('id' => 12, 'name' => 'software', 'parents' => 4);
$menu[] = array('id' => 13, 'name' => 'mobile', 'parents' => 4);
$menu[] = array('id' => 14, 'name' => 'anti virus', 'parents' => 12);
$menu[] = array('id' => 15, 'name' => 'nokia', 'parents' => 13);
$menu[] = array('id' => 16, 'name' => 'samsung', 'parents' => 13);
$menu[] = array('id' => 17, 'name' => 'S1', 'parents' => 16);
$menu[] = array('id' => 18, 'name' => 'S11', 'parents' => 17);


//echo '<pre>';
//print_r($menu);
//echo '</pre>';

function dequy($menu, $parent, $level, &$newArr = array()) {
    if (count($menu) > 0) {
        foreach ($menu as $key => $value) {
            if ($value['parents'] == $parent) {
                $value['level'] = $level;
                $newArr[] = $value;
                unset($menu[$key]);
                
                dequy($menu, $value['id'], $value['level'] + 1, $newArr);
            }
        }
    }
}

dequy($menu, 0, 1, $newArr);

foreach($newArr as $key => $value){
    if($value['level']==1){
        echo '<div style="border: 1px solid #ccc;">+' . $value['name'] . '</div>';
    }else {
        $padding = ($value['level'] - 1)*20;
        $padding = 'padding-left: '.$padding.'px;';
        echo '<div style="border: 1px solid #ccc;'.$padding.'">-' . $value['name'] . '</div>';
    }
}

?>


