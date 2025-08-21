<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Đăng ký</title>
  <style>
    :root {
      --card: #111827;
      --muted: #94a3b8;
      --text: #e5e7eb;
      --primary: #6366f1;
      --primary-600: #5457e0;
      --ring: #a5b4fc;
      --ok: #22c55e;
      --danger: #ef4444;
    }
    * { box-sizing: border-box; }
    html, body { height: 100%; }
    body {
      margin: 0;
      font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial;
      color: var(--text);
      background: url('./public/images/aaaa.png') no-repeat center center fixed;
      background-size: cover;
      display: grid;
      place-items: center;
      padding: 24px;
    }
    .card {
      width: 100%;
      max-width: 420px;
      background: rgba(0,0,0,0.6);
      backdrop-filter: blur(8px);
      border: 1px solid rgba(255,255,255,0.06);
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.35);
      padding: 28px;
    }
    .title { font-size: 26px; margin: 0 0 8px; font-weight: 700; }
    .subtitle { color: var(--muted); margin: 0 0 24px; font-size: 14px; }
    .field { margin-bottom: 16px; }
    label { display: inline-block; margin-bottom: 6px; font-size: 14px; color: #cbd5e1; }
    .input {
      width: 100%;
      border-radius: 14px;
      padding: 14px;
      border: 1px solid rgba(148,163,184,0.25);
      background: rgba(2,6,23,0.5);
      color: var(--text);
      outline: none;
      font-size: 16px;
    }
    .input:focus { border-color: var(--ring); box-shadow: 0 0 0 4px rgba(165,180,252,0.25); }
    .btn {
      width: 100%;
      margin-top: 8px;
      border: none;
      border-radius: 14px;
      padding: 14px 16px;
      font-size: 16px;
      font-weight: 700;
      background: linear-gradient(135deg, var(--primary), var(--primary-600));
      color: white;
      cursor: pointer;
      box-shadow: 0 8px 20px rgba(99,102,241,0.35);
    }
    .btn:hover { filter: brightness(1.05); }
    .success { display: none; margin-top: 16px; font-size: 14px; color: var(--ok); text-align: center; }
    .footer { margin-top: 18px; font-size: 12px; color: var(--muted); text-align: center; }
    .error-text { display: none; color: var(--danger); font-size: 13px; margin-top: 4px; }
    .hint { font-size: 12px; color: var(--muted); }
  </style>
</head>
<body>
  <main class="card" role="main" aria-labelledby="title">
    <h1 id="title" class="title">Đăng ký</h1>
    <p class="subtitle">Nhập thông tin của bạn để tạo tài khoản.</p>
    <?php if (!empty($error)): ?>
      <div class="success" style="display:block; color: var(--danger);">
        <?php echo htmlspecialchars($error); ?>
      </div>
    <?php endif; ?>

    <!-- form gửi về PHP -->
    <form id="signup" action="?act=register" method="POST" novalidate>
      <!-- Họ và tên -->
      <div class="field">
        <label for="name">Họ và tên</label>
        <input class="input" type="text" id="name" name="name"
          placeholder="Ví dụ: Nguyễn Văn A" required minlength="2"
          aria-describedby="nameHelp nameErr"/>
        <div id="nameHelp" class="hint">Tối thiểu 2 ký tự.</div>
        <div id="nameErr" class="error-text">Vui lòng nhập họ và tên hợp lệ.</div>
      </div>

      <!-- Email -->
      <div class="field">
        <label for="email">Email</label>
        <input class="input" type="email" id="email" name="email"
          placeholder="ví dụ: ten@domain.com" required aria-describedby="emailErr"/>
        <div id="emailErr" class="error-text">Vui lòng nhập email hợp lệ.</div>
      </div>

      <!-- Số điện thoại -->
      <div class="field">
        <label for="phone">Số điện thoại</label>
        <input class="input" type="tel" id="phone" name="phone"
          placeholder="Ví dụ: 0912 345 678 hoặc +84 912 345 678"
          required pattern="[0-9+\s\-]{9,15}" aria-describedby="phoneHelp phoneErr"/>
        <div id="phoneHelp" class="hint">Độ dài 9–15 ký tự, có thể +84.</div>
        <div id="phoneErr" class="error-text">Vui lòng nhập số điện thoại hợp lệ.</div>
      </div>

      <!-- Mật khẩu -->
      <div class="field">
        <label for="password">Mật khẩu</label>
        <input class="input" type="password" id="password" name="password"
          placeholder="Nhập mật khẩu" required minlength="6"
          aria-describedby="passHelp passErr"/>
        <div id="passHelp" class="hint">Ít nhất 6 ký tự.</div>
        <div id="passErr" class="error-text">Mật khẩu phải có ít nhất 6 ký tự.</div>
      </div>

      <!-- Nhập lại mật khẩu -->
      <div class="field">
        <label for="confirm_password">Nhập lại mật khẩu</label>
        <input class="input" type="password" id="confirm_password" name="confirm_password"
          placeholder="Nhập lại mật khẩu" required aria-describedby="cpassErr"/>
        <div id="cpassErr" class="error-text">Mật khẩu nhập lại không khớp.</div>
      </div>

      <button type="submit" name="tao" class="btn">Tạo tài khoản</button>
      <div id="success" class="success">Đăng ký thành công! (Demo)</div>
    </form>

    <div class="footer">Bằng cách tiếp tục, bạn đồng ý với Điều khoản & Chính sách bảo mật.</div>
  </main>

  <script>
    const form = document.getElementById('signup');
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const phoneInput = document.getElementById('phone');
    const passInput = document.getElementById('password');
    const cpassInput = document.getElementById('confirm_password');
    const success = document.getElementById('success');

    function showError(id) { document.getElementById(id).style.display = 'block'; }
    function clearError(id) { document.getElementById(id).style.display = 'none'; }

    function validateName() {
      if (nameInput.value.trim().length < 2) { showError('nameErr'); return false; }
      clearError('nameErr'); return true;
    }
    function validateEmail() {
      if (!emailInput.validity.valid) { showError('emailErr'); return false; }
      clearError('emailErr'); return true;
    }
    function validatePhone() {
      if (!phoneInput.validity.valid) { showError('phoneErr'); return false; }
      clearError('phoneErr'); return true;
    }
    function validatePassword() {
      if (passInput.value.trim().length < 6) { showError('passErr'); return false; }
      clearError('passErr'); return true;
    }
    function validateConfirmPassword() {
      if (cpassInput.value !== passInput.value || cpassInput.value === "") {
        showError('cpassErr'); return false;
      }
      clearError('cpassErr'); return true;
    }

    // validate khi gõ
    nameInput.addEventListener('input', validateName);
    emailInput.addEventListener('input', validateEmail);
    phoneInput.addEventListener('input', validatePhone);
    passInput.addEventListener('input', validatePassword);
    cpassInput.addEventListener('input', validateConfirmPassword);

    form.addEventListener('submit', (e) => {
      const ok = [
        validateName(),
        validateEmail(),
        validatePhone(),
        validatePassword(),
        validateConfirmPassword()
      ].every(Boolean);

      if (!ok) {
        e.preventDefault(); // chặn submit nếu lỗi
        success.style.display = 'none';
      } else {
        success.style.display = 'block'; // demo
      }
    });
  </script>
</body>
</html>
