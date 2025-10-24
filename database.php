<?php
/**
 * Configuration de la base de données Portfolio DevOps Engineer
 * Fichier de connexion et fonctions utilitaires
 */

// Configuration de la base de données
define('DB_HOST', 'localhost');
define('DB_NAME', 'portfolio_devops');
define('DB_USER', 'root');
define('DB_PASS', ' root');
define('DB_CHARSET', 'utf8mb4');

// Configuration du site
define('SITE_URL', 'http://localhost/portfolio-west');
define('SITE_NAME', 'Portfolio DevOps Engineer');
define('ADMIN_EMAIL', 'soum.inf2020@gmail.com');

// Configuration de sécurité
define('ENCRYPTION_KEY', 'your-secret-key-here-change-this');
define('SESSION_TIMEOUT', 3600); // 1 heure

/**
 * Connexion à la base de données
 */
function getDBConnection() {
    try {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . DB_CHARSET
        ];
        
        $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        return $pdo;
    } catch (PDOException $e) {
        error_log("Erreur de connexion à la base de données: " . $e->getMessage());
        return null; // Retourner null au lieu de die()
    }
}

/**
 * Récupérer les informations personnelles
 */
function getPersonalInfo() {
    $pdo = getDBConnection();
    if (!$pdo) {
        // Données par défaut si pas de base de données
        return [
            'name' => 'Oumar Inf',
            'title' => 'DevOps Engineer',
            'email' => 'oum.inf2020@gmail.com',
            'phone' => '+221 77 130 25 77',
            'address' => 'Dakar, Senegal',
            'linkedin_url' => 'https://linkedin.com/in/oumar-inf',
            'photo_path' => 'foto.jpg',
            'description' => 'DevOps Engineer orienté résultats avec plusieurs années d\'expérience, spécialisé dans l\'infrastructure cloud, l\'automatisation CI/CD et les solutions AgriTech innovantes.'
        ];
    }
    $stmt = $pdo->prepare("SELECT * FROM personal_info LIMIT 1");
    $stmt->execute();
    return $stmt->fetch();
}

/**
 * Récupérer les statistiques
 */
function getStatistics() {
    $pdo = getDBConnection();
    if (!$pdo) {
        // Données par défaut si pas de base de données
        return [
            ['number' => '5+', 'label' => 'Années d\'expérience'],
            ['number' => '50+', 'label' => 'Projets réalisés'],
            ['number' => '100%', 'label' => 'Satisfaction client']
        ];
    }
    $stmt = $pdo->prepare("SELECT * FROM statistics WHERE is_active = 1 ORDER BY display_order ASC");
    $stmt->execute();
    return $stmt->fetchAll();
}

/**
 * Récupérer les langues
 */
function getLanguages() {
    $pdo = getDBConnection();
    if (!$pdo) {
        // Données par défaut si pas de base de données
        return [
            ['name' => 'Français', 'level' => 95],
            ['name' => 'Anglais', 'level' => 85],
            ['name' => 'Wolof', 'level' => 100]
        ];
    }
    $stmt = $pdo->prepare("SELECT * FROM languages WHERE is_active = 1 ORDER BY display_order ASC");
    $stmt->execute();
    return $stmt->fetchAll();
}

/**
 * Récupérer les compétences avec leurs catégories
 */
function getSkills() {
    $pdo = getDBConnection();
    if (!$pdo) {
        // Données par défaut si pas de base de données
        return [
            'DevOps & Cloud' => [
                'icon' => 'fas fa-cloud',
                'items' => [
                    ['name' => 'Docker', 'level' => 90],
                    ['name' => 'Kubernetes', 'level' => 85],
                    ['name' => 'AWS', 'level' => 88],
                    ['name' => 'CI/CD', 'level' => 92]
                ]
            ],
            'Développement' => [
                'icon' => 'fas fa-code',
                'items' => [
                    ['name' => 'PHP', 'level' => 90],
                    ['name' => 'Python', 'level' => 85],
                    ['name' => 'JavaScript', 'level' => 80],
                    ['name' => 'Bash', 'level' => 88]
                ]
            ]
        ];
    }
    $stmt = $pdo->prepare("
        SELECT sc.name as category_name, sc.icon as category_icon, sc.display_order as category_order,
               s.name as skill_name, s.level, s.display_order as skill_order
        FROM skill_categories sc
        LEFT JOIN skills s ON sc.id = s.category_id
        WHERE sc.is_active = 1 AND (s.is_active = 1 OR s.is_active IS NULL)
        ORDER BY sc.display_order ASC, s.display_order ASC
    ");
    $stmt->execute();
    
    $skills = [];
    while ($row = $stmt->fetch()) {
        if (!isset($skills[$row['category_name']])) {
            $skills[$row['category_name']] = [
                'icon' => $row['category_icon'],
                'items' => []
            ];
        }
        if ($row['skill_name']) {
            $skills[$row['category_name']]['items'][] = [
                'name' => $row['skill_name'],
                'level' => $row['level']
            ];
        }
    }
    
    return $skills;
}

/**
 * Récupérer les technologies
 */
function getTechnologies() {
    $pdo = getDBConnection();
    if (!$pdo) {
        // Données par défaut si pas de base de données
        return [
            ['name' => 'Docker', 'icon' => 'fab fa-docker'],
            ['name' => 'Kubernetes', 'icon' => 'fas fa-cube'],
            ['name' => 'AWS', 'icon' => 'fab fa-aws'],
            ['name' => 'PHP', 'icon' => 'fab fa-php'],
            ['name' => 'Python', 'icon' => 'fab fa-python'],
            ['name' => 'JavaScript', 'icon' => 'fab fa-js']
        ];
    }
    $stmt = $pdo->prepare("SELECT * FROM technologies WHERE is_active = 1 ORDER BY display_order ASC");
    $stmt->execute();
    return $stmt->fetchAll();
}

/**
 * Récupérer les expériences professionnelles
 */
function getExperiences() {
    $pdo = getDBConnection();
    if (!$pdo) {
        // Données par défaut si pas de base de données
        return [
            [
                'title' => 'DevOps Engineer',
                'company' => 'AgriTech Solutions',
                'start_date' => '2020-01-01',
                'end_date' => null,
                'is_current' => 1,
                'achievements' => [
                    'DevOps' => [
                        'Mise en place de pipelines CI/CD',
                        'Automatisation des déploiements'
                    ],
                    'Impact & Leadership' => [
                        'Réduction de 50% du temps de déploiement',
                        'Amélioration de la disponibilité à 99.9%'
                    ]
                ]
            ]
        ];
    }
    $stmt = $pdo->prepare("SELECT * FROM experiences WHERE is_active = 1 ORDER BY display_order ASC");
    $stmt->execute();
    $experiences = $stmt->fetchAll();
    
    // Récupérer les réalisations pour chaque expérience
    foreach ($experiences as &$exp) {
        $stmt = $pdo->prepare("
            SELECT category, achievement, display_order 
            FROM experience_achievements 
            WHERE experience_id = ? AND is_active = 1 
            ORDER BY display_order ASC
        ");
        $stmt->execute([$exp['id']]);
        $achievements = $stmt->fetchAll();
        
        $exp['achievements'] = [];
        foreach ($achievements as $achievement) {
            $exp['achievements'][$achievement['category']][] = $achievement['achievement'];
        }
    }
    
    return $experiences;
}

/**
 * Récupérer l'éducation et certifications
 */
function getEducation() {
    $pdo = getDBConnection();
    if (!$pdo) {
        // Données par défaut si pas de base de données
        return [
            [
                'title' => 'Master en Informatique',
                'institution' => 'Université de Dakar',
                'start_date' => '2018-01-01',
                'end_date' => '2020-12-31',
                'icon' => 'fas fa-graduation-cap'
            ],
            [
                'title' => 'Certification AWS',
                'institution' => 'Amazon Web Services',
                'start_date' => '2021-06-01',
                'end_date' => null,
                'icon' => 'fas fa-certificate'
            ]
        ];
    }
    $stmt = $pdo->prepare("SELECT * FROM education WHERE is_active = 1 ORDER BY display_order ASC");
    $stmt->execute();
    return $stmt->fetchAll();
}

/**
 * Récupérer les projets
 */
function getProjects() {
    $pdo = getDBConnection();
    if (!$pdo) {
        // Données par défaut si pas de base de données
        return [
            [
                'title' => 'Plateforme AgriTech',
                'description' => 'Solution complète pour la gestion agricole avec IoT et analytics',
                'technologies' => 'Docker, Kubernetes, Python, React',
                'project_url' => 'https://example.com',
                'github_url' => 'https://github.com',
                'image_path' => ''
            ],
            [
                'title' => 'Pipeline CI/CD',
                'description' => 'Automatisation complète des déploiements avec monitoring',
                'technologies' => 'Jenkins, Docker, AWS, Terraform',
                'project_url' => 'https://example.com',
                'github_url' => 'https://github.com',
                'image_path' => ''
            ]
        ];
    }
    $stmt = $pdo->prepare("SELECT * FROM projects WHERE is_active = 1 ORDER BY display_order ASC");
    $stmt->execute();
    return $stmt->fetchAll();
}

/**
 * Sauvegarder un message de contact
 */
function saveContactMessage($name, $email, $subject, $message) {
    $pdo = getDBConnection();
    if (!$pdo) {
        // Si pas de base de données, on simule un succès
        error_log("Contact message from $email: $subject");
        return true;
    }
    $stmt = $pdo->prepare("
        INSERT INTO contact_messages (name, email, subject, message, ip_address, user_agent) 
        VALUES (?, ?, ?, ?, ?, ?)
    ");
    
    $ip = $_SERVER['REMOTE_ADDR'] ?? '';
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
    
    return $stmt->execute([$name, $email, $subject, $message, $ip, $userAgent]);
}

/**
 * Récupérer les paramètres du site
 */
function getSiteSettings() {
    $pdo = getDBConnection();
    if (!$pdo) {
        // Données par défaut si pas de base de données
        return [
            'site_title' => 'Portfolio DevOps Engineer',
            'meta_description' => 'Portfolio d\'un DevOps Engineer spécialisé en cloud et automatisation',
            'meta_keywords' => 'devops, cloud, aws, docker, kubernetes',
            'analytics_id' => ''
        ];
    }
    $stmt = $pdo->prepare("SELECT setting_key, setting_value FROM site_settings");
    $stmt->execute();
    
    $settings = [];
    while ($row = $stmt->fetch()) {
        $settings[$row['setting_key']] = $row['setting_value'];
    }
    
    return $settings;
}

/**
 * Logger une activité
 */
function logActivity($action, $description = '') {
    $pdo = getDBConnection();
    if (!$pdo) {
        // Si pas de base de données, on log juste dans les logs PHP
        error_log("Activity: $action - $description");
        return;
    }
    $stmt = $pdo->prepare("
        INSERT INTO activity_logs (action, description, ip_address, user_agent) 
        VALUES (?, ?, ?, ?)
    ");
    
    $ip = $_SERVER['REMOTE_ADDR'] ?? '';
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
    
    $stmt->execute([$action, $description, $ip, $userAgent]);
}

/**
 * Fonction de sécurité pour nettoyer les données
 */
function sanitizeInput($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

/**
 * Fonction pour valider un email
 */
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * Fonction pour générer un token CSRF
 */
function generateCSRFToken() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    
    return $_SESSION['csrf_token'];
}

/**
 * Fonction pour vérifier un token CSRF
 */
function verifyCSRFToken($token) {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Fonction pour envoyer un email de notification
 */
function sendContactNotification($name, $email, $subject, $message) {
    $to = ADMIN_EMAIL;
    $emailSubject = "Nouveau message de contact - " . $subject;
    $emailBody = "
        Nouveau message reçu depuis le portfolio :
        
        Nom: $name
        Email: $email
        Sujet: $subject
        
        Message:
        $message
        
        ---
        Envoyé depuis le portfolio DevOps Engineer
    ";
    
    $headers = [
        'From: ' . ADMIN_EMAIL,
        'Reply-To: ' . $email,
        'X-Mailer: PHP/' . phpversion(),
        'Content-Type: text/plain; charset=UTF-8'
    ];
    
    return mail($to, $emailSubject, $emailBody, implode("\r\n", $headers));
}
