<?php
/**
 * Лабораторная работа №13
 * Тема: Объекты и классы в PHP
 * Выполнил: Gorbunov
 * Группа: 9ПО-31
 * Репозиторий: github.com/blablalblable/gorbunov.com
 */

// ============================================================
// КЛАСС РАБОТНИКА (по заданию)
// ============================================================
class Worker {
    
    // === Свойства класса ===
    // Скрытые (private) свойства - доступ только изнутри класса
    private $name;
    private $age;
    private $salary;
    
    // === Конструктор ===
    // Вызывается автоматически при создании объекта: new Worker(...)
    public function __construct($name, $age, $salary) {
        $this->name = $name;
        // Используем сеттер для валидации возраста при создании
        $this->setAge($age);
        $this->salary = $salary;
    }
    
    // === Геттеры (публичные методы для чтения свойств) ===
    
    /**
     * Возвращает имя работника
     * @return string Имя работника
     */
    public function getName() {
        return $this->name;
    }
    
    /**
     * Возвращает возраст работника
     * @return int Возраст
     */
    public function getAge() {
        return $this->age;
    }
    
    /**
     * Возвращает зарплату работника
     * @return float Зарплата
     */
    public function getSalary() {
        return $this->salary;
    }
    
    // === Сеттеры (публичные методы для изменения свойств) ===
    
    /**
     * Устанавливает новый возраст с проверкой
     * @param int $newAge Новый возраст
     * @return bool Успешно ли изменён возраст
     */
    public function setAge($newAge) {
        // Вызываем приватный метод проверки
        if ($this->checkAge($newAge)) {
            $this->age = $newAge;
            return true;
        }
        return false;
    }
    
    /**
     * Устанавливает новую зарплату
     * @param float $newSalary Новая зарплата
     */
    public function setSalary($newSalary) {
        if ($newSalary >= 0) {
            $this->salary = $newSalary;
        }
    }
    
    // === Приватные методы (доступны только внутри класса) ===
    
    /**
     * Приватный метод проверки возраста
     * @param int $age Проверяемый возраст
     * @return bool true если возраст >= 18, иначе false
     */
    private function checkAge($age) {
        if ($age >= 18) {
            return true;
        } else {
            echo "<div class='result error'>❌ <strong>Внимание:</strong> Возраст $age лет — Вам работать в нашей компании еще рано!</div>";
            return false;
        }
    }
    
    // === Дополнительные методы для задания ===
    
    /**
     * Статический метод для подсчёта суммы зарплат массива работников
     * @param Worker[] $workers Массив объектов Worker
     * @return float Сумма зарплат
     */
    public static function sumSalaries(array $workers) {
        $total = 0;
        foreach ($workers as $worker) {
            $total += $worker->getSalary();
        }
        return $total;
    }
    
    /**
     * Статический метод для подсчёта суммы возрастов массива работников
     * @param Worker[] $workers Массив объектов Worker
     * @return int Сумма возрастов
     */
    public static function sumAges(array $workers) {
        $total = 0;
        foreach ($workers as $worker) {
            $total += $worker->getAge();
        }
        return $total;
    }
    
    /**
     * Возвращает строковое представление работника
     * @return string Информация о работнике
     */
    public function __toString() {
        return "{$this->name}, {$this->age} лет, зарплата: {$this->salary} руб.";
    }
}

// ============================================================
// ВСПОМОГАТЕЛЬНЫЕ ФУНКЦИИ ДЛЯ ВЫВОДА
// ============================================================
function result($label, $value, $type = 'info') {
    $colors = ['success' => '#2ecc71', 'error' => '#e74c3c', 'warning' => '#f39c12', 'info' => '#3498db'];
    $color = $colors[$type] ?? $colors['info'];
    echo "<div style='padding:10px;margin:8px 0;background:#2a2a3e;border-left:4px solid {$color};border-radius:4px;'>";
    echo "<strong style='color:#00d4aa'>{$label}:</strong> <span style='color:#ecf0f1'>" . htmlspecialchars($value) . "</span>";
    echo "</div>";
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ЛЗ №13 - Объекты в PHP - Gorbunov 9ПО-31</title>
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
        .class-diagram {
            background: #0d0d1a;
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
            font-family: monospace;
            border: 1px solid #3a3a5e;
        }
        .class-diagram .private { color: #e74c3c; }
        .class-diagram .public { color: #2ecc71; }
        .class-diagram .keyword { color: #9b59b6; }
        a { color: #00d4aa; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
<div class="container">

    <h1>🧱 ЛЗ №13: Объекты и классы в PHP <span class="badge">Gorbunov 9ПО-31</span></h1>

    <!-- ДИАГРАММА КЛАССА -->
    <div class="task">
        <h2>📐 Структура класса Worker</h2>
        <div class="class-diagram">
<pre><code><span class="keyword">class</span> Worker {
    <span class="private">- private $name</span>
    <span class="private">- private $age</span>
    <span class="private">- private $salary</span>
    
    <span class="public">+ __construct($name, $age, $salary)</span>
    <span class="public">+ getName(): string</span>
    <span class="public">+ getAge(): int</span>
    <span class="public">+ getSalary(): float</span>
    <span class="public">+ setAge($newAge): bool</span>
    <span class="public">+ setSalary($newSalary): void</span>
    <span class="private">- checkAge($age): bool</span>
    <span class="public">+ static sumSalaries($workers): float</span>
    <span class="public">+ static sumAges($workers): int</span>
}</code></pre>
        </div>
        <p><small>🔴 <code>private</code> — доступно только внутри класса | 🟢 <code>public</code> — доступно извне</small></p>
    </div>

    <!-- ЗАДАНИЕ 1-2: Создание класса и объектов -->
    <div class="task">
        <h2>👥 Задание 1-2: Создание класса Worker и двух объектов</h2>
        <?php
        // Создаём два объекта класса Worker
        $worker1 = new Worker("Александр Иванов", 25, 45000);
        $worker2 = new Worker("Мария Петрова", 32, 62000);
        
        $workers = [$worker1, $worker2];
        
        echo "<p><strong>Созданные объекты:</strong></p>";
        echo "<table>
                <tr><th>Объект</th><th>Имя</th><th>Возраст</th><th>Зарплата</th></tr>
                <tr><td><code>\$worker1</code></td><td>{$worker1->getName()}</td><td>{$worker1->getAge()}</td><td>{$worker1->getSalary()} ₽</td></tr>
                <tr><td><code>\$worker2</code></td><td>{$worker2->getName()}</td><td>{$worker2->getAge()}</td><td>{$worker2->getSalary()} ₽</td></tr>
              </table>";
        ?>
    </div>

    <!-- ЗАДАНИЕ 3: Сумма зарплат и возрастов -->
    <div class="task">
        <h2>🧮 Задание 3: Сумма зарплат и сумма возрастов работников</h2>
        <?php
        $totalSalary = Worker::sumSalaries($workers);
        $totalAge = Worker::sumAges($workers);
        
        echo "<table>
                <tr><th>Показатель</th><th>Расчёт</th><th>Результат</th></tr>
                <tr><td>💰 Сумма зарплат</td><td><code>{$worker1->getSalary()} + {$worker2->getSalary()}</code></td><td><strong>{$totalSalary} ₽</strong></td></tr>
                <tr><td>🎂 Сумма возрастов</td><td><code>{$worker1->getAge()} + {$worker2->getAge()}</code></td><td><strong>{$totalAge} лет</strong></td></tr>
                <tr><td>📊 Средняя зарплата</td><td><code>{$totalSalary} / 2</code></td><td><strong>" . round($totalSalary / 2) . " ₽</strong></td></tr>
                <tr><td>📈 Средний возраст</td><td><code>{$totalAge} / 2</code></td><td><strong>" . round($totalAge / 2) . " лет</strong></td></tr>
              </table>";
        ?>
    </div>

    <!-- ЗАДАНИЕ 4: Геттеры getName, getAge, getSalary -->
    <div class="task">
        <h2>🔓 Задание 4: Методы getName(), getAge(), getSalary()</h2>
        <?php
        echo "<p><strong>Демонстрация работы геттеров:</strong></p>";
        echo "<table>
                <tr><th>Метод</th><th>Вызов</th><th>Результат</th></tr>
                <tr><td><code>getName()</code></td><td><code>\$worker1->getName()</code></td><td><strong>{$worker1->getName()}</strong></td></tr>
                <tr><td><code>getAge()</code></td><td><code>\$worker1->getAge()</code></td><td><strong>{$worker1->getAge()} лет</strong></td></tr>
                <tr><td><code>getSalary()</code></td><td><code>\$worker1->getSalary()</code></td><td><strong>{$worker1->getSalary()} ₽</strong></td></tr>
                <tr><td><code>getName()</code></td><td><code>\$worker2->getName()</code></td><td><strong>{$worker2->getName()}</strong></td></tr>
                <tr><td><code>getAge()</code></td><td><code>\$worker2->getAge()</code></td><td><strong>{$worker2->getAge()} лет</strong></td></tr>
                <tr><td><code>getSalary()</code></td><td><code>\$worker2->getSalary()</code></td><td><strong>{$worker2->getSalary()} ₽</strong></td></tr>
              </table>";
        
        result("✅ Геттеры работают корректно", "Доступ к приватным свойствам через публичные методы", 'success');
        ?>
    </div>

    <!-- ЗАДАНИЕ 5: getSalary для суммы зарплат -->
    <div class="task">
        <h2>💼 Задание 5: Статический метод sumSalaries() для суммы зарплат</h2>
        <?php
        // Демонстрация статического метода
        echo "<p><strong>Использование статического метода <code>Worker::sumSalaries()</code>:</strong></p>";
        
        // Тест с разным количеством работников
        $testCases = [
            ['workers' => [$worker1], 'label' => 'Только Александр'],
            ['workers' => [$worker2], 'label' => 'Только Мария'],
            ['workers' => $workers, 'label' => 'Оба работника'],
        ];
        
        echo "<table>
                <tr><th>Состав</th><th>Код</th><th>Сумма</th></tr>";
        foreach ($testCases as $test) {
            $sum = Worker::sumSalaries($test['workers']);
            echo "<tr>
                    <td>{$test['label']}</td>
                    <td><code>Worker::sumSalaries(\$workers)</code></td>
                    <td><strong>{$sum} ₽</strong></td>
                  </tr>";
        }
        echo "</table>";
        
        result("💡 Статические методы", "Вызываются через имя класса: <code>Worker::method()</code>, не требуют создания объекта", 'info');
        ?>
    </div>

    <!-- ЗАДАНИЕ 6: setAge с валидацией и private age -->
    <div class="task">
        <h2>🔐 Задание 6: setAge() с проверкой возраста >= 18, свойство age — private</h2>
        <?php
        echo "<p><strong>Тестирование метода <code>setAge()</code> с валидацией:</strong></p>";
        
        // Создаём нового работника для тестов
        $testWorker = new Worker("Тестовый Пользователь", 20, 30000);
        
        $testAges = [16, 17, 18, 25, 30, 100];
        
        echo "<table>
                <tr><th>Попытка установить возраст</th><th>Результат</th><th>Текущий возраст</th></tr>";
        foreach ($testAges as $age) {
            $success = $testWorker->setAge($age);
            $currentAge = $testWorker->getAge();
            $status = $success ? 
                "<span style='color:#2ecc71'>✅ Успешно</span>" : 
                "<span style='color:#e74c3c'>❌ Отклонено</span>";
            echo "<tr>
                    <td><code>setAge($age)</code></td>
                    <td>$status</td>
                    <td><strong>$currentAge лет</strong></td>
                  </tr>";
        }
        echo "</table>";
        
        result("🔒 Инкапсуляция", "Свойство <code>\$age</code> объявлено как <code>private</code> — доступ только через методы класса", 'success');
        ?>
    </div>

    <!-- ЗАДАНИЕ 7: Метод checkAge() -->
    <div class="task">
        <h2>✅ Задание 7: Метод checkAge() — проверка возраста >= 18</h2>
        <?php
        echo "<p><strong>Демонстрация логики проверки возраста:</strong></p>";
        
        // Поскольку checkAge() приватный, тестируем через setAge()
        echo "<div class='result'>";
        echo "📋 Логика метода <code>checkAge(\$age)</code>:\n";
        echo "  if (\$age >= 18) {\n";
        echo "      return true;  // Можно работать\n";
        echo "  } else {\n";
        echo "      echo \"Вам работать в нашей компании еще рано\";\n";
        echo "      return false; // Нельзя работать\n";
        echo "  }";
        echo "</div>";
        
        // Визуальная проверка
        $checkResults = [
            ['age' => 15, 'expected' => false],
            ['age' => 17, 'expected' => false],
            ['age' => 18, 'expected' => true],
            ['age' => 25, 'expected' => true],
            ['age' => 65, 'expected' => true],
        ];
        
        echo "<table>
                <tr><th>Возраст</th><th>Условие</th><th>Ожидаемый результат</th></tr>";
        foreach ($checkResults as $item) {
            $condition = $item['age'] >= 18 ? '≥ 18' : '< 18';
            $result = $item['expected'] ? '✅ true (можно)' : '❌ false (нельзя)';
            echo "<tr>
                    <td><strong>{$item['age']} лет</strong></td>
                    <td><code>\$age $condition</code></td>
                    <td>$result</td>
                  </tr>";
        }
        echo "</table>";
        ?>
    </div>

    <!-- ЗАДАНИЕ 8: checkAge() private, setAge() public -->
    <div class="task">
        <h2>🛡️ Задание 8: checkAge() — private, setAge() — public с использованием checkAge()</h2>
        <?php
        echo "<p><strong>Архитектура методов:</strong></p>";
        
        echo "<div class='class-diagram'>
<pre><code><span class="keyword">class</span> Worker {
    <span class="private">- private function checkAge(\$age): bool</span>
    <span class="public">  ↓ вызывается из</span>
    <span class="public">+ public function setAge(\$newAge): bool</span>
}

<span class="comment">// setAge() делегирует проверку приватному методу:</span>
<span class="keyword">public function</span> setAge(\$newAge) {
    <span class="keyword">if</span> (\$<span class="keyword">this</span>->checkAge(\$newAge)) {  <span class="comment">// ← вызов private</span>
        \$<span class="keyword">this</span>->age = \$newAge;
        <span class="keyword">return</span> true;
    }
    <span class="keyword">return</span> false;
}</code></pre>
        </div>";
        
        echo "<p><strong>Преимущества такого подхода:</strong></p>";
        echo "<ul>
                <li>✅ <strong>Инкапсуляция:</strong> Логика проверки скрыта внутри класса</li>
                <li>✅ <strong>Единая точка изменения:</strong> Если правила возраста изменятся, правим только <code>checkAge()</code></li>
                <li>✅ <strong>Безопасность:</strong> Внешний код не может обойти проверку</li>
                <li>✅ <strong>Чистота кода:</strong> <code>setAge()</code> отвечает за изменение, <code>checkAge()</code> — за валидацию</li>
              </ul>";
        
        // Финальный тест
        $finalWorker = new Worker("Финальный Тест", 30, 50000);
        echo "<p><strong>Финальный тест:</strong></p>";
        echo "<div class='result success'>";
        echo "👤 Работник: {$finalWorker->getName()}<br>";
        echo "🎂 Возраст: {$finalWorker->getAge()} лет<br>";
        echo "💰 Зарплата: {$finalWorker->getSalary()} ₽<br>";
        echo "🔐 Попытка setAge(16): ";
        $finalWorker->setAge(16); // Должно вывести сообщение об ошибке
        echo "<br>🎂 Возраст после попытки: <strong>{$finalWorker->getAge()} лет</strong> (не изменился!)";
        echo "</div>";
        ?>
    </div>

    <!-- БОНУС: Демонстрация инкапсуляции -->
    <div class="task">
        <h2>🎁 Бонус: Почему инкапсуляция важна?</h2>
        <?php
        echo "<p><strong>Попытка прямого доступа к приватному свойству:</strong></p>";
        
        echo "<div class='result error'>";
        echo "<pre><code>\$worker = new Worker(\"Тест\", 25, 40000);
// ❌ Это НЕ сработает - свойство private:
echo \$worker->age;        // Fatal error!
\$worker->age = 10;        // Fatal error!

// ✅ Правильный способ - через публичные методы:
echo \$worker->getAge();   // 25
\$worker->setAge(26);      // Успешно, если >= 18</code></pre>";
        echo "</div>";
        
        echo "<p><strong>Преимущества инкапсуляции:</strong></p>";
        echo "<table>
                <tr><th>Без инкапсуляции</th><th>С инкапсуляцией</th></tr>
                <tr><td>Любой код может изменить \$age</td><td>Только setAge() может изменить</td></tr>
                <tr><td>Нет проверки возраста</td><td>Автоматическая валидация >= 18</td></tr>
                <tr><td>Сложно отследить изменения</td><td>Все изменения в одном месте</td></tr>
                <tr><td>Легко допустить ошибку</td><td>Класс сам защищает свои данные</td></tr>
              </table>";
        ?>
    </div>

    <!-- ============================================================ -->
    <!-- ФУТЕР -->
    <!-- ============================================================ -->
    <div class="footer">
        <p>🎓 <strong>Лабораторная работа №13 выполнена</strong></p>
        <p><strong>Gorbunov | Группа 9ПО-31</strong></p>
        
        <p>
            <span class="badge">class</span>
            <span class="badge">private/public</span>
            <span class="badge">__construct</span>
            <span class="badge">getters/setters</span>
            <span class="badge">static</span>
            <span class="badge">инкапсуляция</span>
        </p>
        <p>🔗 <a href="https://github.com/blablalblable/gorbunov.com" target="_blank">
            github.com/blablalblable/gorbunov.com
        </a></p>
    </div>

</div>
</body>
</html>
