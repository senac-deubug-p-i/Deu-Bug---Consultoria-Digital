<?php
require_once __DIR__ . '/../includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    encerrar_sessao();
}
redirecionar('pages/client/landingpage/index.php');
