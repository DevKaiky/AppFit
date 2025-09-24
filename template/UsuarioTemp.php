<?php
namespace template;

class UsuarioTemp implements ITemplate {
    public function cabecalho(){
        echo "<!DOCTYPE html><html><head><title>Fitness App</title>";
        echo "<style>
            body { font-family: sans-serif; margin: 0; padding: 0; }
            main { padding: 0 20px; }
            nav { background-color: #f2f2f2; padding: 10px 20px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #ccc; }
            nav a { margin: 0 15px; text-decoration: none; color: #333; }
            .user-info { font-weight: bold; display: flex; align-items: center; }
            .user-info span { margin-right: 15px; }
        </style>";
        echo "</head><body>";
        echo "<header><h1>Desafio Fitness</h1></header>";
        
        echo "<nav>";
        if (isset($_SESSION['usuario_id'])) {
            echo "<div>";
            echo "<a href='index.php?param=Usuario/listar'>Gerenciar Usuários</a>";
            // echo "<a href='index.php?param=Desafio/listar'>Ver Desafios</a>";
            echo "</div>";

            echo "<div class='user-info'>";
            echo "<span>Olá, " . htmlspecialchars($_SESSION['usuario_nome']) . "!</span>";
            echo "<a href='index.php?param=Usuario/perfil'>Meu Perfil</a>";
            echo "<a href='index.php?param=Auth/logout'>Logout</a>";
            echo "</div>";
        } 
        else {
            echo "<div>";
            echo "<a href='index.php?param=Auth/mostrarFormularioLogin'>Login</a>";
            echo "<a href='index.php?param=Usuario/formulario'>Cadastre-se</a>";
            echo "</div>";
        }
        echo "</nav>";

        echo "<main>";
    }

    public function rodape(){
        echo "</main><footer><p style='text-align:center; margin-top: 30px; border-top: 1px solid #ccc; padding-top: 15px;'>&copy; 2025 - Meu App Fitness</p></footer>";
        echo "</body></html>";
    }
    public function layout($pagina, $dados = null) {
        $this->cabecalho();
        $parametro = $dados;
        include $_SERVER['DOCUMENT_ROOT'] . "\\mvc20251".$pagina; // ATENÇÃO: ajuste o caminho se necessário
        $this->rodape();
    }
}