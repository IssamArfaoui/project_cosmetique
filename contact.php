<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:\xampp\htdocs\Stage\project_cosmetique\PHPMailer\src\Exception.php';
require 'C:\xampp\htdocs\Stage\project_cosmetique\PHPMailer\src\PHPMailer.php';
require 'C:\xampp\htdocs\Stage\project_cosmetique\PHPMailer\src\SMTP.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = htmlspecialchars(trim($_POST["name"]));
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $user_message = htmlspecialchars(trim($_POST["message"]));

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'mouchtakkarim583@gmail.com';  
            $mail->Password = 'exbo xtzd huhy rafx';      
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('your-email@gmail.com', 'Your Name'); 
            $mail->addAddress('mouchtakkarim583@gmail.com');  
            $mail->Subject = "Message de $first_name $last_name";
            $mail->Body = "Nom: $first_name\nEmail: $email\nMessage: $user_message";

            $mail->CharSet = 'UTF-8';

            $mail->send();          
            echo "Votre message a été envoyé avec succès!";
            header("Location: " . $_SERVER['PHP_SELF'] . "?sent=1");
            exit;            
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Veuillez entrer une adresse email valide.";
    }    
}
?>
    <?php require_once "required/header.php" ?>

    <section class='contact_all'>
        <div class="contact">
            <div class="overlay d-flex justify-content-center align-items-center">
                <div class="text ">
                    <h1 class="text-white">Contactez-Nous</h1>
                </div>
            </div>
        </div>
        <div class='contact_content p-5 d-flex justify-content-center align-items-center'>
            <div class='text w-50 text-center'>
                <p>Contactez-nous</p> 
                <h2 class='fs-1'>Nous apprécions le lien avec notre communauté et sommes là pour vous aider de toutes les manières possibles. N'hésitez pas à nous contacter via les canaux suivants:</h2>
            </div>
        </div>
        <div class="row m-0 p-2 pt-5 py-5 justify-content-center align-items-cente gap-5">  
            <form action="" method='post' class='col-lg-5'>
                <div class="mb-3">
                    <input type="text" class="form-control rounded-0" name="name" placeholder="Nom" required>
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control rounded-0" name="email" placeholder="email@example.com" required>
                </div>
                <div class="mb-3">
                    <textarea class="form-control rounded-0" rows="7" name="message" placeholder="Message" required></textarea>
                </div>
                <button class="butn px-3 py-2" type='submit' name='send'>Envoyer</button>
                
            </form>
            <div class='col-lg-5'>
                <div>
                    <h6>Email : </h6>
                    <h2>email@gmail.com</h2>
                </div>
                <hr>
                <div>
                    <h6>Téléphone : </h6>
                    <h2>0798436578</h2>
                </div>
                <hr>
                <div>
                    <h6>Adresse :</h6>
                    <h2>Maroc, Casablanca</h2>
                </div>
                <hr>
                <div class='d-flex gap-3 align-items-cente'>
                    <h6 class='fs-5'>Suivez-Nous : </h6>
                    <div class='d-flex gap-2'> 
                        <a href="https://web.facebook.com/" class='fs-5 nav-link'><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="mailto:issamarfaouicb4@gmail.com" class='fs-5 nav-link'><i class="fa-brands fa-google"></i></a>
                        <a href="https://x.com/home" class='fs-5 nav-link'><i class="fa-brands fa-x-twitter"></i></a>
                        <a href="https://www.instagram.com/" class='fs-5 nav-link'><i class="fa-brands fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <?php require_once "required/footer.php" ?>
