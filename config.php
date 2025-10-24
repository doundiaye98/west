<?php
// Configuration du portfolio - config.php
return [
    // Informations personnelles
    'personal' => [
        'name' => 'DevOps and VoIP Engineer',
        'title' => 'Specialist',
        'email' => 'soum.inf2020@gmail.com',
        'phone' => '+221 77 130 25 77',
        'address' => 'Dakar, Parcelles Assainies<br>Sénégal',
        'linkedin' => 'https://linkedin.com/in/devops-agritech-senegal',
        'photo' => 'foto.jpg'
    ],
    
    // SEO et métadonnées
    'seo' => [
        'page_title' => 'Portfolio - DevOps and VoIP Engineer | Cloud & AgriTech Specialist',
        'meta_description' => 'Portfolio professionnel d\'un DevOps and VoIP Engineer spécialisé en cloud infrastructure, CI/CD automation et solutions AgriTech innovantes.',
        'keywords' => 'DevOps, VoIP, Cloud, AgriTech, CI/CD, AWS, Docker, Kubernetes'
    ],
    
    // Description professionnelle
    'description' => 'DevOps Engineer orienté résultats avec plusieurs années d\'expérience, spécialisé dans l\'infrastructure cloud, l\'automatisation CI/CD et les solutions AgriTech innovantes. Historique prouvé d\'implémentation de systèmes évolutifs servant des milliers d\'utilisateurs tout en comblant les écarts technologiques dans les secteurs agricoles. Expert en intégration de systèmes VoIP et pratiques DevOps modernes avec de solides capacités de leadership et de résolution de problèmes. J\'aide les équipes de développement à adopter les meilleures pratiques DevOps pour optimiser les flux de travail et livrer des logiciels efficacement.',
    
    // Statistiques
    'stats' => [
        ['number' => '70%', 'label' => 'Réduction temps de déploiement'],
        ['number' => '500+', 'label' => 'Utilisateurs connectés'],
        ['number' => '99.9%', 'label' => 'Disponibilité système']
    ],
    
    // Langues
    'languages' => [
        ['name' => 'Français', 'level' => 100],
        ['name' => 'Anglais', 'level' => 90]
    ],
    
    // Compétences techniques
    'skills' => [
        'DevOps & Cloud' => [
            'icon' => 'fas fa-cloud',
            'items' => [
                ['name' => 'CI/CD Pipelines', 'level' => 95],
                ['name' => 'GitHub Actions', 'level' => 90],
                ['name' => 'AWS', 'level' => 85],
                ['name' => 'Google Cloud Platform', 'level' => 80],
                ['name' => 'Docker', 'level' => 90],
                ['name' => 'Kubernetes', 'level' => 85]
            ]
        ],
        'Programmation & Data' => [
            'icon' => 'fas fa-code',
            'items' => [
                ['name' => 'Python', 'level' => 90],
                ['name' => 'Java', 'level' => 85],
                ['name' => 'JavaScript', 'level' => 80],
                ['name' => 'React Native', 'level' => 75],
                ['name' => 'MySQL', 'level' => 85],
                ['name' => 'PostgreSQL', 'level' => 80]
            ]
        ],
        'Data Science & Analytics' => [
            'icon' => 'fas fa-chart-line',
            'items' => [
                ['name' => 'Pandas', 'level' => 85],
                ['name' => 'Redis', 'level' => 80],
                ['name' => 'AWS S3', 'level' => 90]
            ]
        ]
    ],
    
    // Technologies
    'technologies' => [
        ['name' => 'AWS', 'icon' => 'fab fa-aws'],
        ['name' => 'Docker', 'icon' => 'fab fa-docker'],
        ['name' => 'Kubernetes', 'icon' => 'fas fa-cube'],
        ['name' => 'Python', 'icon' => 'fab fa-python'],
        ['name' => 'JavaScript', 'icon' => 'fab fa-js-square'],
        ['name' => 'React Native', 'icon' => 'fab fa-react']
    ],
    
    // Expérience professionnelle
    'experience' => [
        [
            'title' => 'DevOps & VoIP Engineer',
            'company' => 'TOLBI AgriTech Startup',
            'period' => '2022 - 2025',
            'achievements' => [
                'DevOps' => [
                    'Automatisation des pipelines de déploiement pour applications web et mobiles, réduisant le temps de déploiement de 70%',
                    'Implémentation de workflows CI/CD utilisant GitHub Actions et services AWS, améliorant la qualité du code et la fréquence de release',
                    'Conception d\'architecture cloud évolutive supportant des milliers de producteurs agricoles au Sénégal',
                    'Optimisation des coûts d\'infrastructure grâce à une gestion efficace des ressources et des implémentations d\'auto-scaling'
                ],
                'VoIP & Télécommunications' => [
                    'Architecture et déploiement de TOLBIWOMA - système complet de téléphonie IP pour plateforme agricole',
                    'Intégration d\'un pont de communication permettant une connectivité transparente entre 500+ conseillers agricoles et fermiers',
                    'Implémentation d\'une solution de téléphonie haute disponibilité avec 99.9% de temps de fonctionnement',
                    'Configuration d\'infrastructure TRUNK-SIP avec tunneling sécurisé pour télécommunications fiables',
                    'Gestion de l\'équilibrage de charge pour gérer les appels simultanés de milliers de producteurs du marché'
                ],
                'Impact & Leadership' => [
                    'Pilotage de la transformation digitale dans le secteur agricole sénégalais grâce à des solutions technologiques innovantes',
                    'Garantie de la fiabilité du système grâce à une surveillance complète et une maintenance proactive'
                ]
            ]
        ]
    ],
    
    // Formation et certifications
    'education' => [
        [
            'title' => 'Master en Systèmes et Réseaux',
            'institution' => 'Université Alioune Diop de Bambey (UADB), Sénégal',
            'period' => '2021 - 2022',
            'icon' => 'fas fa-graduation-cap'
        ],
        [
            'title' => 'Certification DevOps Professional',
            'institution' => 'Certification Professionnelle',
            'period' => '2024',
            'icon' => 'fas fa-certificate'
        ],
        [
            'title' => 'Certification Data Science',
            'institution' => 'SoloLearn avec Python',
            'period' => '2024',
            'icon' => 'fas fa-chart-bar'
        ],
        [
            'title' => 'Certification Anglais B1',
            'institution' => 'Niveau Intermédiaire',
            'period' => '2024',
            'icon' => 'fas fa-globe'
        ]
    ],
    
    // Navigation
    'navigation' => [
        ['name' => 'Accueil', 'link' => '#home'],
        ['name' => 'À propos', 'link' => '#about'],
        ['name' => 'Compétences', 'link' => '#skills'],
        ['name' => 'Expérience', 'link' => '#experience'],
        ['name' => 'Formation', 'link' => '#education'],
        ['name' => 'Contact', 'link' => '#contact']
    ]
];
