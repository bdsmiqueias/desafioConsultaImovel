<?php


class Cidade
{
    private $atributos;
    public function __construct()
    {
    }
    public function __set($atributo, $valor)
    {
        $this->atributos[$atributo] = $valor;
        return $this;
    }
    public function __get($atributo)
    {
        return $this->atributos[$atributo];
    }
    public function __isset($atributo)
    {
        return isset($this->atributos[$atributo]);
    }
    /**
     * Salvar o cidade
     * @return boolean
     */
    public function save()
    {
        $colunas = $this->preparar($this->atributos);
        if (!isset($this->id)) {
            $query = "INSERT INTO cidade (".
                implode(', ', array_keys($colunas)).
                ") VALUES (".
                implode(', ', array_values($colunas)).");";
        } else {
            foreach ($colunas as $key => $value) {
                if ($key !== 'id') {
                    $definir[] = "{$key}={$value}";
                }
            }
            $query = "UPDATE cidade SET ".implode(', ', $definir)." WHERE id='{$this->id}';";
        }
        if ($conexao = Conexao::getInstance()) {
            $stmt = $conexao->prepare($query);
            if ($stmt->execute()) {
                return $conexao->lastInsertId();
            }
        }
        return false;
    }
    /**
     *
     * @param type $dados
     * @return string
     */
    private function escapar($dados)
    {
        if (is_string($dados) & !empty($dados)) {
            return "'".addslashes($dados)."'";
        } elseif (is_bool($dados)) {
            return $dados ? 'TRUE' : 'FALSE';
        } elseif ($dados !== '') {
            return $dados;
        } else {
            return 'NULL';
        }
    }
    /**
     *
     * @param array $dados
     * @return array
     */
    private function preparar($dados)
    {
        $resultado = array();
        foreach ($dados as $k => $v) {
            if (is_scalar($v)) {
                $resultado[$k] = $this->escapar($v);
            }
        }
        return $resultado;
    }
    /**
     *
     * @return array/boolean
     */
    public static function all()
    {
        $conexao = Conexao::getInstance();
        $stmt    = $conexao->prepare("SELECT * FROM cidade ORDER BY nome asc");
        $result  = array();
        if ($stmt->execute()) {
            while ($rs = $stmt->fetchObject(Cidade::class)) {
                $result[] = $rs;
            }
        }
        if (count($result) > 0) {
            return $result;
        }
        return array();
    }
    /**
     *
     * @return int/boolean
     */
    public static function count()
    {
        $conexao = Conexao::getInstance();
        $count   = $conexao->exec("SELECT count(*) FROM cidade;");
        if ($count) {
            return (int) $count;
        }
        return false;
    }
    /**
     *
     * @param type $id
     * @return type
     */
    public static function find($id)
    {
        $conexao = Conexao::getInstance();
        $stmt    = $conexao->prepare("SELECT * FROM cidade WHERE id='{$id}';");
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                $resultado = $stmt->fetchObject('Cidade');
                if ($resultado) {
                    return $resultado;
                }
            }
        }
        return false;
    }
    /**
     *
     * @param type $id
     * @return boolean
     */
    public static function delete($id)
    {
        $conexao = Conexao::getInstance();
        if ($conexao->exec("DELETE FROM cidade WHERE id='{$id}';")) {
            return true;
        }
        return false;
    }
}