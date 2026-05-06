<?php
/**
 * Лабораторная работа №11: Работа с файлами в PHP
 * Выполнил: Gorbunov
 * Группа: 9ПО-31
 * Репозиторий: github.com/blablalblable/gorbunov.com
 */

// Базовая директория для работы с файлами
$baseDir = __DIR__ . '/files';

// Функция для форматирования размера файла
function formatSize($bytes) {
    $units = ['B', 'KB', 'MB', 'GB', 'TB'];
    $bytes = max(0, $bytes);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);
    $bytes /= pow(1024, $pow);
    return round($bytes, 2) . ' ' . $units[$pow];
}

// Функция для вывода сообщений
function message($text, $type = 'info') {
    $colors = [
        'success' => '#2ecc71',
        'error' => '#e74c3c',
        'warning' => '#f39c12',
        'info' => '#3498db'
    ];
    $color = $colors[$type] ?? $colors['info'];
    echo "<div style='padding:10px;margin:10px 0;background:#f8f9fa;border-left:4px solid {$color};border-radius:4px;'>";
    echo "<strong>[{$type}]</strong> " . htmlspecialchars($text);
    echo "</div>";
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ЛЗ №11 - Работа с файлами - Gorbunov 9ПО-31</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            color: #ecf0f1;
        }
        .container {
            background: #1e1e2f;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.4);
        }
        h1 {
            color: #00d4aa;
            border-bottom: 3px solid #00d4aa;
            padding-bottom: 15px;
            margin-top: 0;
            text-align: center;
        }
        h2 {
            color: #7b68ee;
            margin: 25px 0 15px;
            font-size: 1.2em;
            border-left: 4px solid #00d4aa;
            padding-left: 12px;
        }
        .task {
            background: #2a2a3e;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            border: 1px solid #3a3a5e;
        }
        .result {
            background: #16213e;
            padding: 12px 18px;
            border-radius: 6px;
            margin: 10px 0;
            font-family: 'Fira Code', monospace;
            border-left: 3px solid #00d4aa;
            white-space: pre-wrap;
            word-break: break-all;
        }
        .result.success { border-left-color: #2ecc71; }
        .result.error { border-left-color: #e74c3c; }
        .result.warning { border-left-color: #f39c12; }
        
        code {
            background: #0d0d1a;
            color: #00d4aa;
            padding: 2px 8px;
            border-radius: 4px;
            font-family: 'Fira Code', monospace;
        }
        pre {
            background: #0d0d1a;
            padding: 15px;
            border-radius: 6px;
            overflow-x: auto;
            margin: 10px 0;
        }
        pre code {
            background: none;
            padding: 0;
            color: #e0e0e0;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
        }
        th, td {
            padding: 10px;
            border: 1px solid #3a3a5e;
            text-align: left;
        }
        th {
            background: #00d4aa;
            color: #1a1a2e;
            font-weight: bold;
        }
        
        .footer {
            text-align: center;
            margin-top: 30px;
            padding: 20px;
            background: #0d0d1a;
            border-radius: 8px;
            color: #95a5a6;
        }
        .badge {
            display: inline-block;
            background: #00d4aa;
            color: #1a1a2e;
            padding: 3px 10px;
            border-radius: 12px;
            font-size: 0.85em;
            font-weight: bold;
            margin-left: 10px;
        }
        .file-tag {
            background: #7b68ee;
            color: white;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 0.9em;
            margin-right: 5px;
        }
        a { color: #00d4aa; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
<div class="container">

    <h1>📁 ЛЗ №11: Работа с файлами в PHP <span class="badge">Gorbunov 9ПО-31</span></h1>

    <?php
    // ============================================================
    // ЗАДАНИЕ ЧАСТЬ 1
    // ============================================================
    ?>

    <!-- ЗАДАНИЕ 1.1: Создание файла и запись -->
    <div class="task">
        <h2>📝 Задание 1.1: Создать 'test.txt' и записать 'Привет, мир!'</h2>
        <?php
        $testFile = $baseDir . '/test.txt';
        $content = 'Привет, мир!';
        
        // Запись в файл
        $file = fopen($testFile, 'w');
        if ($file) {
            fwrite($file, $content);
            fclose($file);
            message("✅ Файл '$testFile' создан и записан: '$content'", 'success');
        } else {
            message("❌ Ошибка создания файла", 'error');
        }
        
        // Проверка существования
        if (file_exists($testFile)) {
            echo "<div class='result success'>";
            echo "📄 Файл существует: <code>" . basename($testFile) . "</code><br>";
            echo "📏 Размер: " . filesize($testFile) . " байт";
            echo "</div>";
        }
        ?>
    </div>

    <!-- ЗАДАНИЕ 1.2: Чтение из файла -->
    <div class="task">
        <h2>📖 Задание 1.2: Считать данные из 'test.txt' и вывести на экран</h2>
        <?php
        if (file_exists($testFile)) {
            $file = fopen($testFile, 'r');
            if ($file) {
                echo "<p><strong>Чтение файла построчно:</strong></p>";
                echo "<div class='result'>";
                while (!feof($file)) {
                    $line = fgets($file);
                    echo htmlspecialchars($line) . "<br>";
                }
                echo "</div>";
                fclose($file);
                message("✅ Файл успешно прочитан", 'success');
            }
        } else {
            message("❌ Файл не найден", 'error');
        }
        
        // Альтернативный способ: file_get_contents
        echo "<p><strong>Альтернативный способ (file_get_contents):</strong></p>";
        $content = file_get_contents($testFile);
        echo "<div class='result success'>" . htmlspecialchars($content) . "</div>";
        ?>
    </div>

    <!-- ЗАДАНИЕ 1.3: Переименование файла -->
    <div class="task">
        <h2>✏️ Задание 1.3: Переименовать 'test.txt' в 'mir.txt'</h2>
        <?php
        $mirFile = $baseDir . '/mir.txt';
        
        if (file_exists($testFile)) {
            if (rename($testFile, $mirFile)) {
                message("✅ Файл переименован: 'test.txt' → 'mir.txt'", 'success');
                echo "<div class='result'>";
                echo "🗂️ Старый путь: <code>" . basename($testFile) . "</code><br>";
                echo "🗂️ Новый путь: <code>" . basename($mirFile) . "</code>";
                echo "</div>";
            } else {
                message("❌ Ошибка переименования файла", 'error');
            }
        } else {
            message("⚠️ Файл 'test.txt' не найден (возможно, уже переименован)", 'warning');
        }
        
        // Проверка нового файла
        if (file_exists($mirFile)) {
            echo "<div class='result success'>✅ 'mir.txt' существует</div>";
        }
        ?>
    </div>

    <!-- ЗАДАНИЕ 1.4: Создание папки и перемещение файла -->
    <div class="task">
        <h2>📂 Задание 1.4: Создать папку 'folder' и переместить 'mir.txt' в неё</h2>
        <?php
        $folder = $baseDir . '/folder';
        $mirInFolder = $folder . '/mir.txt';
        
        // Создание папки
        if (!file_exists($folder)) {
            if (mkdir($folder, 0775, true)) {
                message("✅ Папка '$folder' создана", 'success');
            } else {
                message("❌ Ошибка создания папки", 'error');
            }
        } else {
            message("ℹ️ Папка уже существует", 'info');
        }
        
        // Перемещение файла
        if (file_exists($mirFile)) {
            if (rename($mirFile, $mirInFolder)) {
                message("✅ Файл перемещён в '$folder'", 'success');
                echo "<div class='result'>";
                echo "📁 Путь к файлу: <code>" . htmlspecialchars($mirInFolder) . "</code>";
                echo "</div>";
            } else {
                message("❌ Ошибка перемещения файла", 'error');
            }
        }
        ?>
    </div>

    <!-- ЗАДАНИЕ 1.5: Копирование файла -->
    <div class="task">
        <h2>📋 Задание 1.5: Создать копию 'mir.txt' → 'world.txt'</h2>
        <?php
        $worldFile = $folder . '/world.txt';
        
        if (file_exists($mirInFolder)) {
            if (copy($mirInFolder, $worldFile)) {
                message("✅ Файл скопирован: 'mir.txt' → 'world.txt'", 'success');
                echo "<div class='result'>";
                echo "📄 Оригинал: <code>" . basename($mirInFolder) . "</code><br>";
                echo "📄 Копия: <code>" . basename($worldFile) . "</code><br>";
                echo "📏 Размер копии: " . filesize($worldFile) . " байт";
                echo "</div>";
            } else {
                message("❌ Ошибка копирования файла", 'error');
            }
        } else {
            message("❌ Исходный файл не найден", 'error');
        }
        ?>
    </div>

    <!-- ЗАДАНИЕ 1.6: Определение размера файла -->
    <div class="task">
        <h2>📏 Задание 1.6: Размер файла 'world.txt' в байтах, МБ, ГБ</h2>
        <?php
        if (file_exists($worldFile)) {
            $size = filesize($worldFile);
            
            echo "<table>
                    <tr><th>Единица</th><th>Значение</th><th>Формула</th></tr>
                    <tr><td>Байты</td><td><strong>$size B</strong></td><td>filesize()</td></tr>
                    <tr><td>Килобайты</td><td><strong>" . round($size / 1024, 2) . " KB</strong></td><td>bytes / 1024</td></tr>
                    <tr><td>Мегабайты</td><td><strong>" . round($size / 1024 / 1024, 4) . " MB</strong></td><td>bytes / 1024²</td></tr>
                    <tr><td>Гигабайты</td><td><strong>" . round($size / 1024 / 1024 / 1024, 6) . " GB</strong></td><td>bytes / 1024³</td></tr>
                  </table>";
            
            echo "<div class='result success'>";
            echo "🎯 Форматированный размер: <strong>" . formatSize($size) . "</strong>";
            echo "</div>";
        } else {
            message("❌ Файл 'world.txt' не найден", 'error');
        }
        ?>
    </div>

    <!-- ЗАДАНИЕ 1.7: Удаление файла -->
    <div class="task">
        <h2>🗑️ Задание 1.7: Удалить файл 'world.txt'</h2>
        <?php
        if (file_exists($worldFile)) {
            if (unlink($worldFile)) {
                message("✅ Файл 'world.txt' удалён", 'success');
            } else {
                message("❌ Ошибка удаления файла", 'error');
            }
        } else {
            message("⚠️ Файл уже не существует", 'warning');
        }
        ?>
    </div>

    <!-- ЗАДАНИЕ 1.8: Проверка существования файлов -->
    <div class="task">
        <h2>✅ Задание 1.8: Проверить существование 'world.txt' и 'mir.txt'</h2>
        <?php
        $filesToCheck = [
            'world.txt' => $worldFile,
            'mir.txt' => $mirInFolder
        ];
        
        echo "<table>
                <tr><th>Файл</th><th>Путь</th><th>Существует?</th><th>Размер</th></tr>";
        
        foreach ($filesToCheck as $name => $path) {
            $exists = file_exists($path);
            $size = $exists ? formatSize(filesize($path)) : '—';
            $status = $exists ? 
                "<span style='color:#2ecc71'>✅ Да</span>" : 
                "<span style='color:#e74c3c'>❌ Нет</span>";
            
            echo "<tr>
                    <td><code>$name</code></td>
                    <td><small>" . htmlspecialchars($path) . "</small></td>
                    <td>$status</td>
                    <td>$size</td>
                  </tr>";
        }
        echo "</table>";
        ?>
    </div>

    <?php
    // ============================================================
    // ЗАДАНИЕ ЧАСТЬ 2
    // ============================================================
    ?>

    <!-- ЗАДАНИЕ 2.1: Создание папки 'test' -->
    <div class="task">
        <h2>📁 Задание 2.1: Создать папку 'test'</h2>
        <?php
        $testDir = $baseDir . '/test';
        
        if (!file_exists($testDir)) {
            if (mkdir($testDir, 0775, true)) {
                message("✅ Папка '$testDir' создана", 'success');
            } else {
                message("❌ Ошибка создания папки", 'error');
            }
        } else {
            message("ℹ️ Папка уже существует", 'info');
        }
        ?>
    </div>

    <!-- ЗАДАНИЕ 2.2: Переименование папки -->
    <div class="task">
        <h2>✏️ Задание 2.2: Переименовать 'test' в 'www'</h2>
        <?php
        $wwwDir = $baseDir . '/www';
        
        if (file_exists($testDir)) {
            if (rename($testDir, $wwwDir)) {
                message("✅ Папка переименована: 'test' → 'www'", 'success');
                echo "<div class='result'>";
                echo "🗂️ Старый путь: <code>test</code><br>";
                echo "🗂️ Новый путь: <code>www</code>";
                echo "</div>";
            } else {
                message("❌ Ошибка переименования папки", 'error');
            }
        } else {
            message("⚠️ Папка 'test' не найдена", 'warning');
        }
        ?>
    </div>

    <!-- ЗАДАНИЕ 2.3: Удаление папки -->
    <div class="task">
        <h2>🗑️ Задание 2.3: Удалить папку 'www'</h2>
        <?php
        if (file_exists($wwwDir)) {
            // rmdir работает только с пустыми папками
            // Сначала удалим содержимое если есть
            $files = scandir($wwwDir);
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..') {
                    $filePath = $wwwDir . '/' . $file;
                    if (is_file($filePath)) {
                        unlink($filePath);
                    } elseif (is_dir($filePath)) {
                        // Рекурсивное удаление подпапок
                        $iterator = new RecursiveIteratorIterator(
                            new RecursiveDirectoryIterator($filePath, RecursiveDirectoryIterator::SKIP_DOTS),
                            RecursiveIteratorIterator::CHILD_FIRST
                        );
                        foreach ($iterator as $item) {
                            $item->isDir() ? rmdir($item) : unlink($item);
                        }
                        rmdir($filePath);
                    }
                }
            }
            
            if (rmdir($wwwDir)) {
                message("✅ Папка 'www' удалена", 'success');
            } else {
                message("❌ Ошибка удаления папки", 'error');
            }
        } else {
            message("⚠️ Папка 'www' не найдена", 'warning');
        }
        ?>
    </div>

    <!-- ЗАДАНИЕ 2.4: Создание папок из массива -->
    <div class="task">
        <h2>🗂️ Задание 2.4: Создать папки из массива в 'test'</h2>
        <?php
        // Восстанавливаем папку test
        if (!file_exists($testDir)) {
            mkdir($testDir, 0775, true);
        }
        
        // Массив с названиями папок
        $folders = ['documents', 'images', 'videos', 'audio', 'archives'];
        
        echo "<p><strong>Массив папок:</strong> <code>['" . implode("', '", $folders) . "']</code></p>";
        echo "<table><tr><th>Папка</th><th>Путь</th><th>Статус</th></tr>";
        
        foreach ($folders as $folder) {
            $folderPath = $testDir . '/' . $folder;
            if (!file_exists($folderPath)) {
                $created = mkdir($folderPath, 0775, true);
                $status = $created ? 
                    "<span style='color:#2ecc71'>✅ Создана</span>" : 
                    "<span style='color:#e74c3c'>❌ Ошибка</span>";
            } else {
                $status = "<span style='color:#f39c12'>ℹ️ Уже существует</span>";
            }
            echo "<tr>
                    <td><code>$folder</code></td>
                    <td><small>" . htmlspecialchars($folderPath) . "</small></td>
                    <td>$status</td>
                  </tr>";
        }
        echo "</table>";
        ?>
    </div>

    <!-- ЗАДАНИЕ 2.5: Поиск файлов .jpg -->
    <div class="task">
        <h2>🔍 Задание 2.5: Вывести все файлы с расширением .jpg из текущей папки</h2>
        <?php
        // Создадим тестовые .jpg файлы для демонстрации
        $jpgFiles = ['photo1.jpg', 'image2.jpg', 'avatar.jpg'];
        foreach ($jpgFiles as $jpg) {
            $jpgPath = $baseDir . '/' . $jpg;
            if (!file_exists($jpgPath)) {
                file_put_contents($jpgPath, 'fake jpg content');
            }
        }
        
        // Поиск файлов с расширением .jpg
        $pattern = $baseDir . '/*.jpg';
        $foundFiles = glob($pattern);
        
        echo "<p><strong>Поиск по шаблону:</strong> <code>" . htmlspecialchars($pattern) . "</code></p>";
        
        if (!empty($foundFiles)) {
            echo "<table><tr><th>Файл</th><th>Размер</th><th>Полный путь</th></tr>";
            foreach ($foundFiles as $file) {
                $name = basename($file);
                $size = formatSize(filesize($file));
                echo "<tr>
                        <td><span class='file-tag'>🖼️ $name</span></td>
                        <td>$size</td>
                        <td><small>" . htmlspecialchars($file) . "</small></td>
                      </tr>";
            }
            echo "</table>";
            message("✅ Найдено файлов: " . count($foundFiles), 'success');
        } else {
            message("⚠️ Файлы .jpg не найдены", 'warning');
        }
        
        // Дополнительные примеры glob()
        echo "<p><strong>💡 Другие примеры glob():</strong></p>";
        echo "<ul style='font-size:0.9em;color:#aaa;'>
                <li><code>glob('*.txt')</code> — все текстовые файлы</li>
                <li><code>glob('folder/*')</code> — все файлы в папке folder</li>
                <li><code>glob('*.php')</code> — все PHP-файлы</li>
                <li><code>glob('{*.jpg,*.png}', GLOB_BRACE)</code> — изображения</li>
              </ul>";
        ?>
    </div>

    <!-- ============================================================ -->
    <!-- ФУТЕР -->
    <!-- ============================================================ -->
    <div class="footer">
        <p>🎓 <strong>Лабораторная работа №11 выполнена</strong></p>
        <p><strong>Gorbunov | Группа 9ПО-31</strong></p>
        <p>📅 Дата выполнения: <?php echo date('d.m.Y H:i'); ?></p>
        <p>💻 PHP <?php echo PHP_VERSION; ?> | Nginx</p>
        <p>
            <span class="file-tag">fopen</span>
            <span class="file-tag">fwrite</span>
            <span class="file-tag">fgets</span>
            <span class="file-tag">rename</span>
            <span class="file-tag">copy</span>
            <span class="file-tag">unlink</span>
            <span class="file-tag">mkdir</span>
            <span class="file-tag">glob</span>
        </p>
        <p>🔗 <a href="https://github.com/blablalblable/gorbunov.com" target="_blank">
            github.com/blablalblable/gorbunov.com
        </a></p>
    </div>

</div>
</body>
</html>
