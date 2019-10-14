<?php


class ConsultaImovelController extends Controller
{
    private $dircontroller = './controller/consulta/';
    /**
     * Inicial
     */
    public function index()
    {
        $Cidades = Cidade::all();
        $arrayCidades = array();
        foreach ($Cidades as $cidade){
            $arrayCidades[$cidade->id] = $cidade;
        }
        return $this->view($this->dircontroller.'index', ['arrayCidades' => $arrayCidades]);
    }

    /**
     * buscaImovel
     */
    public function buscaImovel()
    {
        $data = array();
        if($this->request->cidade && $this->request->bairro) {
            $Cidade = Cidade::find($this->request->cidade['selected']);
            $Bairro = Bairro::find($this->request->bairro['selected']);
            $dados = array(
                'fields' => array("Codigo", "Categoria", "Bairro", "Cidade", "ValorVenda", "ValorLocacao", "Dormitorios", "Suites", "Vagas", "AreaTotal", "AreaPrivativa", "Caracteristicas", "InfraEstrutura", "FotoDestaquePequena", "FotoDestaque"),
                'filter' => array("Cidade" => array(str_replace(' ','+',$Cidade->nome)), "Bairro" => array(str_replace(' ','+',$Bairro->nome))),
                'order' => array("Bairro" => "asc"),
                'paginacao' => array("pagina" => 1, "quantidade" => 10)
            );

            $vistaSoftwareApi = new VistaSoftwareApi();
            $data = $vistaSoftwareApi->getImovelByCidadeBairro($dados);
            if(array_key_exists('status',$data)){
                $data = array();
            }
        }

        return $this->view($this->dircontroller.'listaImoveis', ['arrayImoveis' => $data]);
    }
}