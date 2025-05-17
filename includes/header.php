    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> | MarkFlow</title>
    <meta name="description" content="<?= $description ?>">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Кастомные стили для типографики */
        .prose {
            color: #374151;
        }
        
        .dark .prose {
            color: #e5e7eb;
        }
        
        .prose a {
            text-decoration: none;
            font-weight: 500;
            color: #6366f1;
        }
        
        .dark .prose a {
            color: #818cf8;
        }
        
        .prose pre {
            background-color: #1e293b;
            color: #f8fafc;
            padding: 1rem;
            border-radius: 0.5rem;
            overflow-x: auto;
        }
        
        .prose code:not(pre code) {
            background-color: #e2e8f0;
            padding: 0.2em 0.4em;
            border-radius: 0.25em;
            font-size: 0.9em;
        }
        
        .dark .prose code:not(pre code) {
            background-color: #374151;
            color: #f3f4f6;
        }
    </style>
