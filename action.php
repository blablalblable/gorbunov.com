<?php
/**
 * Обработчик форм - Лабораторная работа №10
 * Выполнил: Gorbunov, Группа 9ПО-31
 * Репозиторий: github.com/blablalblable/gorbunov.com
 */

// === ОБРАБОТКА РЕГИСТРАЦИИ ===
if (isset($_POST['register'])) {
    
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $age = $_POST['age'] ?? '';
    $agree = isset($_POST['agree']);
    
    $errors = [];
    
    // Валидация имени
    if (empty($name)) {
        $errors[] = "Имя обязательно для заполнения";
    } elseif (!preg_match('/^[A-Za-zА-Яа-яЁё\s\-]{2,50}$/', $name)) {
        $errors[] = "Имя должно содержать только буквы (2-50 символов)";
    }
    
    // Валидация email
    if (empty($email)) {
        $errors[] = "Email обязателен";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Некорректный формат Email";
    }
    
    // Валидация пароля
    if (empty($password)) {
        $errors[] = "Пароль обязателен";
    } elseif (strlen($password) < 6) {
        $errors[] = "Пароль должен содержать минимум 6 символов";
    }
    
    // Подтверждение пароля
    if ($password !== $confirmPassword) {
        $errors[] = "Пароли не совпадают";
    }
    
    // Согласие
    if (!$agree) {
        $errors[] = "Необходимо согласиться с условиями";
    }
    
    // Возраст
    if (!empty($age) && (!is_numeric($age) || $age < 1 || $age > 120)) {
        $errors[] = "Возраст должен быть от 1 до 120";
    }
    
    // Результат
    if (empty($errors)) {
        $msg = "✅ Регистрация успешна!\n👤 Имя: " . htmlspecialchars($name) . "\n📧 Email: " . htmlspecialchars($email);
        if (!empty($gender)) {
            $genders = ['male'=>'Мужской','female'=>'Женский','other'=>'Другой'];
            $msg .= "\n⚧ Пол: " . ($genders[$gender] ?? $gender);
        }
        header("Location: index.php?status=success&msg=" . urlencode($msg));
    } else {
        header("Location: index.php?status=error&msg=" . urlencode(implode("\n", $errors)));
    }
    exit;
}

// === ОБРАБОТКА КАЛЬКУЛЯТОРА ===
if (isset($_POST['calculator']) && isset($_POST['operation'])) {
    
    $num1 = floatval($_POST['num1'] ?? 0);
    $num2 = floatval($_POST['num2'] ?? 0);
    $op = $_POST['operation'] ?? 'calculate';
    
    $result = null;
    $error = null;
    
    switch ($op) {
        case 'add': $result = $num1 + $num2; $sym = '+'; break;
        case 'subtract': $result = $num1 - $num2; $sym = '−'; break;
        case 'multiply': $result = $num1 * $num2; $sym = '×'; break;
        case 'divide':
            if ($num2 == 0) { $error = "❌ Деление на ноль невозможно!"; }
            else { $result = $num1 / $num2; $sym = '÷'; }
            break;
        case 'power': $result = pow($num1, $num2); $sym = '^'; break;
        case 'modulo':
            if ($num2 == 0) { $error = "❌ Остаток от деления на ноль невозможен!"; }
            else { $result = $num1 % $num2; $sym = '%'; }
            break;
        default: $result = $num1 + $num2; $sym = '+'; break;
    }
    
    if ($error === null && $result !== null) {
        $display = (floor($result) == $result) ? (int)$result : round($result, 4);
        header("Location: index.php?calc_result=" . urlencode("$num1 $sym $num2 = $display"));
    } else {
        header("Location: index.php?error=" . urlencode($error));
    }
    exit;
}

// По умолчанию — на главную
header("Location: index.php");
exit;
