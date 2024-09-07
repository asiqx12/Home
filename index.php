<?php
$message = '';
$messageClass = '';
$showModal = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = isset($_POST['name']) ? trim(htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8')) : '';
    $phone = isset($_POST['phone']) ? trim(htmlspecialchars($_POST['phone'], ENT_QUOTES, 'UTF-8')) : '';
    $userMessage = isset($_POST['message']) ? trim(htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8')) : '';

    if (empty($name) || empty($phone) || empty($userMessage)) {
        $message = "All fields are required.";
        $messageClass = "error";
    } else {
        if (!preg_match("/^[0-9+]+$/", $phone)) {
            $message = "Invalid phone number format.";
            $messageClass = "error";
        } else {
            // Simulating successful message sending
            $message = "Your message has been sent successfully.";
            $messageClass = "success";
            $showModal = true;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FORTEK - Professional Business Solutions</title>
    <style>
        :root {
            --primary-color: #86BC25;
            --text-color: #000000;
            --background-color: #FFFFFF;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: var(--text-color);
            background-color: var(--background-color);
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        header {
            background-color: var(--background-color);
            color: var(--text-color);
            padding: 1rem 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo {
            font-size: 2rem;
            font-weight: bold;
            color: var(--text-color);
        }
        .logo::after {
            content: '.';
            color: var(--primary-color);
        }
        .nav-links {
            display: flex;
            list-style: none;
        }
        .nav-links li {
            margin-left: 20px;
        }
        .nav-links a {
            color: var(--text-color);
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }
        .nav-links a:hover {
            color: var(--primary-color);
        }
        main {
            padding-top: 80px;
        }
        .hero {
            background: linear-gradient(rgba(255,255,255,0.8), rgba(255,255,255,0.8)), url('hero.jpeg') no-repeat center center/cover;
            height: 100vh;
            display: flex;
            align-items: center;
            text-align: center;
            color: var(--text-color);
        }
        .hero-content {
            width: 100%;
        }
        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 1rem;
        }
        .hero p {
            font-size: 1.5rem;
            max-width: 600px;
            margin: 0 auto 2rem;
        }
        .btn {
            display: inline-block;
            background: var(--primary-color);
            color: var(--background-color);
            padding: 0.8rem 1.5rem;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        .btn:hover {
            background: #6fa51e;
        }
        .services {
            padding: 4rem 0;
            background: var(--background-color);
        }
        .services h2 {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 3rem;
        }
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }
        .service-card {
            background: var(--background-color);
            padding: 2rem;
            border-radius: 5px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
        .service-card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
        .contact {
            padding: 4rem 0;
            background: #f4f4f4;
        }
        .contact h2 {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 3rem;
        }
        .contact-form {
            max-width: 600px;
            margin: 0 auto;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
        }
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        footer {
            background: var(--text-color);
            color: var(--background-color);
            text-align: center;
            padding: 1rem 0;
        }
        .message {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1001;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }
        .modal-content {
            background-color: var(--background-color);
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 5px;
            text-align: center;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }
            .hero h1 {
                font-size: 2.5rem;
            }
            .hero p {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>
    <header>
        <nav class="container">
            <div class="logo">FORTEK</div>
            <ul class="nav-links">
                <li><a href="#home">Home</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="home" class="hero">
            <div class="hero-content container">
                <h1>Welcome to FORTEK</h1>
                <p>Professional Solutions for Complex Business Challenges</p>
                <a href="#services" class="btn">Explore Our Services</a>
            </div>
        </section>

        <section id="services" class="services">
            <div class="container">
                <h2>Our Services</h2>
                <div class="services-grid">
                    <div class="service-card">
                        <h3>Operational Optimization</h3>
                        <p>Enhance your business processes with advanced analytics and data-driven strategies.</p>
                    </div>
                    <div class="service-card">
                        <h3>Custom Software Solutions</h3>
                        <p>Tailored applications designed to meet your specific business needs and workflows.</p>
                    </div>
                    <div class="service-card">
                        <h3>Technology Consulting</h3>
                        <p>Expert guidance on leveraging cutting-edge technologies for your industry.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="contact" class="contact">
            <div class="container">
                <h2>Contact Us</h2>
                <?php if ($message && !$showModal): ?>
                    <div class="message <?php echo $messageClass; ?>"><?php echo $message; ?></div>
                <?php endif; ?>
                <form class="contact-form" method="POST" action="#contact">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="tel" id="phone" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn">Send Message</button>
                </form>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2024 FORTEK. All rights reserved.</p>
        </div>
    </footer>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>Your message has been sent to our team. We'll be in touch shortly. Thank you for contacting FORTEK!</p>
        </div>
    </div>

    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        var modal = document.getElementById("myModal");
        var span = document.getElementsByClassName("close")[0];

        <?php if ($showModal): ?>
        window.onload = function() {
            modal.style.display = "block";
        }
        <?php endif; ?>

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>