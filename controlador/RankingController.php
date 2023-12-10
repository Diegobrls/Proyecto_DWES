<?php
require_once __DIR__ . "/../modelo/Ranking.php";
require_once "Controller.php";

class RankingController extends Controller
{
    public function showRanking()
    {
        $rankingData = Ranking::getAllRanking();
        $idUsuarioActual = $_SESSION['idUsuario'];
        $usuarioActualData = Ranking::getRankingById($idUsuarioActual);
        $this->render("/ranking.php.twig", ["rankingData" => $rankingData, "usuarioActualData" => $usuarioActualData]);
    }
}