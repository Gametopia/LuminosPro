<head>
  <title>Contact - Luminos</title>
</head>

<?php require_once __DIR__ . '/assets/head.php'; ?>
<?php require_once __DIR__ . '/assets/header.php'; ?>
<!-- Hero -->

<section class="hero">
  <div class="hero-inner">
    <div class="hero-copy">
      <h2>Neem contact met ons op</h2>
      <p>Heb je vragen over tuning, onderhoud of wil je een afspraak maken? Stuur ons direct een mail op: <a
          href="mailto:support@luminos.co.nl">Support@luminos.co.nl</a> of vul hieronder ons formulier in en wij
        reageren zo snel mogelijk.</p>
    </div>
    <div class="hero-media">
      <img src="img/lmns_round.svg" alt="Contact Luminos">
    </div>
  </div>
</section>

<!-- Contact Form -->
<section class="contact-form-section">
  <div class="form-wrap">
    <form id="contact-form" method="POST" action="contactform.php">
      <div class="form-row">
        <label for="name">Naam</label>
        <input type="text" id="name" name="name" required>
      </div>

      <div class="form-row">
        <label for="email">E-mailadres</label>
        <input type="email" id="email" name="email" required>
      </div>

      <div class="form-row">
        <label for="phone">Telefoonnummer (optioneel)</label>
        <input type="tel" id="phone" name="phone">
      </div>

      <div class="form-row">
        <label for="message">Bericht</label>
        <textarea id="message" name="message" rows="5" required></textarea>
      </div>

      <div class="form-row">
        <button type="submit" class="btn btn-primary">Verstuur</button>
      </div>
    </form>
    <div id="form-success" class="form-success" style="display:none;">
      ✅ Bedankt! Je bericht is verzonden.
    </div>
  </div>
</section>

<!-- Footer -->
<?php require_once __DIR__ . '/assets/footer.php'; ?>

<!-- JS -->
<script>
  document.getElementById("contact-form").addEventListener("submit", async function (e) {
    e.preventDefault();
    const formData = new FormData(this);

    const response = await fetch("contactform.php", {
      method: "POST",
      body: formData
    });

    const result = await response.json();
    if (result.success) {
      document.getElementById("form-success").style.display = "block";
      this.reset();
    } else {
      alert("Er ging iets mis, probeer opnieuw.");
    }
  });

  function toggleNavbar() {
    document.getElementById("main-navbar").classList.toggle("responsive");
  }
</script>
</body>

</html>