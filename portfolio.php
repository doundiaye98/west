<?php
// Portfolio dynamique avec base de données
require_once 'database.php';

// Récupération des données depuis la base de données
$personal = getPersonalInfo();
$stats = getStatistics();
$languages = getLanguages();
$skills = getSkills();
$technologies = getTechnologies();
$experience = getExperiences();
$education = getEducation();
$projects = getProjects();
$siteSettings = getSiteSettings();

// Navigation statique
$navigation = [
    ['name' => 'Accueil', 'link' => '#home'],
    ['name' => 'À propos', 'link' => '#about'],
    ['name' => 'Compétences', 'link' => '#skills'],
    ['name' => 'Expérience', 'link' => '#experience'],
    ['name' => 'Formation', 'link' => '#education'],
    ['name' => 'Projets', 'link' => '#projects'],
    ['name' => 'Contact', 'link' => '#contact']
];

// Fonctions utilitaires
function renderSkillBar($level) {
    return '<div class="skill-bar">
                <div class="skill-progress" data-width="' . $level . '%"></div>
            </div>';
}

function renderLanguageBar($level) {
    return '<div class="language-bar">
                <div class="language-progress" data-width="' . $level . '%"></div>
            </div>';
}

function renderIcon($icon) {
    return '<i class="' . $icon . '"></i>';
}

// Traitement du formulaire de contact
$contact_message = '';
$contact_error = '';

if ($_POST && isset($_POST['csrf_token']) && verifyCSRFToken($_POST['csrf_token'])) {
    $name = sanitizeInput($_POST['name'] ?? '');
    $email = sanitizeInput($_POST['email'] ?? '');
    $subject = sanitizeInput($_POST['subject'] ?? '');
    $message = sanitizeInput($_POST['message'] ?? '');
    
    if ($name && $email && $subject && $message && validateEmail($email)) {
        if (saveContactMessage($name, $email, $subject, $message)) {
            $contact_message = 'Message envoyé avec succès!';
            logActivity('contact_message', 'Nouveau message de contact de ' . $email);
            
            // Envoyer notification par email (optionnel)
            // sendContactNotification($name, $email, $subject, $message);
        } else {
            $contact_error = 'Erreur lors de l\'envoi du message.';
        }
    } else {
        $contact_error = 'Veuillez remplir tous les champs correctement.';
    }
}

// Log de la visite
logActivity('page_visit', 'Visite de la page portfolio');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $siteSettings['site_title'] ?? 'Portfolio DevOps Engineer'; ?></title>
    <meta name="description" content="<?php echo $siteSettings['meta_description'] ?? ''; ?>">
    <meta name="keywords" content="<?php echo $siteSettings['meta_keywords'] ?? ''; ?>">
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Styles -->
    <link rel="stylesheet" href="styles.css">
    
    <!-- Analytics (si configuré) -->
    <?php if (!empty($siteSettings['analytics_id'])): ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $siteSettings['analytics_id']; ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '<?php echo $siteSettings['analytics_id']; ?>');
    </script>
    <?php endif; ?>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar" id="navbar">
        <div class="nav-container">
            <div class="nav-logo">
                <span class="logo-text">Portfolio</span>
            </div>
            <div class="nav-menu" id="nav-menu">
                <?php foreach ($navigation as $nav): ?>
                    <a href="<?php echo $nav['link']; ?>" class="nav-link"><?php echo $nav['name']; ?></a>
                <?php endforeach; ?>
            </div>
            <div class="nav-toggle" id="nav-toggle">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="hero-background">
            <div class="floating-shapes">
                <div class="shape shape-1"></div>
                <div class="shape shape-2"></div>
                <div class="shape shape-3"></div>
                <div class="shape shape-4"></div>
            </div>
        </div>
        <div class="hero-container">
            <div class="hero-content">
                <div class="hero-text">
                    <h1 class="hero-title">
                        <span class="title-line"><?php echo $personal['name']; ?></span>
                        <span class="title-line highlight"><?php echo $personal['title']; ?></span>
                    </h1>
                    <p class="hero-subtitle">
                        <?php echo $personal['description']; ?>
                    </p>
                    <div class="hero-stats">
                        <?php foreach ($stats as $stat): ?>
                            <div class="stat">
                                <span class="stat-number"><?php echo $stat['number']; ?></span>
                                <span class="stat-label"><?php echo $stat['label']; ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="hero-buttons">
                        <a href="#contact" class="btn btn-primary">
                            <i class="fas fa-envelope"></i>
                            Me contacter
                        </a>
                        <a href="#projects" class="btn btn-secondary">
                            <i class="fas fa-briefcase"></i>
                            Voir mes projets
                        </a>
                    </div>
                </div>
                <div class="hero-image">
                    <div class="profile-card">
                        <div class="profile-image">
                            <img src="<?php echo $personal['photo_path']; ?>" alt="Photo de profil - <?php echo $personal['name']; ?>" class="profile-photo" loading="eager" onload="this.style.opacity='1'; this.nextElementSibling.style.display='none';" onerror="console.log('Erreur de chargement de l\'image'); this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <div class="image-placeholder">
                                <i class="fas fa-user-tie"></i>
                            </div>
                        </div>
                        <div class="profile-info">
                            <h3><?php echo $personal['name']; ?></h3>
                            <p><?php echo $personal['title']; ?></p>
                            <div class="profile-links">
                                <a href="mailto:<?php echo $personal['email']; ?>" class="profile-link">
                                    <i class="fas fa-envelope"></i>
                                </a>
                                <a href="tel:<?php echo str_replace(' ', '', $personal['phone']); ?>" class="profile-link">
                                    <i class="fas fa-phone"></i>
                                </a>
                                <a href="<?php echo $personal['linkedin_url']; ?>" class="profile-link" target="_blank">
                                    <i class="fab fa-linkedin"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="scroll-indicator">
            <div class="scroll-arrow">
                <i class="fas fa-chevron-down"></i>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">À propos de moi</h2>
                <p class="section-subtitle">Passionné par l'innovation technologique et l'agriculture durable</p>
            </div>
            <div class="about-content">
                <div class="about-text">
                    <div class="about-card">
                        <h3>Mon Profil</h3>
                        <p>
                            DevOps Engineer orienté résultats avec plusieurs années d'expérience, spécialisé dans 
                            l'infrastructure cloud, l'automatisation CI/CD et les solutions AgriTech innovantes. 
                            J'ai un historique prouvé d'implémentation de systèmes évolutifs servant des milliers 
                            d'utilisateurs tout en comblant les écarts technologiques dans les secteurs agricoles.
                        </p>
                        <p>
                            Expert en intégration de systèmes VoIP et pratiques DevOps modernes avec de solides 
                            capacités de leadership et de résolution de problèmes. J'aide les équipes de développement 
                            à adopter les meilleures pratiques DevOps pour optimiser les flux de travail et livrer 
                            des logiciels efficacement.
                        </p>
                    </div>
                    <div class="languages">
                        <h3>Langues</h3>
                        <?php foreach ($languages as $language): ?>
                            <div class="language-item">
                                <span class="language-name"><?php echo $language['name']; ?></span>
                                <?php echo renderLanguageBar($language['level']); ?>
                                <span class="language-percent"><?php echo $language['level']; ?>%</span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="about-image">
                    <div class="image-container">
                        <div class="tech-icons">
                            <?php foreach ($technologies as $tech): ?>
                                <div class="tech-icon" data-tooltip="<?php echo $tech['name']; ?>">
                                    <?php echo renderIcon($tech['icon']); ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section id="skills" class="skills">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Compétences Techniques</h2>
                <p class="section-subtitle">Expertise approfondie en DevOps, Cloud et développement</p>
            </div>
            <div class="skills-grid">
                <?php foreach ($skills as $category => $categoryData): ?>
                    <div class="skill-category">
                        <div class="category-header">
                            <?php echo renderIcon($categoryData['icon']); ?>
                            <h3><?php echo $category; ?></h3>
                        </div>
                        <div class="skill-items">
                            <?php foreach ($categoryData['items'] as $skill): ?>
                                <div class="skill-item">
                                    <span class="skill-name"><?php echo $skill['name']; ?></span>
                                    <?php echo renderSkillBar($skill['level']); ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Experience Section -->
    <section id="experience" class="experience">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Expérience Professionnelle</h2>
                <p class="section-subtitle">Transformation digitale dans le secteur agricole</p>
            </div>
            <div class="timeline">
                <?php foreach ($experience as $exp): ?>
                    <div class="timeline-item">
                        <div class="timeline-marker">
                            <div class="marker-icon">
                                <i class="fas fa-briefcase"></i>
                            </div>
                        </div>
                        <div class="timeline-content">
                            <div class="timeline-header">
                                <h3><?php echo $exp['title']; ?></h3>
                                <span class="timeline-company"><?php echo $exp['company']; ?></span>
                                <span class="timeline-period">
                                    <?php 
                                    echo date('Y', strtotime($exp['start_date']));
                                    if ($exp['end_date']) {
                                        echo ' - ' . date('Y', strtotime($exp['end_date']));
                                    } elseif ($exp['is_current']) {
                                        echo ' - Présent';
                                    }
                                    ?>
                                </span>
                            </div>
                            <div class="timeline-body">
                                <?php foreach ($exp['achievements'] as $section => $items): ?>
                                    <div class="achievement-section">
                                        <h4>
                                            <?php 
                                            $icons = [
                                                'DevOps' => 'fas fa-rocket',
                                                'VoIP & Télécommunications' => 'fas fa-phone',
                                                'Impact & Leadership' => 'fas fa-trophy'
                                            ];
                                            echo renderIcon($icons[$section] ?? 'fas fa-check'); 
                                            ?>
                                            <?php echo $section; ?>
                                        </h4>
                                        <ul>
                                            <?php foreach ($items as $item): ?>
                                                <li><?php echo $item; ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Education Section -->
    <section id="education" class="education">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Formation & Certifications</h2>
                <p class="section-subtitle">Excellence académique et certifications professionnelles</p>
            </div>
            <div class="education-grid">
                <?php foreach ($education as $edu): ?>
                    <div class="education-card">
                        <div class="card-icon">
                            <?php echo renderIcon($edu['icon']); ?>
                        </div>
                        <div class="card-content">
                            <h3><?php echo $edu['title']; ?></h3>
                            <p class="institution"><?php echo $edu['institution']; ?></p>
                            <span class="period">
                                <?php 
                                if ($edu['start_date'] && $edu['end_date']) {
                                    echo date('Y', strtotime($edu['start_date'])) . ' - ' . date('Y', strtotime($edu['end_date']));
                                } elseif ($edu['start_date']) {
                                    echo date('Y', strtotime($edu['start_date']));
                                }
                                ?>
                            </span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="projects">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Projets Réalisés</h2>
                <p class="section-subtitle">Solutions innovantes et réalisations techniques</p>
            </div>
            <div class="projects-grid">
                <?php foreach ($projects as $project): ?>
                    <div class="project-card">
                        <div class="project-image">
                            <?php if ($project['image_path']): ?>
                                <img src="<?php echo $project['image_path']; ?>" alt="<?php echo $project['title']; ?>">
                            <?php else: ?>
                                <div class="project-placeholder">
                                    <i class="fas fa-project-diagram"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="project-content">
                            <h3><?php echo $project['title']; ?></h3>
                            <p><?php echo $project['description']; ?></p>
                            <?php if ($project['technologies']): ?>
                                <div class="project-technologies">
                                    <strong>Technologies:</strong> <?php echo $project['technologies']; ?>
                                </div>
                            <?php endif; ?>
                            <div class="project-links">
                                <?php if ($project['project_url']): ?>
                                    <a href="<?php echo $project['project_url']; ?>" target="_blank" class="btn btn-primary">
                                        <i class="fas fa-external-link-alt"></i>
                                        Voir le projet
                                    </a>
                                <?php endif; ?>
                                <?php if ($project['github_url']): ?>
                                    <a href="<?php echo $project['github_url']; ?>" target="_blank" class="btn btn-secondary">
                                        <i class="fab fa-github"></i>
                                        Code source
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Contactez-moi</h2>
                <p class="section-subtitle">Prêt à transformer vos défis technologiques en opportunités</p>
            </div>
            <div class="contact-content">
                <div class="contact-info">
                    <div class="contact-card">
                        <div class="contact-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="contact-details">
                            <h3>Téléphone</h3>
                            <p><a href="tel:<?php echo str_replace(' ', '', $personal['phone']); ?>"><?php echo $personal['phone']; ?></a></p>
                        </div>
                    </div>
                    <div class="contact-card">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-details">
                            <h3>Email</h3>
                            <p><a href="mailto:<?php echo $personal['email']; ?>"><?php echo $personal['email']; ?></a></p>
                        </div>
                    </div>
                    <div class="contact-card">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="contact-details">
                            <h3>Adresse</h3>
                            <p><?php echo $personal['address']; ?></p>
                        </div>
                    </div>
                </div>
                <div class="contact-form">
                    <?php if ($contact_message): ?>
                        <div class="alert alert-success"><?php echo $contact_message; ?></div>
                    <?php endif; ?>
                    <?php if ($contact_error): ?>
                        <div class="alert alert-error"><?php echo $contact_error; ?></div>
                    <?php endif; ?>
                    <form id="contactForm" method="POST">
                        <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
                        <div class="form-group">
                            <input type="text" id="name" name="name" placeholder="Votre nom" required value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <input type="email" id="email" name="email" placeholder="Votre email" required value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" id="subject" name="subject" placeholder="Sujet" required value="<?php echo htmlspecialchars($_POST['subject'] ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <textarea id="message" name="message" placeholder="Votre message" rows="5" required><?php echo htmlspecialchars($_POST['message'] ?? ''); ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-full">
                            <i class="fas fa-paper-plane"></i>
                            Envoyer le message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-text">
                    <p>&copy; <?php echo date('Y'); ?> Portfolio DevOps Engineer. Tous droits réservés.</p>
                </div>
                <div class="footer-links">
                    <?php foreach ($navigation as $nav): ?>
                        <a href="<?php echo $nav['link']; ?>"><?php echo $nav['name']; ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="script.js"></script>
</body>
</html>
