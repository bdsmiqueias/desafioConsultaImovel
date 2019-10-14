<?php


class CidadeController extends Controller
{
    private $dircontroller = './controller/cidade/';
    /**
     * Lista os Cidades
     */
    public function listar()
    {
        $cidades = Cidade::all();
        return $this->view($this->dircontroller.'index', ['arrayCidades' => $cidades]);
    }
    /**
     * Mostrar formulario
     */
    public function criar()
    {
        return $this->view($this->dircontroller.'form');
    }
    /**
     * Mostrar formulário
     */
    public function editar($dados)
    {
        $id      = (int) $dados['id'];
        $cidade = Cidade::find($id);
        return $this->view($this->dircontroller.'form', ['cidade' => $cidade]);
    }
    /**
     * Salvar o Cidade
     */
    public function salvar()
    {
        try{
            $cidade           = new Cidade;
            $cidade->nome     = $this->request->nome;
            $cidade->uf = $this->request->uf;
            if ($cidade->save()) {
                header('Location: /?controller=CidadeController&method=listar&mess="Cadastrado com sucesso"&status=positive');
            }
        }catch (Exception $e){
            $mensagem = $e->getMessage();
            header('Location: /?controller=CidadeController&method=listar&mess="' . $mensagem . '"&status=error');
        }
    }
    /**
     * Atualizar o Cidade
     */
    public function atualizar($dados)
    {
        try{
            $id                = (int) $dados['id'];
            $cidade           = Cidade::find($id);
            $cidade->nome     = $this->request->nome;
            $cidade->uf = $this->request->uf;
            $cidade->save();
            header('Location: /?controller=CidadeController&method=listar&mess="Atualizado com sucesso"&status=positive');
        }catch (Exception $e){
            $mensagem = $e->getMessage();
            header('Location: /?controller=CidadeController&method=listar&mess="' . $mensagem . '"&status=error');
        }
    }
    /**
     * Apagar um Cidade
     */
    public function excluir($dados)
    {
        try{
            $id      = (int) $dados['id'];
            $cidade = Cidade::delete($id);
            header('Location: /?controller=CidadeController&method=listar&mess="Excluído com sucesso"&status=positive');
        }catch (Exception $e){
            $mensagem = $e->getMessage();
            header('Location: /?controller=CidadeController&method=listar&mess="' . $mensagem . '"&status=error');
        }
    }
}