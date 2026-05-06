<?php
/**
 * Лабораторная работа №10: Работа с формами
 * Выполнил: Gorbunov
 * Группа: 9ПО-31
 * Репозиторий: github.com/blablalblable/gorbunov.com
 */
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ЛЗ №10 - Формы - Gorbunov 9ПО-31</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    
    <!-- ===== ФОРМА РЕГИСТРАЦИИ ===== -->
    <div class="card">
        <h2>📋 Регистрация пользователя</h2>
        
        <?php if (isset($_GET['status'])): ?>
            <div class="message <?php echo $_GET['status'] === 'success' ? 'success' : 'error'; ?>">
                <?php echo htmlspecialchars($_GET['msg'] ?? ''); ?>
            </div>
        <?php endif; ?>
        
        <form action="action.php" method="POST">
            
            <!-- Имя -->
            <div class="form-group">
                <label for="name">Имя *</label>
                <input type="text" id="name" name="name" 
                       placeholder="Введите ваше имя" 
                       required 
                       pattern="[A-Za-zА-Яа-яЁё\s\-]{2,50}"
                       title="Только буквы, 2-50 символов">
            </div>
            
            <!-- Email -->
            <div class="form-group">
                <label for="email">Email *</label>
                <input type="email" id="email" name="email" 
                       placeholder="example@email.com" 
                       required>
            </div>
            
            <!-- Пароль -->
            <div class="form-group">
                <label for="password">Пароль *</label>
                <input type="password" id="password" name="password" 
                       placeholder="Минимум 6 символов" 
                       required 
                       minlength="6">
            </div>
            
            <!-- Подтверждение пароля -->
            <div class="form-group">
                <label for="confirm_password">Подтвердите пароль *</label>
                <input type="password" id="confirm_password" name="confirm_password" 
                       placeholder="Повторите пароль" 
                       required>
            </div>
            
            <!-- Пол (выпадающий список) -->
            <div class="form-group">
                <label for="gender">Пол</label>
                <select id="gender" name="gender">
                    <option value="">-- Выберите пол --</option>
                    <option value="male">Мужской</option>
                    <option value="female">Женский</option>
                    <option value="other">Другой</option>
                    <option value="prefer_not_to_say">Предпочитаю не указывать</option>
                </select>
            </div>
            
            <!-- Возраст и телефон -->
            <div class="form-row">
                <div class="form-group">
                    <label for="age">Возраст</label>
                    <input type="number" id="age" name="age" 
                           placeholder="Лет" min="1" max="120">
                </div>
                <div class="form-group">
                    <label for="phone">Телефон</label>
                    <input type="tel" id="phone" name="phone" 
                           placeholder="+7 (___) ___-__-__">
                </div>
            </div>
            
            <!-- Согласие -->
            <div class="form-group">
                <label class="checkbox-group">
                    <input type="checkbox" name="agree" value="1" required>
                    <span>Я согласен с <a href="#" style="color:#667eea;">условиями</a> *</span>
                </label>
            </div>
            
            <button type="submit" name="register" class="btn-submit">
                🚀 Зарегистрироваться
            </button>
            
        </form>
    </div>
    
    <!-- ===== КАЛЬКУЛЯТОР ===== -->
    <div class="card">
        <h2>🧮 Калькулятор</h2>
        
        <?php if (isset($_GET['calc_result'])): ?>
            <div class="message success">
                <strong>✅ Результат:</strong> <?php echo htmlspecialchars($_GET['calc_result']); ?>
            </div>
        <?php endif; ?>
        <?php if (isset($_GET['error'])): ?>
            <div class="message error">
                <strong>❌ Ошибка:</strong> <?php echo htmlspecialchars($_GET['error']); ?>
            </div>
        <?php endif; ?>
        
        <form action="action.php" method="POST">
            
            <div class="calc-display">
                <?php echo isset($_GET['result']) ? htmlspecialchars($_GET['result']) : '0'; ?>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="num1">Первое число</label>
                    <input type="number" id="num1" name="num1" step="any" placeholder="0" required>
                </div>
                <div class="form-group">
                    <label for="num2">Второе число</label>
                    <input type="number" id="num2" name="num2" step="any" placeholder="0" required>
                </div>
            </div>
            
            <div class="calc-buttons">
                <button type="submit" name="operation" value="add" class="calc-btn operator">+</button>
                <button type="submit" name="operation" value="subtract" class="calc-btn operator">−</button>
                <button type="submit" name="operation" value="multiply" class="calc-btn operator">×</button>
                <button type="submit" name="operation" value="divide" class="calc-btn operator">÷</button>
                <button type="submit" name="operation" value="power" class="calc-btn operator">xⁿ</button>
                <button type="submit" name="operation" value="modulo" class="calc-btn operator">%</button>
                <button type="reset" class="calc-btn clear">C</button>
                <button type="submit" name="operation" value="calculate" class="calc-btn equals">=</button>
            </div>
            
            <input type="hidden" name="calculator" value="1">
        </form>
    </div>
    
</div>

<div class="footer">
    <p>🎓 ЛЗ №10 | <strong>Gorbunov | Группа 9ПО-31</strong></p>
    <p>📅 <?php echo date('d.m.Y H:i'); ?> | 💻 PHP <?php echo PHP_VERSION; ?></p>
    <p>
        <a href="https://github.com/blablalblable/gorbunov.com" target="_blank" style="color:#fff;">
            🔗 github.com/blablalblable/gorbunov.com
        </a>
    </p>
</div>

</body>
</html>
