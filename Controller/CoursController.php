<?php
require_once __DIR__ . '/../model/cours.php';

class CoursController {
    private $model;

    public function __construct() {
        $this->model = new Cours();
    }

    public function index() {
        // Récupérer les données des cours via le modèle
        $cours = $this->model->getAllCours();

        // Inclure la vue en passant les données
        include __DIR__ . '/../view/front/courses.html';
    }
}

