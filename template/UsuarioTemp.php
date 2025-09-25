<?php
namespace template;

class UsuarioTemp implements ITemplate {
   public function cabecalho(){
        echo "<!DOCTYPE html><html lang='pt-pt'><head>";
        echo "<meta charset='UTF-8'>";
        echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        echo "<title>Fitness App</title>";
        
     
        echo "<link rel='preconnect' href='https://fonts.googleapis.com'>";
        echo "<link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>";
        echo "<link href='https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap' rel='stylesheet'>";
        echo "<link rel='stylesheet' href='public/css/style.css'>";
        
        echo "</head><body>";
        echo "<header><h1>Desafio Fitness</h1></header>";
        echo "<nav>";
       echo "</nav>";
        echo "<main class='container'>";
    
        
        echo "<nav>";
        if (isset($_SESSION['usuario_id'])) {
            // Menu para utilizadores logados
            echo "<div>";
            echo "<a href='index.php?param=Desafio/listar'>Ver Desafios</a>";
            echo "</div>";

            echo "<div class='user-info'>";
            echo "<span>Olá, " . htmlspecialchars($_SESSION['usuario_nome']) . "!</span>";
            
            if (isset($_SESSION['usuario_tipo']) && $_SESSION['usuario_tipo'] === 'admin') {
                echo "<a href='index.php?param=Admin/dashboard'>Painel Admin</a>";
            }
            
            echo "<a href='index.php?param=Usuario/perfil'>Meu Perfil</a>";
            echo "<a href='index.php?param=Auth/logout'>Logout</a>";
            echo "</div>";
        } 
        else {
            // Menu para visitantes
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
        
       
        $nomeDaPastaDoProjeto = 'AppFit-test'; // Ajustar
        $caminhoBase = $_SERVER['DOCUMENT_ROOT'] . '/' . $nomeDaPastaDoProjeto;

        $caminhoCorrigido = str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $pagina);
        $caminhoCompleto = $caminhoBase . $caminhoCorrigido;

        if (file_exists($caminhoCompleto)) {
            include $caminhoCompleto;
        } else {
            echo "<h2>Erro Crítico: A View não foi encontrada!</h2>";
            echo "<p>O sistema tentou incluir o ficheiro no seguinte caminho, mas ele não existe:</p>";
            echo "<code>" . htmlspecialchars($caminhoCompleto) . "</code>";
            echo "<p><strong>Solução:</strong> Verifique se o valor de <strong>\$nomeDaPastaDoProjeto</strong> no ficheiro <code>template/UsuarioTemp.php</code> corresponde exatamente ao nome da sua pasta dentro de <code>C:/xampp/htdocs/</code>.</p>";
        }

        $this->rodape();
    }
}

