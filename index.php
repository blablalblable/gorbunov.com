<?php
/**
 * Лабораторная работа №14
 * Тема: Метод GET, модификаторы доступа, типы данных
 * Выполнил: Gorbunov
 * Группа: 9ПО-31
 */

// ============================================================
// КЛАСС Page (базовый класс)
// ============================================================
class Page {
    // Приватные свойства с типами данных
    private string $name;
    private string $template;
    
    // Конструктор с типизацией параметров
    public function __construct(string $name = "page", string $template = "<div><p>It is a default page</p></div>") {
        $this->name = $name;
        $this->template = $template;
    }
    
    // Публичный метод render() для вывода шаблона
    public function render(): void {
        echo $this->template;
    }
    
    // Геттеры для доступа к приватным свойствам
    public function getName(): string {
        return $this->name;
    }
    
    public function getTemplate(): string {
        return $this->template;
    }
}

// ============================================================
// КЛАСС BlogPage (наследуется от Page)
// ============================================================
class BlogPage extends Page {
    
    // Конструктор с вызовом родительского конструктора
    public function __construct() {
        // Создаем шаблон с карточками блога
        $blogTemplate = '
        <div class="blog-container">
            <div class="card">
                <img src="https://via.placeholder.com/300x200/667eea/ffffff?text=JavaScript" alt="JS">
                <h3>📚 The Best JavaScript Libraries</h3>
                <p>Обзор лучших библиотек JavaScript для веб-разработки в 2024 году.</p>
                <a href="#" class="btn">Читать далее</a>
            </div>
            
            <div class="card">
                <img src="https://via.placeholder.com/300x200/764ba2/ffffff?text=CSS" alt="CSS">
                <h3>🎨 Modern CSS Techniques</h3>
                <p>Современные техники CSS для создания красивых интерфейсов.</p>
                <a href="#" class="btn">Читать далее</a>
            </div>
            
            <div class="card">
                <img src="https://via.placeholder.com/300x200/f093fb/ffffff?text=PHP" alt="PHP">
                <h3>⚡ PHP 8.3 Features</h3>
                <p>Новые возможности PHP 8.3 и как их использовать в проектах.</p>
                <a href="#" class="btn">Читать далее</a>
            </div>
        </div>';
        
        // Вызов конструктора родителя
        parent::__construct("blog", $blogTemplate);
    }
}

// ============================================================
// КЛАСС AboutPage (дополнительная страница)
// ============================================================
class AboutPage extends Page {
    
    public function __construct() {
        $aboutTemplate = '
        <div class="about-container">
            <h2>👨‍💻 О проекте</h2>
            <p><strong>Выполнил:</strong> Gorbunov</p>
            <p><strong>Группа:</strong> 9ПО-31</p>
            <p><strong>Лабораторная работа №14</strong></p>
            <p>Эта работа демонстрирует работу с:</p>
            <ul>
                <li>✅ Методом GET и суперглобальной переменной $_GET</li>
                <li>✅ Модификаторами доступа (public, private, protected)</li>
                <li>✅ Типизацией данных в PHP</li>
                <li>✅ Наследованием классов</li>
            </ul>
            <p><strong>GitHub:</strong> <a href="https://github.com/blablalblable/gorbunov.com" target="_blank">github.com/blablalblable/gorbunov.com</a></p>
        </div>';
        
        parent::__construct("about", $aboutTemplate);
    }
}

// ============================================================
// ЛОГИКА ОТОБРАЖЕНИЯ СТРАНИЦ
// ============================================================

// Получаем параметр page из GET-запроса с проверкой
$pageName = isset($_GET['page']) ? $_GET['page'] : 'page';

// Создаем объект нужной страницы в зависимости от параметра
switch ($pageName) {
    case 'blog':
        $currentPage = new BlogPage();
        break;
    case 'about':
        $currentPage = new AboutPage();
        break;
    case 'page':
    default:
        $currentPage = new Page();
        break;
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ЛЗ №14 - GET метод и ООП - Gorbunov 9ПО-31</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
            color: #333;
        }
        
        .container {
            max-width: 1000px;
            margin: 0 auto;
        }
        
        /* Навигация */
        .nav {
            background: white;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 30px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            text-align: center;
        }
        
        .nav h1 {
            color: #667eea;
            margin-bottom: 20px;
            font-size: 1.8em;
        }
        
        .nav-links {
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }
        
        .nav-link {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: transform 0.2s, box-shadow 0.2s;
            display: inline-block;
        }
        
        .nav-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
        }
        
        .nav-link.active {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }
        
        /* Контент страницы */
        .content {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            min-height: 400px;
        }
        
        .content h2 {
            color: #667eea;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 3px solid #764ba2;
        }
        
        /* Карточки блога */
        .blog-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            margin-top: 20px;
        }
        
        .card {
            background: #f8f9fa;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        
        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        
        .card h3 {
            padding: 15px 15px 10px;
            color: #333;
            font-size: 1.2em;
        }
        
        .card p {
            padding: 0 15px 15px;
            color: #666;
            line-height: 1.6;
        }
        
        .card .btn {
            display: inline-block;
            margin: 0 15px 15px;
            padding: 8px 20px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.2s;
        }
        
        .card .btn:hover {
            background: #764ba2;
        }
        
        /* О проекте */
        .about-container ul {
            margin: 15px 0 15px 30px;
            line-height: 2;
        }
        
        .about-container a {
            color: #667eea;
            text-decoration: none;
        }
        
        .about-container a:hover {
            text-decoration: underline;
        }
        
        /* Информация о GET параметре */
        .get-info {
            background: #e8f5e9;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
            border-left: 4px solid #4CAF50;
        }
        
        .get-info code {
            background: #f5f5f5;
            padding: 2px 6px;
            border-radius: 3px;
            font-family: monospace;
        }
        
        /* Footer */
        .footer {
            text-align: center;
            margin-top: 30px;
            padding: 20px;
            color: white;
        }
        
        .footer a {
            color: #fff;
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">

    <!-- Навигация -->
    <div class="nav">
        <h1>🌐 ЛЗ №14: Метод GET и модификаторы доступа</h1>
        
        <div class="nav-links">
            <!-- Ссылка 1: Главная страница (Page) -->
            <a href="?page=page" class="nav-link <?= $pageName === 'page' ? 'active' : '' ?>">
                🏠 Главная (Page)
            </a>
            
            <!-- Ссылка 2: Блог (BlogPage) -->
            <a href="?page=blog" class="nav-link <?= $pageName === 'blog' ? 'active' : '' ?>">
                📝 Блог (BlogPage)
            </a>
            
            <!-- Ссылка 3: О проекте (AboutPage) -->
            <a href="?page=about" class="nav-link <?= $pageName === 'about' ? 'active' : '' ?>">
                ℹ️ О проекте (AboutPage)
            </a>
        </div>
        
        <div class="get-info">
            <strong>📊 Текущий GET параметр:</strong> 
            <code>$_GET['page'] = '<?= htmlspecialchars($pageName) ?>'</code>
            <br><small>Текущая страница: <strong><?= htmlspecialchars($currentPage->getName()) ?></strong></small>
        </div>
    </div>

    <!-- Контент страницы -->
    <div class="content">
        <?php
        // Отображаем текущую страницу через метод render()
        $currentPage->render();
        ?>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>🎓 <strong>Лабораторная работа №14 выполнена</strong></p>
        <p><strong>Gorbunov | Группа 9ПО-31</strong></p>
        <p>📅 <?= date('d.m.Y H:i') ?> | PHP <?= PHP_VERSION ?></p>
        <p>🔗 <a href="https://github.com/blablalblable/gorbunov.com" target="_blank">
            github.com/blablalblable/gorbunov.com
        </a></p>
    </div>

</div>
</body>
</html>
