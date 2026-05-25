<?php
session_start();
$loggedIn = isset($_SESSION['user_id']);
$username = $loggedIn ? htmlspecialchars($_SESSION['username']) : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SoundLog</title>
  <link rel="stylesheet" href="style.css"></head>
<body>

//navbar
  <div class="navbar">
    <div class="logoSection">
      <img src="https://github.com/Kola0222/WebDev-SoundLog/blob/main/soundlog%20(1).png?raw=true" width="60" alt="SoundLog">
      <div>
        <h1 class="title">SoundLog</h1>
        <p class="subtitle">Music Reviews</p>
      </div>
    </div>

    <div class="links">
      <a href="#home">Home</a>
      <a href="#songs">Songs</a>
      <a href="#about">About</a>
    </div>

// auth area
    <div class="nav-auth" id="navAuth">
      <?php if ($loggedIn): ?>
        <div class="user-pill">
          <p class="welcome-text">Hey, <span><?= $username ?></span></p>
          <button class="btn-signout" id="signOutBtn">Sign Out</button>
        </div>
      <?php else: ?>
        <button class="btn-nav-login"  id="openLoginBtn">Log In</button>
        <button class="btn-nav-signup" id="openSignupBtn">Sign Up</button>
      <?php endif; ?>
    </div>
  </div>

// hero
  <div class="hero" id="home">
    <h1 class="heroTitle">
      Track Your
      <span class="blueText">Favorite Music</span>
    </h1>
    <p>Log songs, rate music, and discover tracks.</p>
    <br>
    <div class="hero-cta">
      <button class="button">Explore</button>
      <?php if (!$loggedIn): ?>
        <button class="btn-hero-secondary" id="heroSignupBtn">Create Account</button>
      <?php endif; ?>
    </div>
  </div>

// songs
  <div class="songsSection" id="songs">
    <h1 class="sectionTitle">Featured Songs</h1>
    <br>
    <div class="songsContainer">
      <button class="card">
        <div class="imageBox"></div>
        <h2>Blinding Lights</h2>
        <p>The Weeknd</p>
      </button>
      <button class="card">
        <div class="imageBox"></div>
        <h2>Numb</h2>
        <p>Linkin Park</p>
      </button>
      <button class="card">
        <div class="imageBox"></div>
        <h2>Die With A Smile</h2>
        <p>Lady Gaga & Bruno Mars</p>
      </button>
    </div>
  </div>

//footer
  <div class="footer" id="about">
    <p>© 2026 SoundLog</p>
    <p>Web Development 1 Project</p>
  </div>

//login
  <div class="modal-overlay" id="loginModal">
    <div class="modal">
      <button class="modal-close" id="closeLogin">✕</button>

      <div class="modal-logo">
        <img src="https://github.com/Kola0222/WebDev-SoundLog/blob/main/soundlog%20(1).png?raw=true" alt="SoundLog">
        <span>SoundLog</span>
      </div>

      <h2>Welcome Back</h2>
      <p class="modal-sub">Sign in to your account</p>

      <div class="toast" id="loginToast"></div>

      <div class="form-group">
        <label>Email</label>
        <input type="email" id="loginEmail" placeholder="you@example.com" autocomplete="email">
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="password" id="loginPassword" placeholder="••••••••" autocomplete="current-password">
      </div>

      <button class="btn-submit" id="loginSubmit">Log In</button>

      <div class="modal-switch">
        Don't have an account? <a id="switchToSignup">Sign up</a>
      </div>
    </div>
  </div>

//signup
  <div class="modal-overlay" id="signupModal">
    <div class="modal">
      <button class="modal-close" id="closeSignup">✕</button>

      <div class="modal-logo">
        <img src="https://github.com/Kola0222/WebDev-SoundLog/blob/main/soundlog%20(1).png?raw=true" alt="SoundLog">
        <span>SoundLog</span>
      </div>

      <h2>Create Account</h2>
      <p class="modal-sub">Start logging your music journey</p>

      <div class="toast" id="signupToast"></div>

      <div class="form-group">
        <label>Username</label>
        <input type="text" id="signupUsername" placeholder="musicfan42" autocomplete="username">
      </div>
      <div class="form-group">
        <label>Email</label>
        <input type="email" id="signupEmail" placeholder="you@example.com" autocomplete="email">
      </div>
      <div class="form-group">
        <label>Password <span style="color:rgba(255,255,255,0.25);font-size:11px;">(min. 6 chars)</span></label>
        <input type="password" id="signupPassword" placeholder="••••••••" autocomplete="new-password">
      </div>

      <button class="btn-submit" id="signupSubmit">Create Account</button>

      <div class="modal-switch">
        Already have an account? <a id="switchToLogin">Log in</a>
      </div>
    </div>
  </div>


  <script>

  const $ = id => document.getElementById(id);

  function showToast(toastId, msg, type) {
    const el = $(toastId);
    el.textContent = msg;
    el.className = `toast ${type} show`;
  }
  function clearToast(toastId) {
    const el = $(toastId);
    el.className = 'toast';
    el.textContent = '';
  }

  function openModal(id)  { $(id).classList.add('active');    document.body.style.overflow = 'hidden'; }
  function closeModal(id) { $(id).classList.remove('active'); document.body.style.overflow = ''; }

  $('openLoginBtn')  ?.addEventListener('click', () => openModal('loginModal'));
  $('openSignupBtn') ?.addEventListener('click', () => openModal('signupModal'));
  $('heroSignupBtn') ?.addEventListener('click', () => openModal('signupModal'));

  $('closeLogin')  .addEventListener('click', () => closeModal('loginModal'));
  $('closeSignup') .addEventListener('click', () => closeModal('signupModal'));

  ['loginModal','signupModal'].forEach(id => {
    $(id).addEventListener('click', e => { if (e.target === $(id)) closeModal(id); });
  });

  // Switch between modals
  $('switchToSignup').addEventListener('click', () => { closeModal('loginModal');  openModal('signupModal'); });
  $('switchToLogin') .addEventListener('click', () => { closeModal('signupModal'); openModal('loginModal'); });

  $('loginSubmit').addEventListener('click', async () => {
    clearToast('loginToast');
    const email    = $('loginEmail').value.trim();
    const password = $('loginPassword').value;

    if (!email || !password) {
      showToast('loginToast', 'Please fill in all fields.', 'error');
      return;
    }

    $('loginSubmit').disabled = true;
    $('loginSubmit').textContent = 'Logging in…';

    const fd = new FormData();
    fd.append('action',   'login');
    fd.append('email',    email);
    fd.append('password', password);

    try {
      const res  = await fetch('auth.php', { method: 'POST', body: fd });
      const data = await res.json();

      if (data.success) {
        showToast('loginToast', data.message, 'success');
        setTimeout(() => { window.location.reload(); }, 900);
      } else {
        showToast('loginToast', data.message, 'error');
        $('loginSubmit').disabled = false;
        $('loginSubmit').textContent = 'Log In';
      }
    } catch {
      showToast('loginToast', 'Something went wrong. Please try again.', 'error');
      $('loginSubmit').disabled = false;
      $('loginSubmit').textContent = 'Log In';
    }
  });

  ['loginEmail','loginPassword'].forEach(id => {
    $(id).addEventListener('keydown', e => { if (e.key === 'Enter') $('loginSubmit').click(); });
  });

  $('signupSubmit').addEventListener('click', async () => {
    clearToast('signupToast');
    const username = $('signupUsername').value.trim();
    const email    = $('signupEmail').value.trim();
    const password = $('signupPassword').value;

    if (!username || !email || !password) {
      showToast('signupToast', 'Please fill in all fields.', 'error');
      return;
    }

    $('signupSubmit').disabled = true;
    $('signupSubmit').textContent = 'Creating account…';

    const fd = new FormData();
    fd.append('action',   'signup');
    fd.append('username', username);
    fd.append('email',    email);
    fd.append('password', password);

    try {
      const res  = await fetch('auth.php', { method: 'POST', body: fd });
      const data = await res.json();

      if (data.success) {
        showToast('signupToast', data.message, 'success');
        setTimeout(() => { window.location.reload(); }, 900);
      } else {
        showToast('signupToast', data.message, 'error');
        $('signupSubmit').disabled = false;
        $('signupSubmit').textContent = 'Create Account';
      }
    } catch {
      showToast('signupToast', 'Something went wrong. Please try again.', 'error');
      $('signupSubmit').disabled = false;
      $('signupSubmit').textContent = 'Create Account';
    }
  });

  ['signupUsername','signupEmail','signupPassword'].forEach(id => {
    $(id).addEventListener('keydown', e => { if (e.key === 'Enter') $('signupSubmit').click(); });
  });

  $('signOutBtn')?.addEventListener('click', async () => {
    const fd = new FormData();
    fd.append('action', 'logout');
    await fetch('auth.php', { method: 'POST', body: fd });
    window.location.reload();
  });
  </script>

</body>
</html>
