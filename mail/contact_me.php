<?php
require 'Conn.php'; // Pegando o arquivo Conn.php que vai fazer a configuração do banco de dados.

$name = $_POST['name'];
//pega os dados que foi digitado no ID name.

$email = $_POST['email'];
//pega os dados que foi digitado no ID email.

$subject = (isset($_POST['subject'])) ? $_POST['subject'] : 'N/A';
//pega os dados que foi digitado no ID subject.

$message = $_POST['message'];
//pega os dados que foi digitado no ID message.

$date = date('Y-m-d H:i:s');

$sql = "INSERT INTO tb_contact (c_name, c_email, c_subject, c_message, c_date_register) VALUES (:c_name, :c_email, :c_subject, :c_message, :c_date_register)"; // Criando query para executar no Banco de dados.
$stmt = $Conn -> prepare($sql); 
$stmt -> bindParam(":c_name", $name);
$stmt -> bindParam(":c_email", $email);
$stmt -> bindParam(":c_subject", $subject);
$stmt -> bindParam(":c_message", $message);
$stmt -> bindParam(":c_date_register", $date);


$result = $stmt -> execute();

if(!$result) {

  echo "<script> alert('Falha ao enviar o Formulário.'); </script>";
  // var_dump($stmt -> errorInfo());
  exit;
}

echo "<script> alert('Formulário enviado com sucesso!'); </script>";
exit;

$headers = "From: $email\r\n";
$headers .= "Reply-To: $email\r\n";

/*abaixo contém os dados que serão enviados para o email
cadastrado para receber o formulário*/

$corpo = "Formulario enviado pelo site camon.eco.br\n";
$corpo .= "Nome: " . $name . "\n";
$corpo .= "Email: " . $email . "\n";
$corpo .= "Mensagem: " . $message . "\n";

$email_to = 'ateliedapw@gmail.com';
//não esqueça de substituir este email pelo seu.

$status = mail($email_to, $subject, $corpo, $headers);
//enviando o email.

if ($status) {
  echo "<script> alert('Formulário enviado com sucesso!'); </script>";
  
//mensagem de form enviado com sucesso.

} else {
  echo "<script> alert('Falha ao enviar o Formulário.'); </script>";
  
//mensagem de erro no envio. 

}
?>