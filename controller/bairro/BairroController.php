<?php


class BairroController extends Controller
{
    private $dircontroller = './controller/bairro/';

    public function ajaxAll(){

        $arrayBairros = array();
        if($this->request->id_cidade) {
            $Bairros = Bairro::findByCidade($this->request->id_cidade);
            if($Bairros){
                foreach ($Bairros as $bairro){
                    $arrayBairros[] = array(
                        'id' => $bairro->id,
                        'nome' => $bairro->nome,
                        'id_cidade' => $bairro->id_cidade,
                    );
                }
            }
        }

        $this->jsonResponse(json_encode($arrayBairros));
    }

    /**
     * Lista os bairros
     */
    public function listar()
    {
        $cidades = Cidade::all();

        $arrayBairroCidades = array();
        foreach ($cidades as $cidade){
            $arrayBairroCidades[$cidade->id]['cidade'] = $cidade;

            $bairros = Bairro::findByCidade($cidade->id);
            foreach ($bairros as $bairro){
                $arrayBairroCidades[$cidade->id]['bairros'][] = $bairro;
            }
        }
        return $this->view($this->dircontroller.'index', ['arrayBairroCidades' => $arrayBairroCidades]);
    }
    /**
     * Mostrar formulario
     */
    public function criar()
    {
        $cidades = Cidade::all();
        return $this->view($this->dircontroller.'form', ['arrayCidades' => $cidades]);
    }
    /**
     * Mostrar formulário
     */
    public function editar($dados)
    {
        $id      = (int) $dados['id'];
        $bairro = Bairro::find($id);
        $cidades = Cidade::all();
        return $this->view($this->dircontroller.'form', ['bairro' => $bairro, 'arrayCidades' => $cidades]);
    }
    /**
     * Salvar o bairro
     */
    public function salvar()
    {
        try{
            $bairro           = new Bairro;
            $bairro->nome     = $this->request->nome;
            $bairro->id_cidade = $this->request->id_cidade;
            if ($bairro->save()) {
                header('Location: /?controller=BairroController&method=listar&mess="Cadastrado com sucesso"&status=positive');
            }
        }catch (Exception $e){
            $mensagem = $e->getMessage();
            header('Location: /?controller=BairroController&method=listar&mess="' . $mensagem . '"&status=error');
        }
    }
    /**
     * Atualizar o bairro
     */
    public function atualizar($dados)
    {
        try{
        $id                = (int) $dados['id'];
        $bairro           = Bairro::find($id);
        $bairro->nome     = $this->request->nome;
        $bairro->id_cidade = $this->request->id_cidade;
        $bairro->save();
            header('Location: /?controller=BairroController&method=listar&mess="Atualizado com sucesso"&status=positive');
        }catch (Exception $e){
            $mensagem = $e->getMessage();
            header('Location: /?controller=BairroController&method=listar&mess="' . $mensagem . '"&status=error');
        }
    }
    /**
     * Apagar um bairro
     */
    public function excluir($dados)
    {
        try{
        $id      = (int) $dados['id'];
        $bairro = Bairro::delete($id);
            header('Location: /?controller=BairroController&method=listar&mess="Excluído com sucesso"&status=positive');
        }catch (Exception $e){
            $mensagem = $e->getMessage();
            header('Location: /?controller=BairroController&method=listar&mess="' . $mensagem . '"&status=error');
        }
    }
}