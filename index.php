<?php
/**
 * Лабораторная работа №12
 * Тема: Обработка исключений и работа с датами в PHP
 * Выполнил: Gorbunov
 * Группа: 9ПО-31
 * Репозиторий: github.com/blablalblable/gorbunov.com
 */

// Базовая директория для логов
$logFile = __DIR__ . '/files/error_log.txt';

// Функция для форматированного вывода
function result($label, $value, $type = 'info') {
    $colors = ['success' => '#2ecc71', 'error' => '#e74c3c', 'warning' => '#f39c12', 'info' => '#3498db'];
    $color = $colors[$type] ?? $colors['info'];
    echo "<div style='padding:10px;margin:8px 0;background:#2a2a3e;border-left:4px solid {$color};border-radius:4px;'>";
    echo "<strong style='color:#00d4aa'>{$label}:</strong> <span style='color:#ecf0f1'>" . htmlspecialchars($value) . "</span>";
    echo "</div>";
}

function logError($message) {
    global $logFile;
    $entry = "[" . date('Y-m-d H:i:s') . "] " . $message . PHP_EOL;
    file_put_contents($logFile, $entry, FILE_APPEND | LOCK_EX);
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ЛЗ №12 - Исключения и даты - Gorbunov 9ПО-31</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 1100px;
            margin: 0 auto;
            padding: 20px;
            background: linear-gradient(135deg, #0f0f23 0%, #1a1a3e 100%);
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
            color: #9b59b6;
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
        pre code { background: none; padding: 0; color: #e0e0e0; }
        
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
        th { background: #00d4aa; color: #1a1a2e; font-weight: bold; }
        
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
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: 600; }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 2px solid #3a3a5e;
            border-radius: 6px;
            background: #16213e;
            color: #ecf0f1;
            font-size: 14px;
        }
        .form-group input:focus { outline: none; border-color: #00d4aa; }
        .btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
        }
        .btn:hover { opacity: 0.9; transform: translateY(-2px); }
        a { color: #00d4aa; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
<div class="container">

    <h1>⚡ ЛЗ №12: Исключения и даты <span class="badge">Gorbunov 9ПО-31</span></h1>

    <?php
    // ============================================================
    // ЧАСТЬ 1: ОБРАБОТКА ИСКЛЮЧЕНИЙ
    // ============================================================
    ?>

    <!-- ЗАДАНИЕ 1.1: Обработка ошибки fopen -->
    <div class="task">
        <h2>📁 Задание 1.1: Обработчик ошибки открытия несуществующего файла</h2>
        <?php
        $nonExistentFile = __DIR__ . '/files/does_not_exist_12345.txt';
        
        try {
            // Подавляем стандартное предупреждение и выбрасываем исключение
            $handle = @fopen($nonExistentFile, 'r');
            if ($handle === false) {
                throw new Exception("Не удалось открыть файл: '$nonExistentFile'");
            }
            fclose($handle);
            result("Статус", "Файл открыт успешно", 'success');
        } catch (Exception $ex) {
            result("❌ Исключение", $ex->getMessage(), 'error');
            result("📄 Файл", $ex->getFile() . ':' . $ex->getLine(), 'warning');
            result("🔢 Код", $ex->getCode(), 'info');
        }
        ?>
    </div>

    <!-- ЗАДАНИЕ 1.2: Деление на ноль с логированием -->
    <div class="task">
        <h2>➗ Задание 1.2: Исключение при делении на ноль + запись в log.txt</h2>
        <?php
        function safeDivide($a, $b) {
            if ($b == 0) {
                throw new Exception("DivisionByZeroError: Нельзя делить на ноль! ({$a} / {$b})");
            }
            return $a / $b;
        }
        
        $testCases = [[10, 2], [100, 0], [45, 5], [0, 0]];
        
        echo "<table><tr><th>Операция</th><th>Результат</th><th>Статус</th></tr>";
        foreach ($testCases as [$num, $den]) {
            try {
                $res = safeDivide($num, $den);
                echo "<tr><td><code>$num / $den</code></td><td><strong>$res</strong></td><td style='color:#2ecc71'>✅</td></tr>";
            } catch (Exception $ex) {
                logError($ex->getMessage());
                echo "<tr><td><code>$num / $den</code></td><td><strong>Ошибка</strong></td><td style='color:#e74c3c'>❌</td></tr>";
            }
        }
        echo "</table>";
        
        // Показать содержимое лога
        if (file_exists($logFile)) {
            echo "<p><strong>📋 Содержимое log.txt:</strong></p>";
            echo "<div class='result'>" . htmlspecialchars(file_get_contents($logFile)) . "</div>";
        }
        ?>
    </div>

    <!-- ЗАДАНИЕ 1.3: Доступ к несуществующему элементу массива -->
    <div class="task">
        <h2>🗺️ Задание 1.3: Обработчик для несуществующего ключа в массиве</h2>
        <?php
        $countries = ['Spain' => 'Madrid', 'Russia' => 'Moscow', 'France' => 'Paris'];
        $queries = ['Spain', 'Germany', 'Russia', 'Italy', 'France'];
        
        echo "<p><strong>Исходный массив:</strong> <code>" . json_encode($countries, JSON_UNESCAPED_UNICODE) . "</code></p>";
        echo "<table><tr><th>Запрос</th><th>Результат</th><th>Статус</th></tr>";
        
        foreach ($queries as $country) {
            try {
                if (!array_key_exists($country, $countries)) {
                    throw new Exception("KeyError: Страна '$country' не найдена в массиве");
                }
                $capital = $countries[$country];
                echo "<tr><td><code>\$countries['$country']</code></td><td><strong>$capital</strong></td><td style='color:#2ecc71'>✅</td></tr>";
            } catch (Exception $ex) {
                echo "<tr><td><code>\$countries['$country']</code></td><td><strong>❌ " . htmlspecialchars($ex->getMessage()) . "</strong></td><td style='color:#e74c3c'>Ошибка</td></tr>";
            }
        }
        echo "</table>";
        ?>
    </div>

    <?php
    // ============================================================
    // ЧАСТЬ 2: РАБОТА С ДАТАМИ
    // ============================================================
    ?>

    <!-- ЗАДАНИЕ 2.1: Вывод даты в формате timestamp -->
    <div class="task">
        <h2>⏱️ Задание 2.1: 15 марта 2025, 10:25:00 в формате timestamp</h2>
        <?php
        $timestamp = mktime(10, 25, 0, 3, 15, 2025);
        result("mktime(10, 25, 0, 3, 15, 2025)", $timestamp, 'success');
        result("Проверка через date()", date('d.m.Y H:i:s', $timestamp), 'info');
        ?>
    </div>

    <!-- ЗАДАНИЕ 2.2: Разница между датами в секундах -->
    <div class="task">
        <h2>📊 Задание 2.2: Разница между 2.10.1990 08:05:59 и текущим временем</h2>
        <?php
        $past = mktime(8, 5, 59, 10, 2, 1990);
        $now = time();
        $diff = $now - $past;
        
        $years = floor($diff / 31536000);
        $days = floor(($diff % 31536000) / 86400);
        $hours = floor(($diff % 86400) / 3600);
        $minutes = floor(($diff % 3600) / 60);
        $seconds = $diff % 60;
        
        echo "<table>
                <tr><th>Единица</th><th>Значение</th></tr>
                <tr><td>Секунды</td><td><strong>$diff</strong></td></tr>
                <tr><td>Минуты</td><td><strong>" . round($diff / 60) . "</strong></td></tr>
                <tr><td>Часы</td><td><strong>" . round($diff / 3600) . "</strong></td></tr>
                <tr><td>Дни</td><td><strong>" . round($diff / 86400) . "</strong></td></tr>
                <tr><td>Годы (прибл.)</td><td><strong>$years лет, $days дней</strong></td></tr>
              </table>";
        result("Точная разница", "$years лет, $days дней, $hours ч, $minutes мин, $seconds сек", 'success');
        ?>
    </div>

    <!-- ЗАДАНИЕ 2.3: Текущая дата в формате 'Год.месяц.день Час:Минута:Секунда' -->
    <div class="task">
        <h2>📅 Задание 2.3: Текущая дата-время в формате 'Год.месяц.день Час:Минута:Секунда'</h2>
        <?php
        $formatted = date('Y.m.d H:i:s');
        result("date('Y.m.d H:i:s')", $formatted, 'success');
        ?>
    </div>

    <!-- ЗАДАНИЕ 2.4: 1 сентября текущего года -->
    <div class="task">
        <h2>🍂 Задание 2.4: 1-го сентября текущего года в формате 'Год.месяц.день'</h2>
        <?php
        $sept1 = mktime(0, 0, 0, 9, 1); // год опущен = текущий
        $formatted = date('Y.m.d', $sept1);
        result("1 сентября " . date('Y'), $formatted, 'success');
        ?>
    </div>

    <!-- ЗАДАНИЕ 2.5: День недели 2 февраля 2000 -->
    <div class="task">
        <h2>🗓️ Задание 2.5: Какой день недели был 2 февраля 2000 года?</h2>
        <?php
        $feb2_2000 = mktime(0, 0, 0, 2, 2, 2000);
        $dayNum = date('w', $feb2_2000); // 0=Воскресенье, 1=Понедельник...
        $daysRu = ['Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'];
        $dayName = $daysRu[$dayNum];
        
        result("date('w', mktime(0,0,0,2,2,2000))", "$dayNum ($dayName)", 'success');
        result("Полная дата", date('d.m.Y, l', $feb2_2000), 'info');
        ?>
    </div>

    <!-- ЗАДАНИЕ 2.6: Массив дней недели + текущий день + день рождения -->
    <div class="task">
        <h2>🎂 Задание 2.6: Массив дней недели, текущий день и 12.06.2016</h2>
        <?php
        // Массив дней недели
        $week = [
            0 => 'Воскресенье', 1 => 'Понедельник', 2 => 'Вторник',
            3 => 'Среда', 4 => 'Четверг', 5 => 'Пятница', 6 => 'Суббота'
        ];
        
        // Текущий день
        $todayNum = date('w');
        $todayName = $week[$todayNum];
        
        // День рождения 12.06.2016
        $bday = mktime(0, 0, 0, 6, 12, 2016);
        $bdayNum = date('w', $bday);
        $bdayName = $week[$bdayNum];
        
        echo "<table>
                <tr><th>Параметр</th><th>Значение</th></tr>
                <tr><td>Массив \$week</td><td><code>[" . implode(', ', array_map(fn($k,$v)=>"'$k'=>'$v'", array_keys($week), $week)) . "]</code></td></tr>
                <tr><td>Сегодня (номер)</td><td><code>$todayNum</code></td></tr>
                <tr><td>Сегодня (название)</td><td><strong>$todayName</strong></td></tr>
                <tr><td>12.06.2016 (номер)</td><td><code>$bdayNum</code></td></tr>
                <tr><td>12.06.2016 (название)</td><td><strong>$bdayName</strong></td></tr>
              </table>";
        result("🎉 День рождения 12.06.2016", "Выпал на $bdayName", 'success');
        ?>
    </div>

    <!-- ЗАДАНИЕ 2.7: Форма сравнения двух дат -->
    <div class="task">
        <h2>🔀 Задание 2.7: Форма для сравнения двух дат</h2>
        
        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['compare_dates'])): ?>
            <?php
            $date1 = $_POST['date1'] ?? '';
            $date2 = $_POST['date2'] ?? '';
            
            if (!empty($date1) && !empty($date2)) {
                $ts1 = strtotime($date1);
                $ts2 = strtotime($date2);
                
                if ($ts1 === false || $ts2 === false) {
                    result("❌ Ошибка", "Неверный формат даты", 'error');
                } else {
                    $later = $ts1 > $ts2 ? $date1 : $date2;
                    $earlier = $ts1 > $ts2 ? $date2 : $date1;
                    $diff = abs($ts1 - $ts2);
                    $diffDays = floor($diff / 86400);
                    
                    echo "<div class='result success'>";
                    echo "✅ Более поздняя дата: <strong>$later</strong><br>";
                    echo "📅 Более ранняя: $earlier<br>";
                    echo "📊 Разница: $diffDays дней";
                    echo "</div>";
                }
            }
            ?>
        <?php endif; ?>
        
        <form method="POST" style="background:#16213e;padding:20px;border-radius:8px;margin-top:15px;">
            <div class="form-row" style="display:grid;grid-template-columns:1fr 1fr;gap:15px;">
                <div class="form-group">
                    <label for="date1">Первая дата (формат: 2025-12-31)</label>
                    <input type="date" id="date1" name="date1" value="<?= $_POST['date1'] ?? '' ?>" required>
                </div>
                <div class="form-group">
                    <label for="date2">Вторая дата (формат: 2025-12-31)</label>
                    <input type="date" id="date2" name="date2" value="<?= $_POST['date2'] ?? '' ?>" required>
                </div>
            </div>
            <button type="submit" name="compare_dates" class="btn">🔍 Сравнить даты</button>
        </form>
    </div>

    <!-- ЗАДАНИЕ 2.8: Конвертация формата даты -->
    <div class="task">
        <h2>🔄 Задание 2.8: Конвертация 'Год-месяц-день' → 'день-месяц-год'</h2>
        <?php
        $inputDate = '2025-12-31';
        $timestamp = strtotime($inputDate);
        $output = date('d-m-Y', $timestamp);
        
        echo "<table>
                <tr><th>Исходный формат</th><th>Значение</th></tr>
                <tr><td>Вход (строка)</td><td><code>$inputDate</code></td></tr>
                <tr><td>strtotime()</td><td><code>$timestamp</code></td></tr>
                <tr><td>date('d-m-Y', ...)</td><td><strong>$output</strong></td></tr>
              </table>";
        result("Результат конвертации", "$inputDate → $output", 'success');
        
        // Тест с другой датой
        $testDates = ['2000-01-01', '2024-02-29', '1999-12-31'];
        echo "<p><strong>Дополнительные тесты:</strong></p><ul>";
        foreach ($testDates as $d) {
            $converted = date('d-m-Y', strtotime($d));
            echo "<li><code>$d</code> → <strong>$converted</strong></li>";
        }
        echo "</ul>";
        ?>
    </div>

    <!-- ЗАДАНИЕ 2.9: Манипуляции с датой через date_create/modify -->
    <div class="task">
        <h2>➕➖ Задание 2.9: Прибавление и вычитание интервалов от даты</h2>
        <?php
        $date = date_create('2000-02-03');
        $original = date_format($date, 'd.m.Y');
        
        echo "<p><strong>Исходная дата:</strong> <code>$original</code></p>";
        echo "<table><tr><th>Операция</th><th>Результат</th><th>Код</th></tr>";
        
        // +2 дня
        $d1 = clone $date;
        date_modify($d1, '+2 days');
        echo "<tr><td>+2 дня</td><td><strong>" . date_format($d1, 'd.m.Y') . "</strong></td><td><code>+2 days</code></td></tr>";
        
        // +1 месяц
        $d2 = clone $date;
        date_modify($d2, '+1 month');
        echo "<tr><td>+1 месяц</td><td><strong>" . date_format($d2, 'd.m.Y') . "</strong></td><td><code>+1 month</code></td></tr>";
        
        // +3 дня +1 год
        $d3 = clone $date;
        date_modify($d3, '+3 days +1 year');
        echo "<tr><td>+3 дня +1 год</td><td><strong>" . date_format($d3, 'd.m.Y') . "</strong></td><td><code>+3 days +1 year</code></td></tr>";
        
        // -3 дня
        $d4 = clone $date;
        date_modify($d4, '-3 days');
        echo "<tr><td>-3 дня</td><td><strong>" . date_format($d4, 'd.m.Y') . "</strong></td><td><code>-3 days</code></td></tr>";
        
        // Комбинированная операция по заданию: +2д +1м +3д +1г -3д
        $dFinal = clone $date;
        date_modify($dFinal, '+2 days +1 month +3 days +1 year -3 days');
        echo "<tr style='background:#00d4aa20'>
                <td><strong>Итог: +2д +1м +3д +1г -3д</strong></td>
                <td><strong>" . date_format($dFinal, 'd.m.Y') . "</strong></td>
                <td><code>+2d +1m +3d +1y -3d</code></td>
              </tr>";
        echo "</table>";
        ?>
    </div>

    <!-- ЗАДАНИЕ 2.10: Дней до Нового Года -->
    <div class="task">
        <h2>🎄 Задание 2.10: Сколько дней осталось до Нового Года?</h2>
        <?php
        $now = time();
        $currentYear = date('Y', $now);
        $nextNewYear = mktime(0, 0, 0, 1, 1, $currentYear + 1);
        $diffSeconds = $nextNewYear - $now;
        $daysLeft = ceil($diffSeconds / 86400);
        
        result("Текущая дата", date('d.m.Y H:i:s'), 'info');
        result("Следующий Новый Год", "01.01." . ($currentYear + 1), 'success');
        result("🎅 Дней осталось", $daysLeft, 'success');
        
        // Бонус: если уже Новый Год
        if ($daysLeft <= 0) {
            result("🎉 Поздравление", "С Новым Годом! 🎊", 'success');
        } elseif ($daysLeft <= 7) {
            result("⏰ Скоро!", "Осталась меньше недели!", 'warning');
        }
        ?>
    </div>

    <!-- ============================================================ -->
    <!-- ФУТЕР -->
    <!-- ============================================================ -->
    <div class="footer">
        <p>🎓 <strong>Лабораторная работа №12 выполнена</strong></p>
        <p><strong>Gorbunov | Группа 9ПО-31</strong></p>
        <p>
            <span class="badge">try/catch</span>
            <span class="badge">Exception</span>
            <span class="badge">time()</span>
            <span class="badge">mktime()</span>
            <span class="badge">date()</span>
            <span class="badge">strtotime()</span>
        </p>
        <p>🔗 <a href="https://github.com/blablalblable/gorbunov.com" target="_blank">
            github.com/blablalblable/gorbunov.com
        </a></p>
    </div>

</div>
</body>
</html>
