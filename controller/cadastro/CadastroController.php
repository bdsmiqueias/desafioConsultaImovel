<?php


class CadastroController extends Controller
{
    private $dircontroller = './controller/cadastro/';


    /**
     * Monta formulários para cadastro das Cidades e Bairros
     */
    public function criar()
    {
        $Cidades = Cidade::all();
        return $this->view($this->dircontroller.'form', ['arrayCidades' => $Cidades,'bairro' => null,'cidade' => null ]);
    }

    /**
     * Salvar os cadastros
     */
    public function salvar()
    {
        try{
            $cadastro_completo = true;

            if($this->request->cidade){
                if(!$this->request->cidade['selected']) {
                    $cidade = new Cidade();
                    $cidade->nome = $this->request->cidade['nome'];
                    $cidade->uf = $this->request->cidade['uf'];

                    $cidadeObj = $cidade->save();
                }else{
                    $cidadeObj = $this->request->cidade['selected'];
                }
                if($cidadeObj && $this->request->bairro){
                    $bairro = new Bairro();
                    $bairro->nome = $this->request->bairro['nome'];
                    $bairro->id_cidade = $cidadeObj;

                    $bairroObj = $bairro->save();

                    if($bairroObj){
                        $mensagem = 'Cadastros efetuados com sucesso!';
                        header('Location: /?controller=ConsultaImovelController&method=index&mess='.$mensagem.'&status=positive');
                    }else{
                        $cadastro_completo = false;
                    }
                }else{
                    $cadastro_completo = false;
                }
            }
        }catch (Exception $e){
            $mensagem = $e->getMessage();
            header('Location: /?controller=ConsultaImovelController&method=index&mess="' . $mensagem . '"&status=error');
        }
        if(!$cadastro_completo) {
            $mensagem = 'Cadastro não efetuado!';
            header('Location: /?controller=ConsultaImovelController&method=index&mess="' . $mensagem . '"&status=error');
        }
    }
}