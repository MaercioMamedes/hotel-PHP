<?php


class ClassBancoDados {
    protected $ConexaoBanco;
    protected $IdServidor;
    protected $NumeroUltimoErro;
    protected $DescricaoErro;
    protected $ComandoSQL;
    protected $DataSet;
    protected $NumeroRegistros;

    //construtor

    function __construct($Servidor)
    {
        $this->ConexaoBanco = NULL;
        $this->NumeroUltimoErro = -1;
        $this->DescricaoErro = "";
        $this->DataSet = NULL;
        $this->NumeroRegistros = 0;

        if($Servidor === ""){
            $this->IdServidor = "localhost";
        }

        else {
            $this->IdServidor = $Servidor;
        }
    }

    // Métodos Públicos

    public function AbrirConexao(){

        $this->ConexaoBanco = new mysqli($this->IdServidor,"root","","hotelbd");

        if(mysqli_connect_errno() != 0){
            $this->ConexaoBanco = NULL;
            $this->NumeroUltimoErro = mysqli_connect_errno();
            $this->DescricaoErro = mysqli_connect_error();
            return false;
        }

        else {
            $this->ConexaoBanco->set_charset("utf8");
            return $this->ConexaoBanco;
        }
    }

    public function CodigoErro(){
        return $this->NumeroUltimoErro;
    }

    public function MensagemErro(){
        return $this->DescricaoErro;
    }

    public function FecharConexao(){
        if($this->ConexaoBanco === NULL){
            return false;
        }

        $this->ConexaoBanco->close();

    }

    public function SetSELECT($Campos = "", $Tabela = "", $CamposOrdenacao = "", $Ordem = ""){ // Váriável $Ordem não consta no projeto Original
        if (($Campos != "") && ($Tabela != "")) {
            $this->ComandoSQL = "SELECT" . $Campos . "FROM" .  $Tabela;

            if($Ordem != ""){
                $this->ComandoSQL .= "ORDER BY";
                $this->ComandoSQL .= $CamposOrdenacao;
            }
        }
    }

    public function ExecSELECT(){
        if($this->ComandoSQL != ""){
            $this->DataSet = $this->ConexaoBanco->query($this->ComandoSQL);

            if ($this->DataSet){
                $this->NumeroRegistros = $this->DataSet->num_rows;
            }

            return true;
        }

        else {
            return false;
        }
    }

    public function TotalRegistros(){
        return $this->NumeroRegistros;
    }

    public function GetDataSet(){
        return $this->DataSet;
    }
}

?>