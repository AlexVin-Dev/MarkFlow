

 <?php
require_once 'includes/Parsedown.php';
$parsedown = new Parsedown();

// Безопасное получение имени страницы
$page = isset($_GET['page']) ? preg_replace('/[^a-zA-Z0-9\-_]/', '', $_GET['page']) : 'main';
$mdFile = "markdown/{$page}.md";

// Установка значений по умолчанию
$title = 'MarkFlow';
$description = 'Идея плавного потока от текста к публикации';
$content = '';

// Обработка Markdown-файла
if (file_exists($mdFile)) {
    $mdContent = file_get_contents($mdFile);
    
    // Парсинг Front Matter
    if (preg_match('/^---\s*[\r\n]+(.*?)[\r\n]+---\s*[\r\n]+(.*)/s', $mdContent, $matches)) {
        // Простой парсинг YAML (только title и description)
        foreach (explode("\n", $matches[1]) as $line) {
            if (preg_match('/^\s*([^:]+):\s*"(.*?)"\s*$/', $line, $fm)) {
                if ($fm[1] === 'title') $title = htmlspecialchars($fm[2]);
                if ($fm[1] === 'description') $description = htmlspecialchars($fm[2]);
            }
        }
        $content = $matches[2];
    } else {
        $content = $mdContent;
    }
} else {
    // Файл 404
    $mdFile = 'markdown/404.md';
    $content = file_exists($mdFile) ? file_get_contents($mdFile) : 'Страница не найдена';
}

// Установка темы из localStorage
$currentTheme = isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 'dark';
?>
<!DOCTYPE html>
<html lang="ru" class="<?= $currentTheme === 'dark' ? 'dark' : '' ?>">
<head>
    <?php include 'includes/header.php'; ?>
</head>
<body class="h-full min-h-screen bg-gray-50 dark:bg-gray-900 flex flex-col">
    <!-- Навбар -->
    <nav class="fixed w-full bg-white dark:bg-gray-800 shadow-sm z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="?page=main" class="flex-shrink-0 flex items-center">
                        <span class="text-2xl">🔖</span>
                        <span class="ml-2 text-xl font-bold text-gray-900 dark:text-white">MarkFlow</span>
                    </a>
                </div>
                
                <div class="hidden sm:ml-6 sm:flex sm:items-center space-x-4">

                    
                    <a href="?page=main" class="px-3 py-2 rounded-md text-sm font-medium <?= $page === 'main' ? 'bg-indigo-100 dark:bg-gray-700 text-indigo-700 dark:text-white' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' ?>">
                        Главная
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Основной контент -->
    <main class="flex-1 pt-10">
        <div class="h-full">
            <article class="prose dark:prose-invert prose-lg max-w-none h-full bg-white dark:bg-gray-800 p-0">
                <div class="h-full min-h-screen p-8">
                    <?= $parsedown->text($content) ?>
                </div>
            </article>
        </div>
    </main>

    <!-- Футер -->
<?php include 'includes/footer.php'; ?>
    <!-- Скрипты -->

</body>
</html>
