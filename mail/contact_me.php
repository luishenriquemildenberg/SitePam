<?php
require 'Conn.php'; // Pegando o arquivo Conn.php que vai fazer a configuração do banco de dados.
require './../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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

try {
  $mail = new PHPMailer;
  $mail -> SMTPDebug = 0; // Ativar Depuração
  $mail -> isSMTP(); // Definir mail para utilizar protocolo SMTP (Envio)
  $mail -> Host = 'smtp.gmail.com'; // Especificar Servidor 
  $mail -> SMTPAuth = true; // Ativar Autenticação SMTP
  $mail -> Username = "ateliedapw@gmail.com"; // Email Usuario
  $mail -> Password = "Pam250895*"; // Senha do Usuario
  $mail -> SMTPSecure = "ssl"; // Ativar Criptografia
  $mail -> Port = 465; // Porta SMTP
  $mail->CharSet = 'UTF-8'; // Transformando em Utf-8
  
  // Destinatário
  $mail -> setFrom('ateliedapw@gmail.com', "Atelie da Pam"); 
  $mail -> addAddress('hard.henrique@outlook.com', "Luis Henrique"); 
  $mail -> addAddress('allan.cristian@outlook.com.br', "Allan Camargo"); //  
  $mail -> addAddress($email, $name); //  
  
  
  $mail -> isHTML(true);
  $mail -> Subject = "Contato - Atelie da Pam";
  $mail -> Body = "Email recebido: " . $email . "<br /> Nome recebido: " . $name . "<br /> Mensagem: " . $message;
  $mail -> AltBody = "Atualiza essa merda!";

  $mail -> send();

} catch(Exception $e) {
  echo "Aqui deu ruim. <br />";
  echo "Erro: " . $mail -> ErrorInfo;
}

echo "<script> alert('Formulário enviado com sucesso!'); </script>";
exit;









?>