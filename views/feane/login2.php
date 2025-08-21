<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Đăng nhập</title>
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
  </style>
</head>
<body>
  <main class="card" role="user" aria-labelledby="title">
    <h1 id="title" class="title">Đăng nhập</h1>
    <p class="subtitle">Nhập email và mật khẩu để truy cập tài khoản.</p>

    <form id="login" novalidate>
      <!-- Email -->
      <div class="field">
        <label for="email">Email</label>
        <input
          class="input"
          type="email"
          id="email"
          name="email"
          placeholder="ví dụ: ten@domain.com"
          required
        />
      </div>

      <!-- Mật khẩu -->
      <div class="field">
        <label for="password">Mật khẩu</label>
        <input
          class="input"
          type="password"
          id="password"
          name="password"
          placeholder="••••••••"
          required
          minlength="6"
        />
      </div>

      <button type="submit" class="btn">Đăng nhập</button>
      <div id="success" class="success">Đăng nhập thành công! (Demo)</div>
    </form>

    <div class="footer">Chưa có tài khoản? <a href="index.php?act=register" style="color:var(--primary)">Đăng ký</a></div>
  </main>

  <script>
  const form = document.getElementById('login');
  const emailInput = document.getElementById('email');
  const passwordInput = document.getElementById('password');
  const success = document.getElementById('success');

  form.addEventListener('submit', (e) => {
    e.preventDefault();
    const email = emailInput.value.trim();
    const password = passwordInput.value.trim();

    // ✅ Check admin

    // ✅ Check user
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (emailPattern.test(email) && password.length >= 6) {
      success.style.display = 'block';
      console.log("User login:", { email, password });
      // Redirect sang trang user/home
      window.location.href = "index.php?act=home";
    } else {
      success.style.display = 'none';
      alert("Vui lòng nhập email hợp lệ và mật khẩu tối thiểu 6 ký tự.");
    }
  });
</script>

</body>
</html>
