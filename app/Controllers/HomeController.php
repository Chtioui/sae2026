<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\HomeModel;

class HomeController {
    public function index(): void {
        $model = new HomeModel();
        $message = $model->getMessage();

        require_once __DIR__ . '/../Views/home.html';
    }
}
