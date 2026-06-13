<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$pokaz_sukces = false;
if (isset($_SESSION['mail_wyslany'])) {
    $pokaz_sukces = true;
    unset($_SESSION['mail_wyslany']);
}

// 3. Odbieranie formularza POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['wyslij_maila'])) {
    $_SESSION['mail_wyslany'] = true;
    header("Location: kontakt.php");
    exit;
}

include 'header.php';
?>
<main>
    <div style="max-width: 1100px; margin: 0 auto; padding: 20px;">
        <h1>Kontakt</h1>
        <p>Masz pytania? Chcesz podjąć współpracę? Skontaktuj się ze mną bezpośrednio lub użyj formularza poniżej <span style="color:red; font-weight: bold;">(formularz jest częścią symulacyjną, nie wysyła ona e-maili)</span>.</p>
        
        <div class="kontakt-kontener">
            
            <div class="sortowanie">
                <h2>Moje Dane</h2>
                
                <div class="kontakt-dane-item">
                    <strong>Imię i Nazwisko</strong>
                    <span>Wiktor Szwarcer</span>
                </div>
                
                <div class="kontakt-dane-item">
                    <strong>Numer telefonu</strong>
                    <span>+48 512 837 729</span>
                </div>
                
                <div class="kontakt-dane-item">
                    <strong>Adres E-mail</strong>
                    <span>wiktor200659@interia.pl</span>
                </div>
            </div>
            
            <div class="sortowanie">
                
                <?php if ($pokaz_sukces): ?>
                    <div style="background: #2ecc71; color: white; padding: 10px; border-radius: 5px; margin-bottom: 15px; text-align: center; font-weight: bold;">
                        Wiadomość została (symulacyjnie) wysłana pomyślnie!
                    </div>
                <?php endif; ?>

                <h2>Napisz wiadomość</h2>
                
                <form method="POST" action="kontakt.php">
                    <div>
                        <label for="email">Twój adres e-mail:</label>
                        <input type="email" id="email" name="email" required placeholder="np. klon@domena.pl">
                    </div>
                    
                    <div>
                        <label for="tresc">Treść wiadomości:</label>
                        <textarea id="tresc" name="tresc" required rows="6" placeholder="Wpisz treść swojej wiadomości..."></textarea>
                    </div>
                    
                    <button type="submit" name="wyslij_maila">Wyślij wiadomość</button>
                </form>
            </div>
            
        </div>
    </div>
</main>
<?php
include 'footer.php';
?>