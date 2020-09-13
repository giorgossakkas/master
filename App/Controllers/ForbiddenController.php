<?php

namespace App\Controllers;

use Core\View;

class ForbiddenController {

    public function forbidden()
    {
        View::render("forbidden.view.php");
    }

}
