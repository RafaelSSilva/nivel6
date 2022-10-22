<?php
require_once 'classes/Pessoa.php';
require_once 'classes/Cidade.php';

try {
  if (!empty($_REQUEST['action'])) {
    if ($_REQUEST['action'] == 'edit') {
      $id     = (int) $_GET['id'];
      $pessoa = Pessoa::find($id);
    } else if ($_REQUEST['action'] == 'save') {
      $pessoa = $_POST;
      $result = Pessoa::save($pessoa);
      print ($result) ? 'Registro salvo com sucesso.' : $result;
    }
  } else {
    $pessoa['id'] = $pessoa['nome'] = $pessoa['endereco'] = $pessoa['bairro'] = $pessoa['telefone'] = $pessoa['email'] = $pessoa['id_cidade'] = '';
  }

  $form = file_get_contents('html/form.html');
  $form = str_replace('{id}', $pessoa['id'], $form);
  $form = str_replace('{nome}', $pessoa['nome'], $form);
  $form = str_replace('{endereco}', $pessoa['endereco'], $form);
  $form = str_replace('{bairro}', $pessoa['bairro'], $form);
  $form = str_replace('{telefone}', $pessoa['telefone'], $form);
  $form = str_replace('{email}', $pessoa['email'], $form);
  $form = str_replace('{cidades}', Cidade::lista_combo_cidades($pessoa['id_cidade']), $form);
} catch (Exception $e) {
  print $e->getMessage();
  exit;
}

print $form;
