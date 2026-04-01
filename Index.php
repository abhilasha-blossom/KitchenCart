<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KitchenCart — Smarter B2B Procurement for Restaurants</title>
    <meta name="description" content="KitchenCart helps restaurants compare daily raw material prices from multiple vendors and place orders instantly. Built for the modern kitchen.">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        /* Landing Page Specific Overrides */
        :root {
            --background: 220 20% 6%;
            --foreground: 40 20% 95%;
            --card: 220 20% 8%;
            --border: 220 15% 15%;
            --muted: 220 15% 12%;
            --muted-foreground: 220 10% 65%;
            --primary: 150 50% 50%;
        }

        body {
            display: block;
            background-color: hsl(var(--background));
            color: hsl(var(--foreground));
        }

        .card-elevated {
            background-color: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.3s, border-color 0.3s;
        }
        
        .card-elevated:hover {
            transform: translateY(-5px);
            border-color: rgba(255, 255, 255, 0.15);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.4);
            background-color: rgba(255, 255, 255, 0.05);
        }

        /* Scroll Animations */
        .scroll-animate {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s cubic-bezier(0.4, 0, 0.2, 1), transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .scroll-animate.is-visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Top Navigation */
        .landing-nav {
            position: sticky;
            top: 0;
            z-index: 50;
            background-color: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 4rem;
        }

        .landing-nav .logo {
            font-size: 1.25rem;
            font-weight: 700;
            color: white;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .landing-nav .logo i {
            color: hsl(var(--primary));
            font-size: 1.5rem;
        }

        .nav-actions {
            display: flex;
            gap: 0.75rem;
            align-items: center;
        }

        .btn-ghost {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1rem;
            border-radius: calc(var(--radius) - 2px);
            font-size: 0.875rem;
            font-weight: 500;
            color: white;
            transition: background-color 0.2s;
        }

        .btn-ghost:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        /* Hero */
        .hero-wrapper {
            background: linear-gradient(to bottom, rgba(0,0,0,0.65), rgba(0,0,0,0.85)), url('assets/images/landing_hero_bg.png');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 90vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: -4rem; /* Offset sticky nav height */
            padding-top: 4rem;
        }

        .hero {
            padding: 4rem 2rem;
            text-align: center;
            max-width: 860px;
            margin: 0 auto;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.35rem 0.875rem;
            background-color: rgba(255, 255, 255, 0.15);
            color: #4ade80;
            border: 1px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(8px);
            border-radius: 9999px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 1.75rem;
            letter-spacing: 0.03em;
        }

        .hero h1 {
            font-size: clamp(2.25rem, 5vw, 3.75rem);
            line-height: 1.15;
            font-weight: 700;
            letter-spacing: -0.04em;
            color: white;
            margin-bottom: 1.25rem;
        }

        .hero h1 span {
            color: #4ade80;
        }

        .hero p {
            font-size: 1.125rem;
            color: rgba(255, 255, 255, 0.85);
            max-width: 580px;
            margin: 0 auto 2.5rem;
            line-height: 1.7;
        }

        /* Animations */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.8s cubic-bezier(0.4, 0, 0.2, 1) forwards;
            opacity: 0;
        }
        .delay-100 { animation-delay: 100ms; }
        .delay-200 { animation-delay: 200ms; }
        .delay-300 { animation-delay: 300ms; }

        .hero-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-lg {
            padding: 0.75rem 1.75rem;
            font-size: 1rem;
            border-radius: calc(var(--radius));
        }

        /* Stats Bar */
        .stats-bar {
            border-top: 1px solid hsl(var(--border));
            border-bottom: 1px solid hsl(var(--border));
            background-color: hsl(var(--card));
            padding: 2rem;
            display: flex;
            justify-content: center;
            gap: 4rem;
            flex-wrap: wrap;
        }

        .stat-item {
            text-align: center;
        }

        .stat-item .num {
            font-size: 2rem;
            font-weight: 700;
            color: hsl(var(--primary));
            display: block;
        }

        .stat-item .label {
            font-size: 0.875rem;
            color: hsl(var(--muted-foreground));
            margin-top: 0.25rem;
        }

        /* Sections */
        .section {
            padding: 5rem 2rem;
            max-width: 1100px;
            margin: 0 auto;
        }

        .section-header {
            text-align: center;
            margin-bottom: 3.5rem;
        }

        .section-tag {
            display: inline-block;
            font-size: 0.8rem;
            font-weight: 600;
            color: hsl(var(--primary));
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-bottom: 0.75rem;
        }

        .section-title {
            font-size: clamp(1.5rem, 3vw, 2.25rem);
            font-weight: 700;
            letter-spacing: -0.03em;
            margin-bottom: 0.75rem;
        }

        .section-subtitle {
            color: hsl(var(--muted-foreground));
            font-size: 1.0625rem;
            max-width: 520px;
            margin: 0 auto;
            line-height: 1.7;
        }

        /* Features Grid */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .feature-card {
            padding: 2rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .feature-icon {
            width: 3rem;
            height: 3rem;
            background-color: hsl(var(--primary) / 0.1);
            border-radius: calc(var(--radius) - 2px);
            display: flex;
            align-items: center;
            justify-content: center;
            color: hsl(var(--primary));
            font-size: 1.5rem;
        }

        .feature-card h3 {
            font-size: 1.125rem;
            font-weight: 600;
        }

        .feature-card p {
            color: hsl(var(--muted-foreground));
            font-size: 0.9375rem;
            line-height: 1.65;
        }

        /* How It Works */
        .steps-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(270px, 1fr));
            gap: 1.5rem;
            position: relative;
        }

        .step-card {
            padding: 2rem;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
        }

        .step-number {
            width: 2.5rem;
            height: 2.5rem;
            background-color: hsl(var(--primary));
            color: hsl(var(--primary-foreground));
            border-radius: 9999px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            font-weight: 700;
        }

        .step-card h3 {
            font-size: 1.0625rem;
            font-weight: 600;
        }

        .step-card p {
            color: hsl(var(--muted-foreground));
            font-size: 0.9rem;
            line-height: 1.65;
        }

        /* CTA Section */
        .cta-section {
            background: linear-gradient(135deg, hsl(150 50% 30%), hsl(150 60% 15%));
            position: relative;
            overflow: hidden;
            padding: 6rem 2rem;
            text-align: center;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        .cta-section::before {
            content: '';
            position: absolute;
            top: -50%; left: -50%; width: 200%; height: 200%;
            background: radial-gradient(circle at center, rgba(74, 222, 128, 0.15) 0%, transparent 50%);
            z-index: 0;
            pointer-events: none;
        }
        
        .cta-content {
            position: relative;
            z-index: 1;
        }

        .cta-section h2 {
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 700;
            color: white;
            margin-bottom: 1.25rem;
            letter-spacing: -0.03em;
        }

        .cta-section p {
            color: rgba(255, 255, 255, 0.85);
            font-size: 1.125rem;
            margin-bottom: 2.5rem;
            max-width: 520px;
            margin-left: auto;
            margin-right: auto;
        }

        .btn-white {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.875rem 2rem;
            border-radius: 9999px;
            background-color: white;
            color: hsl(150 60% 15%);
            font-size: 1.0625rem;
            font-weight: 600;
            transition: transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-white:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }

        /* Footer */
        .landing-footer {
            border-top: 1px solid hsl(var(--border));
            padding: 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .landing-footer .logo {
            font-size: 1rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.4rem;
            color: hsl(var(--foreground));
        }

        .landing-footer .logo i {
            color: hsl(var(--primary));
        }

        .landing-footer p {
            font-size: 0.875rem;
            color: hsl(var(--muted-foreground));
        }
    </style>
</head>
<body>

<!-- Navigation -->
<nav class="landing-nav">
    <div class="logo">
        <i class="ph-fill ph-storefront"></i>
        KitchenCart
    </div>
    <div class="nav-actions">
        <a href="auth/login.php" class="btn-ghost">Sign In</a>
        <a href="auth/register.php" class="btn-primary btn-lg" style="font-size:0.875rem; padding: 0.5rem 1.25rem;">Get Started</a>
    </div>
</nav>

<!-- Hero -->
<div class="hero-wrapper">
    <section class="hero">
        <div class="hero-badge animate-fade-in-up">
            <i class="ph ph-sparkle"></i> B2B Procurement, Simplified
        </div>
        <h1 class="animate-fade-in-up delay-100">Buy smarter.<br><span>Spend less.</span> Cook better.</h1>
        <p class="animate-fade-in-up delay-200">KitchenCart connects restaurants with verified vendors — compare daily raw material prices, place orders instantly, and track every delivery in one place.</p>
        <div class="hero-actions animate-fade-in-up delay-300">
            <a href="auth/register.php" class="btn-primary btn-lg">
                <i class="ph ph-arrow-right" style="margin-right: 0.5rem;"></i> Start Ordering
            </a>
            <a href="#how-it-works" class="btn-ghost btn-lg" style="border: 1px solid rgba(255,255,255,0.3); color: white;">
                See How It Works
            </a>
        </div>
    </section>
</div>

<!-- Stats Bar -->
<div class="stats-bar">
    <div class="stat-item scroll-animate">
        <span class="num">3x</span>
        <span class="label">Faster Procurement</span>
    </div>
    <div class="stat-item scroll-animate">
        <span class="num">100%</span>
        <span class="label">Price Transparency</span>
    </div>
    <div class="stat-item scroll-animate">
        <span class="num">Live</span>
        <span class="label">Daily Vendor Prices</span>
    </div>
    <div class="stat-item scroll-animate">
        <span class="num">Real-time</span>
        <span class="label">Order Tracking</span>
    </div>
</div>

<!-- Features -->
<div class="section">
    <div class="section-header">
        <span class="section-tag">Features</span>
        <h2 class="section-title">Everything you need to run a smart kitchen</h2>
        <p class="section-subtitle">From price comparison to order delivery tracking — we've built it all into one clean platform.</p>
    </div>
    <div class="features-grid">
        <div class="card-elevated feature-card scroll-animate">
            <div class="feature-icon"><i class="ph ph-chart-bar"></i></div>
            <h3>Live Price Comparison</h3>
            <p>See daily prices updated by multiple vendors for every ingredient. Instantly spot the best deal with our "Best Price" indicator.</p>
        </div>
        <div class="card-elevated feature-card scroll-animate">
            <div class="feature-icon"><i class="ph ph-shopping-bag"></i></div>
            <h3>One-Click Ordering</h3>
            <p>Place orders directly from the price comparison view. Set your quantity and submit — it's that simple.</p>
        </div>
        <div class="card-elevated feature-card scroll-animate">
            <div class="feature-icon"><i class="ph ph-trend-up"></i></div>
            <h3>Price Trend Tracking</h3>
            <p>Track how prices have moved since yesterday. Make smarter buying decisions based on real historical context.</p>
        </div>
        <div class="card-elevated feature-card scroll-animate">
            <div class="feature-icon"><i class="ph ph-package"></i></div>
            <h3>Order Status Updates</h3>
            <p>Vendors update order status from Pending to Accepted to Delivered. You always know exactly where your goods are.</p>
        </div>
        <div class="card-elevated feature-card scroll-animate">
            <div class="feature-icon"><i class="ph ph-shield-check"></i></div>
            <h3>Verified Vendors</h3>
            <p>Only verified vendors can list products on KitchenCart. No more guessing about supplier reliability.</p>
        </div>
        <div class="card-elevated feature-card scroll-animate">
            <div class="feature-icon"><i class="ph ph-squares-four"></i></div>
            <h3>Analytics Dashboard</h3>
            <p>Track your total spend, active orders, and procurement trends from a clean, data-driven dashboard.</p>
        </div>
    </div>
</div>

<!-- How It Works -->
<div style="background-color: hsl(var(--card)); border-top: 1px solid hsl(var(--border)); border-bottom: 1px solid hsl(var(--border));">
    <div class="section" id="how-it-works">
        <div class="section-header">
            <span class="section-tag">How It Works</span>
            <h2 class="section-title">From price to plate in 3 steps</h2>
            <p class="section-subtitle">KitchenCart makes daily procurement as smooth as possible for your team.</p>
        </div>
        <div class="steps-grid">
            <div class="card-elevated step-card scroll-animate">
                <div class="step-number">1</div>
                <i class="ph ph-storefront" style="font-size: 2rem; color: hsl(var(--primary));"></i>
                <h3>Vendors Post Prices</h3>
                <p>Verified vendors update their daily ingredient prices every morning on the platform.</p>
            </div>
            <div class="card-elevated step-card">
                <div class="step-number">2</div>
                <i class="ph ph-magnifying-glass" style="font-size: 2rem; color: hsl(var(--primary));"></i>
                <h3>Restaurants Compare</h3>
                <p>Your team views live prices from all vendors side by side. The lowest price is automatically highlighted.</p>
            </div>
            <div class="card-elevated step-card">
                <div class="step-number">3</div>
                <i class="ph ph-check-circle" style="font-size: 2rem; color: hsl(var(--primary));"></i>
                <h3>Order & Track</h3>
                <p>Place your order with a single click and track its status from Pending through to Delivered.</p>
            </div>
        </div>
    </div>
</div>

<!-- CTA -->
<div class="cta-section scroll-animate">
    <div class="cta-content">
        <h2>Ready to transform your procurement?</h2>
        <p>Join restaurants already saving time and money with KitchenCart every day.</p>
        <a href="auth/register.php" class="btn-white">
            <i class="ph ph-arrow-right" style="margin-right: 0.5rem;"></i> Get Started Now
        </a>
    </div>
</div>

<!-- Footer -->
<footer class="landing-footer">
    <div class="logo">
        <i class="ph-fill ph-storefront"></i> KitchenCart
    </div>
    <p>© <?= date('Y') ?> KitchenCart. Built for the modern kitchen.</p>
</footer>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if(entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    // Optional: stop observing once animated
                    // observer.unobserve(entry.target); 
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.scroll-animate').forEach(el => observer.observe(el));
    });
</script>

</body>
</html>
