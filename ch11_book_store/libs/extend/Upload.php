<?php

require_once SCRIPT_PATH . 'PhpThumb' . DS . 'ThumbLib.inc.php';

class Upload {

    public function uploadFile($fileObj, $folderUpload, $options = null){
        if($options == null){
            if($fileObj['tmp_name'] != null){
                $uploadDir		= UPLOAD_PATH . $folderUpload . DS;
                $fileName		= $this->randomString(8) . '.' . pathinfo($fileObj['name'], PATHINFO_EXTENSION);

                @copy($fileObj['tmp_name'], $uploadDir . $fileName);

                $thumb = PhpThumbFactory::create($uploadDir . $fileName);
                $thumb->adaptiveResize(60, 90);
                $thumb->save($uploadDir . '60x90-' . $fileName);

                return $fileName;
            }
        }
        return false;
    }

    public function removeFile($folderUpload, $fileName){
        $fileName	= UPLOAD_PATH . $folderUpload . DS . $fileName;
        if (file_exists($fileName)) {
            @unlink($fileName);
        }
    }

    private function randomString($length = 5){

        $arrCharacter = array_merge(range('a','z'), range(0,9));
        $arrCharacter = implode($arrCharacter, '');
        $arrCharacter = str_shuffle($arrCharacter);

        $result		= substr($arrCharacter, 0, $length);
        return $result;
    }
}