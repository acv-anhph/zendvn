<?php

class Helper {
    
    public static function cmsButton($name, $id, $link, $icon, $type = 'new') {
        $xhtml = '<li class="button" id="' . $id . '">';
        
        switch ($type) {
            case 'new':
                $xhtml .= '<a class="modal" href="' . $link . '"><span class="' . $icon . '"></span>' . $name . '</a>';
                break;
            case 'submit':
                $xhtml .= '<a class="modal" href="javascript:void(0);" data-link="' . $link . '"><span class="' . $icon . '"></span>' . $name . '</a>';
                break;
        }
        
        $xhtml .= '</li>';
        
        return $xhtml;
    }
    
    public static function dateFormat($format, $date) {
        $result = '';
        if (!empty($date) && $date != '0000-00-00') {
            $result = date($format, strtotime($date));
        }
        
        return $result;
    }
    
    // Create Icon Status
    public static function cmsStatus($statusValue, $link, $id) {
        $strStatus = ($statusValue == 0) ? 'unpublish' : 'publish';
        
        $xhtml = '<a class="jgrid" id="status-' . $id . '" href="javascript:changeStatus(\'' . $link . '\');">
							<span class="state ' . $strStatus . '"></span>
						</a>';
        
        return $xhtml;
    }
    
    // Create Icon Group ACP
    public static function cmsGroupACP($groupAcpValue, $link, $id) {
        $strGroupACP = ($groupAcpValue == 0) ? 'unpublish' : 'publish';
        
        $xhtml = '<a class="jgrid" id="group-acp-' . $id . '" href="javascript:changeGroupACP(\'' . $link . '\');">
								<span class="state ' . $strGroupACP . '"></span>
							</a>';
        
        return $xhtml;
    }
    
    public static function cmsTitleSost($name, $column, $columnPost, $orderPost) {
        $img = '';
        $order = ($orderPost == 'desc') ? 'asc' : 'desc';
        if ($column == $columnPost) {
            $img = '<img src="' . TEMPLATE_URL . 'admin/main/images/admin/sort_' . $orderPost . '.png" alt="">';
        }
        $xhtml = '<a href="#" onclick="javascript:sortList(\'' . $column . '\',\'' . $order . '\')">' . $name . $img . '</a>';
        
        return $xhtml;
    }
    
    public static function cmsSelectBox($name, $class, $arrValue, $keySelect) {
        $xhtml = '<select name="' . $name . '" class="' . $class . '" >';
        foreach ($arrValue as $key => $value) {
            if ($key == $keySelect && is_numeric($keySelect)) {
                $xhtml .= '<option selected="selected" value = "' . $key . '">' . $value . '</option>';
            } else {
                $xhtml .= '<option value = "' . $key . '">' . $value . '</option>';
            }
        }
        $xhtml .= '</select>';
        
        return $xhtml;
    }
    
    // Create Message
    public static function cmsMessage($message) {
        $xhtml = '';
        if (!empty($message)) {
            $xhtml = '<dl id="system-message">
							<dt class="' . $message['class'] . '">' . ucfirst($message['class']) . '</dt>
							<dd class="' . $message['class'] . ' message">
								<ul>
									<li>' . $message['content'] . '</li>
								</ul>
							</dd>
						</dl>';
        }
        
        return $xhtml;
    }
    
    public static function cmsInput() {
        $xhtml = '';
        
        return $xhtml;
    }
}