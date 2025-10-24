-- Données initiales pour le portfolio DevOps Engineer
-- Insertion des données de base

USE portfolio_devops;

-- Insertion des informations personnelles
INSERT INTO personal_info (name, title, email, phone, address, linkedin_url, photo_path, description) VALUES
('DevOps and VoIP Engineer', 'Specialist', 'soum.inf2020@gmail.com', '+221 77 130 25 77', 'Dakar, Parcelles Assainies<br>Sénégal', 'https://linkedin.com/in/devops-agritech-senegal', 'foto.jpg', 'DevOps Engineer orienté résultats avec plusieurs années d\'expérience, spécialisé dans l\'infrastructure cloud, l\'automatisation CI/CD et les solutions AgriTech innovantes. Historique prouvé d\'implémentation de systèmes évolutifs servant des milliers d\'utilisateurs tout en comblant les écarts technologiques dans les secteurs agricoles. Expert en intégration de systèmes VoIP et pratiques DevOps modernes avec de solides capacités de leadership et de résolution de problèmes. J\'aide les équipes de développement à adopter les meilleures pratiques DevOps pour optimiser les flux de travail et livrer des logiciels efficacement.');

-- Insertion des statistiques
INSERT INTO statistics (number, label, display_order) VALUES
('70%', 'Réduction temps de déploiement', 1),
('500+', 'Utilisateurs connectés', 2),
('99.9%', 'Disponibilité système', 3);

-- Insertion des langues
INSERT INTO languages (name, level, display_order) VALUES
('Français', 100, 1),
('Anglais', 90, 2);

-- Insertion des catégories de compétences
INSERT INTO skill_categories (name, icon, display_order) VALUES
('DevOps & Cloud', 'fas fa-cloud', 1),
('Programmation & Data', 'fas fa-code', 2),
('Data Science & Analytics', 'fas fa-chart-line', 3);

-- Insertion des compétences
INSERT INTO skills (category_id, name, level, display_order) VALUES
-- DevOps & Cloud
(1, 'CI/CD Pipelines', 95, 1),
(1, 'GitHub Actions', 90, 2),
(1, 'AWS', 85, 3),
(1, 'Google Cloud Platform', 80, 4),
(1, 'Docker', 90, 5),
(1, 'Kubernetes', 85, 6),
-- Programmation & Data
(2, 'Python', 90, 1),
(2, 'Java', 85, 2),
(2, 'JavaScript', 80, 3),
(2, 'React Native', 75, 4),
(2, 'MySQL', 85, 5),
(2, 'PostgreSQL', 80, 6),
-- Data Science & Analytics
(3, 'Pandas', 85, 1),
(3, 'Redis', 80, 2),
(3, 'AWS S3', 90, 3);

-- Insertion des technologies
INSERT INTO technologies (name, icon, display_order) VALUES
('AWS', 'fab fa-aws', 1),
('Docker', 'fab fa-docker', 2),
('Kubernetes', 'fas fa-cube', 3),
('Python', 'fab fa-python', 4),
('JavaScript', 'fab fa-js-square', 5),
('React Native', 'fab fa-react', 6);

-- Insertion de l'expérience professionnelle
INSERT INTO experiences (title, company, start_date, end_date, is_current, description, display_order) VALUES
('DevOps & VoIP Engineer', 'TOLBI AgriTech Startup', '2022-01-01', '2025-12-31', TRUE, 'Expert en DevOps et VoIP pour une startup AgriTech innovante', 1);

-- Insertion des réalisations par expérience
INSERT INTO experience_achievements (experience_id, category, achievement, display_order) VALUES
-- Réalisations DevOps
(1, 'DevOps', 'Automatisation des pipelines de déploiement pour applications web et mobiles, réduisant le temps de déploiement de 70%', 1),
(1, 'DevOps', 'Implémentation de workflows CI/CD utilisant GitHub Actions et services AWS, améliorant la qualité du code et la fréquence de release', 2),
(1, 'DevOps', 'Conception d\'architecture cloud évolutive supportant des milliers de producteurs agricoles au Sénégal', 3),
(1, 'DevOps', 'Optimisation des coûts d\'infrastructure grâce à une gestion efficace des ressources et des implémentations d\'auto-scaling', 4),
-- VoIP & Télécommunications
(1, 'VoIP & Télécommunications', 'Architecture et déploiement de TOLBIWOMA - système complet de téléphonie IP pour plateforme agricole', 1),
(1, 'VoIP & Télécommunications', 'Intégration d\'un pont de communication permettant une connectivité transparente entre 500+ conseillers agricoles et fermiers', 2),
(1, 'VoIP & Télécommunications', 'Implémentation d\'une solution de téléphonie haute disponibilité avec 99.9% de temps de fonctionnement', 3),
(1, 'VoIP & Télécommunications', 'Configuration d\'infrastructure TRUNK-SIP avec tunneling sécurisé pour télécommunications fiables', 4),
(1, 'VoIP & Télécommunications', 'Gestion de l\'équilibrage de charge pour gérer les appels simultanés de milliers de producteurs du marché', 5),
-- Impact & Leadership
(1, 'Impact & Leadership', 'Pilotage de la transformation digitale dans le secteur agricole sénégalais grâce à des solutions technologiques innovantes', 1),
(1, 'Impact & Leadership', 'Garantie de la fiabilité du système grâce à une surveillance complète et une maintenance proactive', 2);

-- Insertion de l'éducation et certifications
INSERT INTO education (title, institution, start_date, end_date, icon, display_order) VALUES
('Master en Systèmes et Réseaux', 'Université Alioune Diop de Bambey (UADB), Sénégal', '2021-09-01', '2022-06-30', 'fas fa-graduation-cap', 1),
('Certification DevOps Professional', 'Certification Professionnelle', '2024-01-01', '2024-12-31', 'fas fa-certificate', 2),
('Certification Data Science', 'SoloLearn avec Python', '2024-01-01', '2024-12-31', 'fas fa-chart-bar', 3),
('Certification Anglais B1', 'Niveau Intermédiaire', '2024-01-01', '2024-12-31', 'fas fa-globe', 4);

-- Insertion des paramètres du site
INSERT INTO site_settings (setting_key, setting_value, description) VALUES
('site_title', 'Portfolio - DevOps and VoIP Engineer | Cloud & AgriTech Specialist', 'Titre principal du site'),
('meta_description', 'Portfolio professionnel d\'un DevOps and VoIP Engineer spécialisé en cloud infrastructure, CI/CD automation et solutions AgriTech innovantes.', 'Description meta pour le SEO'),
('meta_keywords', 'DevOps, VoIP, Cloud, AgriTech, CI/CD, AWS, Docker, Kubernetes', 'Mots-clés pour le SEO'),
('contact_email', 'soum.inf2020@gmail.com', 'Email de contact principal'),
('social_linkedin', 'https://linkedin.com/in/devops-agritech-senegal', 'Profil LinkedIn'),
('theme_color', '#6366f1', 'Couleur principale du thème'),
('analytics_id', '', 'ID Google Analytics (optionnel)'),
('maintenance_mode', '0', 'Mode maintenance (0=actif, 1=maintenance)');

-- Insertion d'un projet exemple
INSERT INTO projects (title, description, technologies, image_path, project_url, github_url, display_order) VALUES
('TOLBIWOMA - Système VoIP AgriTech', 'Système complet de téléphonie IP pour plateforme agricole permettant la connectivité entre conseillers agricoles et fermiers au Sénégal.', 'VoIP, SIP, AWS, Docker, Kubernetes', 'project-tolbiwoma.jpg', 'https://tolbi.com', '', 1),
('Pipeline CI/CD Automatisé', 'Pipeline de déploiement automatisé réduisant le temps de déploiement de 70% pour applications web et mobiles.', 'GitHub Actions, AWS, Docker, Kubernetes', 'project-cicd.jpg', '', 'https://github.com/devops/cicd-pipeline', 2);

-- Log d'activité initial
INSERT INTO activity_logs (action, description, ip_address) VALUES
('database_init', 'Initialisation de la base de données portfolio', '127.0.0.1'),
('data_insert', 'Insertion des données initiales du portfolio', '127.0.0.1');
