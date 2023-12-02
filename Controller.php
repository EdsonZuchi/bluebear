<?php
    include("infra/Connection.php");
    require_once 'infra/repository/UserRepository.php';
    
    $userRepository = new UserRepository(findConnection());
    
?> 