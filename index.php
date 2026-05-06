<?php
/**
 * Лабораторная работа №15
 * Тема: Абстрактные классы и интерфейсы в PHP
 * Выполнил: Gorbunov
 * Группа: 9ПО-31
 */

// ============================================================
// ИНТЕРФЕС: ShapeInterface
// Задание 4: Интерфейс с методом getArea()
// ============================================================
interface ShapeInterface {
    public function getArea(): float;
}

// ============================================================
// АБСТРАКТНЫЙ КЛАСС: Figure
// Задание 1-2: Абстрактный класс с свойствами и абстрактным методом
// ============================================================
abstract class Figure implements ShapeInterface {
    
    // Задание 1: Свойства класса
    protected float $area;
    protected string $color;
    protected int $sidesCount;
    
    // Конструктор для инициализации общих свойств
    public function __construct(string $color = "blue") {
        $this->color = $color;
        $this->area = 0.0;
    }
    
    // Геттеры для доступа к свойствам
    public function getColor(): string {
        return $this->color;
    }
    
    public function getSidesCount(): int {
        return $this->sidesCount;
    }
    
    public function getArea(): float {
        return $this->area;
    }
    
    // Задание 2: Абстрактный метод (без реализации)
    abstract public function infoAbout(): string;
}

// ============================================================
// КЛАСС: Rectangle (Прямоугольник)
// Задание 3, 4, 5, 7-10: Наследование и реализация
// ============================================================
class Rectangle extends Figure {
    
    // Задание 5: Приватные свойства для длин сторон
    private float $a;
    private float $b;
    
    // Задание 7: Количество сторон
    protected int $sidesCount = 4;
    
    // Задание 8: Конструктор для инициализации сторон
    public function __construct(float $a, float $b, string $color = "green") {
        parent::__construct($color);
        $this->a = $a;
        $this->b = $b;
        // Сразу вычисляем площадь при создании
        $this->area = $this->getArea();
    }
    
    // Задание 4, 9: Реализация метода getArea() из интерфейса
    // Формула: S = a * b
    public function getArea(): float {
        return $this->a * $this->b;
    }
    
    // Задание 10: Реализация абстрактного метода infoAbout()
    public function infoAbout(): string {
        return "Это класс прямоугольника. У него {$this->sidesCount} стороны.";
    }
    
    // Дополнительные геттеры
    public function getA(): float { return $this->a; }
    public function getB(): float { return $this->b; }
}

// ============================================================
// КЛАСС: Square (Квадрат)
// Задание 3, 4, 6, 7-10: Наследование и реализация
// ============================================================
class Square extends Figure {
    
    // Задание 6: Приватное свойство для длины стороны
    private float $a;
    
    // Задание 7: Количество сторон
    protected int $sidesCount = 4;
    
    // Задание 8: Конструктор
    public function __construct(float $a, string $color = "red") {
        parent::__construct($color);
        $this->a = $a;
        $this->area = $this->getArea();
    }
    
    // Задание 4, 9: Реализация getArea()
    // Формула: S = a * a
    public function getArea(): float {
        return $this->a * $this->a;
    }
    
    // Задание 10: Реализация infoAbout()
    public function infoAbout(): string {
        return "Это класс квадрата. У него {$this->sidesCount} стороны.";
    }
    
    public function getA(): float { return $this->a; }
}

// ============================================================
// КЛАСС: Triangle (Треугольник)
// Задание 3, 4, 6, 7-10: Наследование и реализация
// ============================================================
class Triangle extends Figure {
    
    // Задание 6: Приватные свойства для длин сторон
    private float $a;
    private float $b;
    private float $c;
    
    // Задание 7: Количество сторон
    protected int $sidesCount = 3;
    
    // Задание 8: Конструктор
    public function __construct(float $a, float $b, float $c, string $color = "blue") {
        parent::__construct($color);
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
        $this->area = $this->getArea();
    }
    
    // Задание 4, 9: Реализация getArea()
    // Формула Герона: S = √(p(p-a)(p-b)(p-c)), где p = (a+b+c)/2
    public function getArea(): float {
        $p = ($this->a + $this->b + $this->c) / 2;
        return sqrt($p * ($p - $this->a) * ($p - $this->b) * ($p - $this->c));
    }
    
    // Задание 10: Реализация infoAbout()
    public function infoAbout(): string {
        return "Это класс треугольника. У него {$this->sidesCount} стороны.";
    }
    
    public function getA(): float { return $this->a; }
    public function getB(): float { return $this->b; }
    public function getC(): float { return $this->c; }
}

// ============================================================
// ВЫПОЛНЕНИЕ ЗАДАНИЙ 11-12: Создание объектов и вызов методов
// ============================================================

// Задание 11: Создание по 2 объектов для каждого класса

// Прямоугольники
$rect1 = new Rectangle(5, 10, "green");
$rect2 = new Rectangle(7, 3, "lime");

// Квадраты
$square1 = new Square(6, "red");
$square2 = new Square(4, "crimson");

// Треугольники (стороны 3, 4, 5 — прямоугольный треугольник)
$triangle1 = new Triangle(3, 4, 5, "blue");
$triangle2 = new Triangle(5, 5, 6, "navy");

// Массив всех фигур для удобного вывода
$figures = [
    'rectangles' => [$rect1, $rect2],
    'squares' => [$square1, $square2],
    'triangles' => [$triangle1, $triangle2]
];

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ЛЗ №15 - Абстрактные классы - Gorbunov 9ПО-31</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            min-height: 100vh;
            padding: 20px;
            color: #ecf0f1;
        }
        .container {
            max-width: 1100px;
            margin: 0 auto;
        }
        h1 {
            color: #00d4aa;
            text-align: center;
            padding: 20px;
            border-bottom: 3px solid #00d4aa;
            margin-bottom: 30px;
        }
        .section {
            background: #1e1e2f;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 25px;
            border: 1px solid #3a3a5e;
        }
        .section h2 {
            color: #9b59b6;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #00d4aa;
        }
        .figures-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }
        .figure-card {
            background: #2a2a3e;
            border-radius: 10px;
            padding: 20px;
            border-left: 4px solid #00d4aa;
        }
        .figure-card.rectangle { border-left-color: #2ecc71; }
        .figure-card.square { border-left-color: #e74c3c; }
        .figure-card.triangle { border-left-color: #3498db; }
        
        .figure-card h3 {
            color: #ecf0f1;
            margin-bottom: 15px;
            font-size: 1.3em;
        }
        .figure-card p {
            margin: 8px 0;
            color: #bdc3c7;
        }
        .figure-card .area {
            font-size: 1.5em;
            font-weight: bold;
            color: #00d4aa;
            margin: 10px 0;
        }
        .figure-card .info {
            background: #16213e;
            padding: 10px;
            border-radius: 5px;
            margin-top: 10px;
            font-style: italic;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }
        th, td {
            padding: 12px;
            border: 1px solid #3a3a5e;
            text-align: left;
        }
        th {
            background: #00d4aa;
            color: #1a1a2e;
            font-weight: bold;
        }
        tr:nth-child(even) { background: #252538; }
        
        code {
            background: #0d0d1a;
            color: #00d4aa;
            padding: 2px 8px;
            border-radius: 4px;
            font-family: 'Fira Code', monospace;
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
            margin: 5px;
        }
        a { color: #00d4aa; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
<div class="container">

    <h1>🔷 ЛЗ №15: Абстрактные классы и интерфейсы <span class="badge">Gorbunov 9ПО-31</span></h1>

    <!-- Структура классов -->
    <div class="section">
        <h2>📐 Иерархия классов</h2>
        <pre style="background:#0d0d1a; padding:15px; border-radius:8px; overflow-x:auto;"><code>
┌─────────────────────────┐
│  interface ShapeInterface │
│  • getArea(): float      │
└────────┬────────────────┘
         │ implements
         ▼
┌─────────────────────────┐
│  abstract class Figure   │
│  • $area: float          │
│  • $color: string        │
│  • $sidesCount: int      │
│  • infoAbout(): string ◄─ abstract
│  • getArea(): float      │
└────┬────┬────┬──────────┘
     │    │    │ extends
     ▼    ▼    ▼
┌────────┐ ┌────────┐ ┌────────┐
│Rectangle│ │ Square │ │Triangle│
│• $a, $b │ │ • $a   │ │• $a,$b,$c│
│S = a×b  │ │S = a²  │ │S=Герон │
└────────┘ └────────┘ └────────┘
        </code></pre>
    </div>

    <!-- Прямоугольники -->
    <div class="section">
        <h2>🟩 Прямоугольники (Rectangle)</h2>
        <div class="figures-grid">
            <?php foreach ($figures['rectangles'] as $i => $rect): ?>
            <div class="figure-card rectangle">
                <h3>🔲 Прямоугольник #<?= $i + 1 ?></h3>
                <p><strong>Стороны:</strong> a = <?= $rect->getA() ?>, b = <?= $rect->getB() ?></p>
                <p><strong>Цвет:</strong> <?= $rect->getColor() ?></p>
                <p class="area">📏 Площадь: <?= number_format($rect->getArea(), 2) ?></p>
                <div class="info">💬 <?= $rect->infoAbout() ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Квадраты -->
    <div class="section">
        <h2>🟥 Квадраты (Square)</h2>
        <div class="figures-grid">
            <?php foreach ($figures['squares'] as $i => $square): ?>
            <div class="figure-card square">
                <h3>⬛ Квадрат #<?= $i + 1 ?></h3>
                <p><strong>Сторона:</strong> a = <?= $square->getA() ?></p>
                <p><strong>Цвет:</strong> <?= $square->getColor() ?></p>
                <p class="area">📏 Площадь: <?= number_format($square->getArea(), 2) ?></p>
                <div class="info">💬 <?= $square->infoAbout() ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Треугольники -->
    <div class="section">
        <h2>🔺 Треугольники (Triangle)</h2>
        <div class="figures-grid">
            <?php foreach ($figures['triangles'] as $i => $triangle): ?>
            <div class="figure-card triangle">
                <h3>🔺 Треугольник #<?= $i + 1 ?></h3>
                <p><strong>Стороны:</strong> a = <?= $triangle->getA() ?>, b = <?= $triangle->getB() ?>, c = <?= $triangle->getC() ?></p>
                <p><strong>Цвет:</strong> <?= $triangle->getColor() ?></p>
                <p class="area">📏 Площадь: <?= number_format($triangle->getArea(), 2) ?></p>
                <div class="info">💬 <?= $triangle->infoAbout() ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Сводная таблица -->
    <div class="section">
        <h2>📊 Сводные результаты (Задание 12)</h2>
        <table>
            <tr>
                <th>Фигура</th>
                <th>Параметры</th>
                <th>Сторон</th>
                <th>Площадь (getArea)</th>
                <th>infoAbout()</th>
            </tr>
            <?php
            $allFigures = array_merge($figures['rectangles'], $figures['squares'], $figures['triangles']);
            foreach ($allFigures as $fig):
                $type = get_class($fig);
                $params = match($type) {
                    'Rectangle' => "a={$fig->getA()}, b={$fig->getB()}",
                    'Square' => "a={$fig->getA()}",
                    'Triangle' => "a={$fig->getA()}, b={$fig->getB()}, c={$fig->getC()}",
                };
            ?>
            <tr>
                <td><strong><?= $type ?></strong></td>
                <td><code><?= $params ?></code></td>
                <td><?= $fig->getSidesCount() ?></td>
                <td><strong><?= number_format($fig->getArea(), 2) ?></strong></td>
                <td><em><?= $fig->infoAbout() ?></em></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <!-- Проверка интерфейса -->
    <div class="section">
        <h2>✅ Проверка реализации интерфейса</h2>
        <div style="background:#16213e; padding:15px; border-radius:8px;">
            <p><strong>Проверка:</strong> <code>$figure instanceof ShapeInterface</code></p>
            <?php
            $testFigure = $rect1;
            $implements = $testFigure instanceof ShapeInterface;
            ?>
            <p>
                <code><?= get_class($testFigure) ?> instanceof ShapeInterface</code> = 
                <strong style="color:<?= $implements ? '#2ecc71' : '#e74c3c' ?>">
                    <?= $implements ? '✅ true' : '❌ false' ?>
                </strong>
            </p>
            <p><small>💡 Все классы реализуют интерфейс ShapeInterface через наследование от Figure</small></p>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>🎓 <strong>Лабораторная работа №15 выполнена</strong></p>
        <p><strong>Gorbunov | Группа 9ПО-31</strong></p>
        <p>📅 <?= date('d.m.Y H:i') ?> | PHP <?= PHP_VERSION ?></p>
        <p>
            <span class="badge">abstract class</span>
            <span class="badge">interface</span>
            <span class="badge">implements</span>
            <span class="badge">extends</span>
            <span class="badge">polymorphism</span>
        </p>
        <p>🔗 <a href="https://github.com/blablalblable/gorbunov.com" target="_blank">
            github.com/blablalblable/gorbunov.com
        </a></p>
    </div>

</div>
</body>
</html>
