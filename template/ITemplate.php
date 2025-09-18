<?php
namespace template;
interface ITemplate {
    public function cabecalho();
    public function rodape();
    public function layout($pagina, $dados = null);
}