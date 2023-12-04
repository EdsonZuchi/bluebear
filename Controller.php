<?php
    include("infra/Connection.php");
    require_once 'infra/repository/UserRepository.php';
    require_once 'infra/repository/FavoriteRepository.php';
    require_once 'infra/repository/CepRepository.php';
    require_once 'infra/ViaCEP.php';
    
    $userRepository = new UserRepository(findConnection());
    $cepRepository = new CepRepository(findConnection());
    $favoriteRepository = new FavoriteRepository(findConnection());
    $viaCep = new ViaCEP();

    $acao = "";
    $body = "";
    $dados = null;
    if (isset($_POST['acao'])) {
        $acao = $_POST['acao'];
        $body = file_get_contents('php://input');
        if (!empty($body)) {
            $dados = json_decode($body, true);
        }
        
    }
    if (isset($_GET['acao'])) {
        $acao = $_GET['acao'];
    }
    
    if($acao == 'CEP'){
        $cepParam = $_GET['cep'];
        $cep = intval(str_replace('-', '', $cepParam));
        $dados = $viaCep->getCep($cep);
        if($dados == null){
            echo 'CEP não encontrado';
            return;
        }
        $id_cep = $cepRepository->findByCep($cep);
        if($id_cep == null){
            $id_cep = $cepRepository->addCep($dados);
        }
        echo json_encode($dados);
        return;
    }

    if($acao == 'ALL'){
        $array = $cepRepository->fillAll();
        echo json_encode($array);
        return;
    }

    if($acao == 'DEL'){
        $id = $_GET['id'];
        $id_cep = intval($id);
        $cepRepository->deleteCep($id_cep);
        return;
    }
?>