<?php
class ViaCEP{
    private $url="https://viacep.com.br/ws/";

    public function getCEP(int $cep)
    {
        $get = file_get_contents($this->url . $cep . "/json");
        $get = json_decode($get, true);

        return isset($get['cep']) ? $get : null;
    }
}
?>