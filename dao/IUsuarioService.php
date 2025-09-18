<?php
namespace dao;

interface IUsuarioService {
    public function listar();
    public function salvar($dados);
    public function listarId($id);
    public function excluir($id);
    public function buscarPorEmail($email);
}