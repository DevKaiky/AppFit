    <?php
    namespace Controller;

    use service\UsuarioService;
    use template\UsuarioTemp;
    use template\ITemplate;

    class AdminUsuarioController {
        private ITemplate $template;
        private UsuarioService $service;

        public function __construct() {
            // Protege TODAS as ações de administração de utilizadores
            if (!isset($_SESSION['usuario_tipo']) || $_SESSION['usuario_tipo'] !== 'admin') {
                header('Location: index.php?param=Desafio/listar');
                exit;
            }
            $this->template = new UsuarioTemp();
            $this->service = new UsuarioService();
        }

    
        public function listar() {
            $resultado = $this->service->listarUsuarios();
            $this->template->layout("\\public\\usuario\\listar.php", $resultado); 
        }
        
        public function excluir(){
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
            if ($id) {
                $this->service->excluirUsuario($id);
            }
            header("Location: index.php?param=Admin/Usuario/listar");
            exit;
        }
    }
    
