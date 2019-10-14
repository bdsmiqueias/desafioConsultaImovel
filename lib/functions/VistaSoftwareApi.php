<?php


class VistaSoftwareApi
{
    public $key = '';
    public $url = '';

    public function __construct()
    {
        $this->key = 'c9fdd79584fb8d369a6a579af1a8f681';
        $this->url = 'http://sandbox-rest.vistahost.com.br/reloadcache?key=' . $this->key;
    }

    /**
     * Inicial
     */
    public function getImovelByCidadeBairro($dados)
    {


        $postFields  =  json_encode( $dados , JSON_UNESCAPED_UNICODE);
        $url         =  'http://sandbox-rest.vistahost.com.br/imoveis/listar?key=' . $this->key;
        $url        .=  '&pesquisa=' . $postFields;

        $ch = curl_init($url);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch, CURLOPT_HTTPHEADER , array( 'Accept: application/json' ) );
        $result = curl_exec( $ch );
        if(curl_exec($ch) === false)
        {
            echo 'Curl error: ' . curl_error($ch);
        }

        $result = json_decode( $result, true );

        return $result;
    }
}