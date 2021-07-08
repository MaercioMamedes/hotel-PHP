<!DOCTYPE html>
<html lang="pt-br"><head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="_css/estilos.css">
    <link rel="stylesheet" href="/_css/jquery-ui.min.css">
    <script src="/_js/jquery-3.6.0.js"></script>
    <script src="/_js/jquery-ui.min.js"></script>

    
    <title>Hotel Lorem IPSUM</title></head>
   
    <body class="corpo-documento" >
        <div class="topo-pagina">
            <div class="base-pagina">
             <div class="pagina">
                <div class="main">
                    <div class="header">  <!--Rever tag para cabeçalho, utilizar tag HEADER-->
                        <div class="header-topo">

                            <h1>Hotel LOREM IPSUM</h1>
                            <h2>A rede de hotéis com tudo que você precisa para seu descanso e lazer</h2>

                        </div>

                        <div class="header-base">
                            <p>Usuário:</p>
                        </div>

                        <div class="barra-menu"> <!-- Rever tag para menu. Utilizar Tag MENU-->
                            <div class="dropdown">
                                <button class="dropbutton">Consulta</button>
                            </div>
                            <div class="dropdown">
                                <button class="dropbutton">Cadastro</button>
                            </div>
                            <div class="dropdown">
                                <button class="dropbutton">Reserva</button>
                            </div>
                            <div class="dropdown">
                                <button class="dropbutton">Histórico</button>
                            </div>
                            <div class="dropdown">
                                <button class="dropbutton">Login</button>
                            </div>

                        </div>

                    </div>

                    <div class="conteudo-corpo">
                        <div class="coluna-esquerda" id="conteudo">
                        <?php

                            require_once("classBancoDados.php");
                            $conexao_bd = new ClassBancoDados("localhost");
                            if (!$conexao_bd->AbrirConexao()){ 
                                echo "<p> Erro na conexão com o Banco de dados" . $conexao_bd->MensagemErro() . "</p>";
                            }
                            else{
                                $conexao_bd->SetSELECT(" * "," hotel "," UF", " Cidade");

                                if($conexao_bd->ExecSELECT()){
                                    $NumeroRegistros = $conexao_bd->TotalRegistros();
                                    $DataSet = $conexao_bd->GetDataSet();

                                    if($NumeroRegistros > 0){
                                        while($Registros = $DataSet->fetch_assoc()){
                                            $EnderecoHotel ="<p>" . trim($Registros["Endereco"]) . trim($Registros["Numero"]) . "<br>";
                                            $EnderecoHotel .= trim($Registros["Bairro"]) . "-" . trim($Registros["Cidade"]) . "<br>";
                                            $EnderecoHotel .= $Registros["UF"] . " - Fone: " . $Registros["Telefone"] . "<br></p>";

                                            echo $EnderecoHotel;
                                        }
                                    }
                                }
                                else {
                                    echo "<p> Erro no comando SELECT </p>";
                                }
                            }

                            $conexao_bd->FecharConexao();

                        ?>           
                        </div>
                        <div class="coluna-direita">
                            <div class="calendario" id="calendario" align="center">
                            </div>
                            <div class="separacao-linhas"></div> <!-- Incompreensível-->
                            <div class="linha2-coluna-direita">
                              <p></p>
                            </div>
                        </div>
                    </div>
                    <div class="rodape-pagina"> <!-- Rever tag para rodapé. Utilzar o Footer-->
                        <p>© Copyright 2021. Designed by Maercio Mamedes</p>
                    </div>
                </div>
            </div>
        </div>

        </div>
    <script src="_js/scripts.js"></script>
    </body>

</html>