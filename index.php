<?php
/**
 * Лабораторная работа №13: Объекты и классы в PHP
 * Выполнил: Gorbunov, Группа 9ПО-31
 */

class Worker {
    // Задание 1: Свойства класса
    private $name;
    private $age;
    private $salary;
    
    // Конструктор
    public function __construct($name, $age, $salary) {
        $this->name = $name;
        $this->setAge($age); // Используем сеттер для валидации
        $this->salary = $salary;
    }
    
    // Задание 3: Метод getName()
    public function getName() {
        return $this->name;
    }
    
    // Задание 4: Метод getAge()
    public function getAge() {
        return $this->age;
    }
    
    // Задание 5: Метод getSalary()
    public function getSalary() {
        return $this->salary;
    }
    
    // Задание 7: setAge с параметром (вместо getAge)
    // Задание 8: Проверка возраста >= 18
    // Задание 10: setAge — public, использует checkAge()
    public function setAge($newAge) {
        if ($this->checkAge($newAge)) {
            $this->age = $newAge;
            return true;
        } else {
            echo "Вам работать в нашей компании еще рано";
            return false;
        }
    }
    
    // Задание 9: checkAge() возвращает true/false
    // Задание 10: checkAge() — private
    private function checkAge($age) {
        if ($age >= 18) {
            return true;
        } else {
            return false;
        }
    }
    
    // Задание 6: Статический метод для суммы зарплат
    public static function sumSalaries($workers) {
        $total = 0;
        foreach ($workers as $worker) {
            $total += $worker->getSalary();
        }
        return $total;
    }
    
    // Дополнительный: сумма возрастов
    public static function sumAges($workers) {
        $total = 0;
        foreach ($workers as $worker) {
            $total += $worker->getAge();
        }
        return $total;
    }
}

// ============================================================
// ВЫПОЛНЕНИЕ ВСЕХ 10 ЗАДАНИЙ
// ============================================================

// Задание 1: Создание 2 объектов класса Worker
$worker1 = new Worker("Александр Иванов", 25, 45000);
$worker2 = new Worker("Мария Петрова", 32, 62000);
$workers = [$worker1, $worker2];

// Тестовый работник для демонстрации setAge
$testWorker = new Worker("Тестовый", 20, 30000);

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ЛЗ №13 - Все 10 заданий - Gorbunov 9ПО-31</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #333;
        }
        .container {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }
        h1 {
            color: #667eea;
            border-bottom: 3px solid #764ba2;
            padding-bottom: 15px;
            margin-top: 0;
        }
        .task {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            border: 2px solid #667eea;
        }
        .task h3 {
            color: #764ba2;
            margin-top: 0;
            background: #667eea;
            color: white;
            padding: 10px;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background: #667eea;
            color: white;
        }
        .result {
            background: #e8f5e9;
            padding: 15px;
            border-left: 4px solid #4CAF50;
            margin: 10px 0;
            border-radius: 4px;
        }
        .error {
            background: #ffebee;
            border-left-color: #f44336;
        }
        code {
            background: #f5f5f5;
            padding: 2px 6px;
            border-radius: 3px;
            font-family: monospace;
            color: #d63384;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding: 20px;
            background: #333;
            color: white;
            border-radius: 8px;
        }
        .checklist {
            background: #d4edda;
            border: 1px solid #c3e6cb;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .checklist li {
            margin: 5px 0;
        }
    </style>
</head>
<body>
<div class="container">

    <h1>🧱 ЛЗ №13: Объекты и классы в PHP</h1>
    <p><strong>Выполнил:</strong> Gorbunov, Группа 9ПО-31</p>

    <!-- Задание 1 -->
    <div class="task">
        <h3>✅ Задание 1: Создание класса Worker с 2 объектами</h3>
        <p><strong>Свойства:</strong> <code>name</code> (имя), <code>age</code> (возраст), <code>salary</code> (зарплата)</p>
        <table>
            <tr><th>Объект</th><th>Имя</th><th>Возраст</th><th>Зарплата</th></tr>
            <tr><td><code>$worker1</code></td><td><?= $worker1->getName() ?></td><td><?= $worker1->getAge() ?> лет</td><td><?= $worker1->getSalary() ?> ₽</td></tr>
            <tr><td><code>$worker2</code></td><td><?= $worker2->getName() ?></td><td><?= $worker2->getAge() ?> лет</td><td><?= $worker2->getSalary() ?> ₽</td></tr>
        </table>
    </div>

    <!-- Задание 2 -->
    <div class="task">
        <h3>✅ Задание 2: Сумма зарплат и сумма возрастов</h3>
        <div class="result">
            <p><strong>💰 Сумма зарплат:</strong> <?= $worker1->getSalary() ?> + <?= $worker2->getSalary() ?> = <strong><?= Worker::sumSalaries($workers) ?> ₽</strong></p>
            <p><strong>🎂 Сумма возрастов:</strong> <?= $worker1->getAge() ?> + <?= $worker2->getAge() ?> = <strong><?= Worker::sumAges($workers) ?> лет</strong></p>
        </div>
    </div>

    <!-- Задание 3 -->
    <div class="task">
        <h3>✅ Задание 3: Метод getName()</h3>
        <p><code>$worker1->getName()</code> = <strong>"<?= $worker1->getName() ?>"</strong></p>
        <p><code>$worker2->getName()</code> = <strong>"<?= $worker2->getName() ?>"</strong></p>
    </div>

    <!-- Задание 4 -->
    <div class="task">
        <h3>✅ Задание 4: Метод getAge()</h3>
        <p><code>$worker1->getAge()</code> = <strong><?= $worker1->getAge() ?> лет</strong></p>
        <p><code>$worker2->getAge()</code> = <strong><?= $worker2->getAge() ?> лет</strong></p>
    </div>

    <!-- Задание 5 -->
    <div class="task">
        <h3>✅ Задание 5: Метод getSalary()</h3>
        <p><code>$worker1->getSalary()</code> = <strong><?= $worker1->getSalary() ?> ₽</strong></p>
        <p><code>$worker2->getSalary()</code> = <strong><?= $worker2->getSalary() ?> ₽</strong></p>
    </div>

    <!-- Задание 6 -->
    <div class="task">
        <h3>✅ Задание 6: Статический метод sumSalaries() для суммы зарплат</h3>
        <p><code>Worker::sumSalaries($workers)</code> = <strong><?= Worker::sumSalaries($workers) ?> ₽</strong></p>
        <div class="result">
            <p><small>💡 Статический метод вызывается через имя класса: <code>Worker::method()</code></small></p>
        </div>
    </div>

    <!-- Задание 7 -->
    <div class="task">
        <h3>✅ Задание 7: setAge() с параметром, age — private</h3>
        <p><strong>Метод:</strong> <code>setAge($newAge)</code> — принимает новый возраст</p>
        <p><strong>Свойство:</strong> <code>private $age</code> — скрытое (недоступно извне)</p>
        <div class="result">
            <p>✅ Доступ к $age только через методы getAge() и setAge()</p>
        </div>
    </div>

    <!-- Задание 8 -->
    <div class="task">
        <h3>✅ Задание 8: setAge() с проверкой возраста >= 18</h3>
        <p><strong>Тестирование:</strong></p>
        <?php
        $testAges = [16, 17, 18, 25];
        foreach ($testAges as $age) {
            echo "<div style='margin:8px 0; padding:10px; background:#f5f5f5; border-radius:5px;'>";
            echo "<code>setAge($age)</code>: ";
            $result = $testWorker->setAge($age);
            if (!$result) {
                echo " <span style='color:red; font-weight:bold;'>❌ Отклонено</span>";
            } else {
                echo " <span style='color:green; font-weight:bold;'>✅ Принято</span>";
            }
            echo " (текущий: <strong>" . $testWorker->getAge() . "</strong>)";
            echo "</div>";
        }
        ?>
    </div>

    <!-- Задание 9 -->
    <div class="task">
        <h3>✅ Задание 9: checkAge() — проверка и возврат true/false</h3>
        <table>
            <tr><th>Возраст</th><th>Условие</th><th>Результат checkAge()</th></tr>
            <tr><td>15 лет</td><td><code>15 >= 18</code></td><td>❌ false</td></tr>
            <tr><td>17 лет</td><td><code>17 >= 18</code></td><td>❌ false</td></tr>
            <tr><td>18 лет</td><td><code>18 >= 18</code></td><td>✅ true</td></tr>
            <tr><td>25 лет</td><td><code>25 >= 18</code></td><td>✅ true</td></tr>
        </table>
    </div>

    <!-- Задание 10 -->
    <div class="task">
        <h3>✅ Задание 10: checkAge() — private, setAge() — public</h3>
        <div class="result">
            <h4>Архитектура:</h4>
            <pre style="background:#f5f5f5; padding:15px; border-radius:5px; overflow-x:auto;"><code>class Worker {
    private $age;
    
    // Приватный метод (внутри класса)
    private function checkAge($age) {
        return $age >= 18;
    }
    
    // Публичный метод (доступен извне)
    public function setAge($newAge) {
        if ($this->checkAge($newAge)) {  // ← вызов private
            $this->age = $newAge;
            return true;
        }
        echo "Вам работать в нашей компании еще рано";
        return false;
    }
}</code></pre>
        </div>
        <div class="result">
            <p><strong>✅ Преимущества:</strong></p>
            <ul>
                <li><strong>Инкапсуляция:</strong> checkAge() скрыт от внешнего кода</li>
                <li><strong>Безопасность:</strong> setAge() не позволяет обойти проверку</li>
                <li><strong>Поддержка:</strong> Логика проверки в одном месте</li>
            </ul>
        </div>
    </div>

    <!-- Чеклист -->
    <div class="checklist">
        <h3>📋 Выполненные задания:</h3>
        <ol>
            <li>✅ Класс Worker с 2 объектами</li>
            <li>✅ Сумма зарплат и возрастов</li>
            <li>✅ getName()</li>
            <li>✅ getAge()</li>
            <li>✅ getSalary()</li>
            <li>✅ sumSalaries() для суммы зарплат</li>
            <li>✅ setAge() с параметром, age — private</li>
            <li>✅ setAge() с проверкой >= 18</li>
            <li>✅ checkAge() возвращает true/false</li>
            <li>✅ checkAge() private, setAge() public</li>
        </ol>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>🎓 <strong>Все 10 заданий выполнены!</strong></p>
        <p><strong>Gorbunov | Группа 9ПО-31</strong></p>
        <p>📅 <?= date('d.m.Y H:i') ?> | PHP <?= PHP_VERSION ?></p>
        <p>🔗 <a href="https://github.com/blablalblable/gorbunov.com" target="_blank" style="color:#4CAF50;">
            github.com/blablalblable/gorbunov.com
        </a></p>
    </div>

</div>
</body>
</html>
