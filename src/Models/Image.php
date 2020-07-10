<?php
namespace App\Models;

use App\Models\Base;

class Image extends Base
{
    public function add ($file,$massageId){

        if (!file_exists($file)) {
            return 0;
        }

        move_uploaded_file ($file, PROJECT_PATH . "/public_html/images/" . $massageId . ".jpg");

    }

}
