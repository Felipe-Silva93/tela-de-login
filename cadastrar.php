
<?php
require_once 'classes/usuarius.php';
$u = new Usuario;
?>


<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet"  href="css/estilo.css">
    <title>Projeto Login</title>
</head>
<body>
    <div class="corpo-form-cad">
        <h1>Cadastre-se</h1>
        <form method="POST">
            <input type="text" name="nome" placeholder="Nome Completo" maxlength="30">
            <input type="text" name="telefone" placeholder="Telefone" maxlength="30">
            <input type="email" name="email" placeholder="Usuario" maxlength="40">
            <input type="password" name="senha" placeholder="Senha" maxlength="20">
            <input type="password" name="confSenha" placeholder="Confirmar senha"maxlength="20">
            <input type="submit" value="CADASTRAR">
        </form>
     </div>
<?php
//verificar se clicou no botao
if(isset($_POST['nome']))
{
    $nome = addslashes($_POST['nome']); //addslashes evita codigos maliciosos.
    $telefone = addslashes($_POST['telefone']);
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);
    $confirmarSenha = addslashes( $_POST['confSenha']);
    //verificando se todos os campos nao estao vazios
    if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confirmarSenha))
    {
        $u->conectar("crud_php","localhost","root","");
        if ($u->msgErro=="") //conectado normalmente;
        {
            if ($senha == $confirmarSenha)
            {
               if  ($u->cadastrar($nome, $telefone, $email, $senha))
                {
                    ?>
                    <div id='msg-sucesso'>
                        Cadastrado com sucesso!
                    </div>
                    <?php
                }
                else
                {
                    ?>
                    <div class="msg-erro">
                        Email já cadastrado, retorne e faça login.
                    </div>
                    <?php
                }
            }
            else
            {
                ?>
                <div class="msg-erro">
                    Senhas não conferem!
                </div>
                <?php
            }
        }
        else
            {
                ?>
                <div class="msg-erro">
                    <?php echo "Erro: ".$u->msgErro;?>
                </div>
                <?php
            }
        }
    else
        {
            ?>
            <div class="msg-erro">
                Preencha todos os campos!
            </div>
            <?php
        }
}
?>

</body>
</html>