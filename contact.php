<?php
$berichtVerstuurd = false;
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $naam = htmlspecialchars(trim($_POST["naam"] ?? ""));
    $email = htmlspecialchars(trim($_POST["email"] ?? ""));
    $bericht = htmlspecialchars(trim($_POST["bericht"] ?? ""));

    // Validatie
    if (empty($naam)) $errors[] = "Naam is verplicht.";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Voer een geldig e-mailadres in.";
    if (empty($bericht)) $errors[] = "Bericht mag niet leeg zijn.";

    // Als geen fouten
    if (count($errors) === 0) {
        // Hier kun je de mailfunctie gebruiken (optioneel)
        // mail("jouwemail@voorbeeld.nl", "Nieuw bericht van $naam", $bericht);
        $berichtVerstuurd = true;
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact – ScooterShop</title>
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navigatie -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.html">ScooterShop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="producten.html">Scooters</a></li>
                <li class="nav-item"><a class="nav-link" href="over-website.html">Over Website</a></li>
                <li class="nav-item"><a class="nav-link active" href="contact.php">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Contactformulier -->
<section class="container my-5">
    <h2 class="text-center mb-4">Neem contact met ons op</h2>

    <?php if ($berichtVerstuurd): ?>
        <div class="alert alert-success">Bedankt voor je bericht! We nemen snel contact met je op.</div>
    <?php elseif (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="contact.php" class="row g-3">
        <div class="col-md-6">
            <label for="naam" class="form-label">Naam</label>
            <input type="text" class="form-control" id="naam" name="naam" required>
        </div>
        <div class="col-md-6">
            <label for="email" class="form-label">E-mailadres</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="col-12">
            <label for="bericht" class="form-label">Bericht</label>
            <textarea class="form-control" id="bericht" name="bericht" rows="5" required></textarea>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Verstuur</button>
        </div>
    </form>
</section>

<!-- Footer -->
<footer class="bg-dark text-white text-center py-3">
    <p>&copy; 2025 ScooterShop. Alle rechten voorbehouden.</p>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
