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
  <link rel="stylesheet" href="style (1).css"></head>
<body>

<!-- navbar -->
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
      <a href="#profile">Profile</a>
      <a href="#about">About</a>
    </div>

<!-- auth area -->
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

<!-- songs -->
  <div class="songsSection" id="songs">
    <div class="sectionHeader">
      <div>
        <h1 class="sectionTitle">Featured Songs</h1>
        <p class="sectionSubtitle">Tap a song to rate it out of 5 and leave a comment.</p>
      </div>
    </div>

    <div class="songsContainer">
      <?php
        $featured = [
          ['title' => 'Blinding Lights', 'artist' => 'The Weeknd'],
          ['title' => 'Numb', 'artist' => 'Linkin Park'],
          ['title' => 'Die With A Smile', 'artist' => 'Lady Gaga & Bruno Mars'],
        ];
        foreach ($featured as $song):
      ?>
      <button class="card song-card" data-title="<?= htmlspecialchars($song['title']) ?>" data-artist="<?= htmlspecialchars($song['artist']) ?>">
        <div class="imageBox"></div>
        <div class="cardContent">
          <h2><?= htmlspecialchars($song['title']) ?></h2>
          <p><?= htmlspecialchars($song['artist']) ?></p>
          <span class="cardAction">Rate this song</span>
        </div>
      </button>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="profileSection" id="profile">
    <div class="sectionHeader">
      <div>
        <h1 class="sectionTitle">Your Rated Songs</h1>
        <p class="sectionSubtitle">Saved reviews appear here in your profile.</p>
      </div>
    </div>

    <div class="profileMessage">
      <?php if ($loggedIn): ?>
        <p>Rate a featured song to add it to your profile. Your ratings are saved automatically.</p>
      <?php else: ?>
        <p>Please sign in to rate songs and build your music log.</p>
      <?php endif; ?>
    </div>

    <div class="profileList" id="profileList">
      <?php if (!$loggedIn): ?>
        <div class="profileEmpty">No ratings yet — log in and rate a song.</div>
      <?php endif; ?>
    </div>
  </div>

<!-- footer -->
  <div class="footer" id="about">
    <p>© 2026 SoundLog</p>
    <p>Web Development 1 Project</p>
  </div>

<!-- login -->
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

<!-- signup -->
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

  <div class="modal-overlay" id="ratingModal">
    <div class="modal">
      <button class="modal-close" id="closeRating">✕</button>
      <div class="modal-logo">
        <img src="https://github.com/Kola0222/WebDev-SoundLog/blob/main/soundlog%20(1).png?raw=true" alt="SoundLog">
        <span>SoundLog</span>
      </div>
      <h2>Rate this song</h2>
      <p class="modal-sub">Give it a star rating and leave a note for your profile.</p>
      <div class="toast" id="ratingToast"></div>
      <div class="form-group">
        <label>Song</label>
        <input type="text" id="ratingSong" readonly>
      </div>
      <div class="form-group">
        <label>Artist</label>
        <input type="text" id="ratingArtist" readonly>
      </div>
      <div class="form-group">
        <label>Rating</label>
        <div class="starRow" id="ratingStars">
          <button type="button" class="starButton" data-value="1">★</button>
          <button type="button" class="starButton" data-value="2">★</button>
          <button type="button" class="starButton" data-value="3">★</button>
          <button type="button" class="starButton" data-value="4">★</button>
          <button type="button" class="starButton" data-value="5">★</button>
        </div>
      </div>
      <div class="form-group">
        <label>Comment</label>
        <textarea id="ratingComment" rows="4" placeholder="What makes this track stand out?"></textarea>
      </div>
      <button class="btn-submit" id="ratingSave">Save Rating</button>
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

  const loggedIn = <?= $loggedIn ? 'true' : 'false' ?>;
  let currentRating = 0;
  let currentSong = null;

  function openModal(id)  { $(id).classList.add('active'); document.body.style.overflow = 'hidden'; }
  function closeModal(id) { $(id).classList.remove('active'); document.body.style.overflow = ''; }

  function setRatingStars(value) {
    currentRating = value;
    document.querySelectorAll('.starButton').forEach(btn => {
      const btnValue = Number(btn.dataset.value);
      btn.classList.toggle('active', btnValue <= value);
    });
  }

  function openRatingModal(song, artist) {
    if (!loggedIn) {
      showToast('loginToast', 'Please log in to save ratings and comments.', 'error');
      openModal('loginModal');
      return;
    }

    currentSong = { song, artist };
    $('ratingSong').value = song;
    $('ratingArtist').value = artist;
    $('ratingComment').value = '';
    setRatingStars(0);
    clearToast('ratingToast');
    openModal('ratingModal');
  }

  async function loadProfileRatings() {
    if (!loggedIn) {
      return;
    }

    const profileList = $('profileList');
    profileList.innerHTML = '<div class="profileEmpty">Loading your rated songs…</div>';

    try {
      const res = await fetch('ratings.php?action=getRatings');
      const data = await res.json();
      if (!data.success) {
        throw new Error(data.message || 'Unable to load your ratings.');
      }
      if (!data.ratings || data.ratings.length === 0) {
        profileList.innerHTML = '<div class="profileEmpty">No ratings yet — rate a featured song to save it here.</div>';
        return;
      }

      profileList.innerHTML = data.ratings.map(item => `
        <div class="profileCard">
          <div>
            <h3>${item.song_title}</h3>
            <p class="profileArtist">${item.artist}</p>
            <div class="profileRating">${'★'.repeat(item.rating)}${'☆'.repeat(5 - item.rating)}</div>
          </div>
          <p class="profileComment">${item.comment ? item.comment.replace(/</g, '&lt;').replace(/>/g, '&gt;') : '<em>No comment provided.</em>'}</p>
        </div>
      `).join('');
    } catch (error) {
      profileList.innerHTML = `<div class="profileEmpty">${error.message}</div>`;
    }
  }

  $('openLoginBtn')  ?.addEventListener('click', () => openModal('loginModal'));
  $('openSignupBtn') ?.addEventListener('click', () => openModal('signupModal'));
  $('heroSignupBtn') ?.addEventListener('click', () => openModal('signupModal'));

  $('closeLogin')  .addEventListener('click', () => closeModal('loginModal'));
  $('closeSignup') .addEventListener('click', () => closeModal('signupModal'));

  ['loginModal','signupModal'].forEach(id => {
    $(id).addEventListener('click', e => { if (e.target === $(id)) closeModal(id); });
  });

  const ratingSaveButton = $('ratingSave');
  const ratingModalOverlay = $('ratingModal');

  document.querySelectorAll('.song-card').forEach(card => {
    card.addEventListener('click', () => openRatingModal(card.dataset.title, card.dataset.artist));
  });

  document.querySelectorAll('.starButton').forEach(btn => {
    btn.addEventListener('click', () => setRatingStars(Number(btn.dataset.value)));
  });

  $('closeRating').addEventListener('click', () => closeModal('ratingModal'));
  ratingModalOverlay?.addEventListener('click', e => { if (e.target === ratingModalOverlay) closeModal('ratingModal'); });

  ratingSaveButton?.addEventListener('click', async () => {
    clearToast('ratingToast');

    if (!currentSong) {
      showToast('ratingToast', 'No song selected.', 'error');
      return;
    }
    if (currentRating < 1) {
      showToast('ratingToast', 'Please choose a star rating.', 'error');
      return;
    }

    ratingSaveButton.disabled = true;
    ratingSaveButton.textContent = 'Saving…';

    const fd = new FormData();
    fd.append('action', 'saveRating');
    fd.append('song_title', currentSong.song);
    fd.append('artist', currentSong.artist);
    fd.append('rating', currentRating);
    fd.append('comment', $('ratingComment').value.trim());

    try {
      const res = await fetch('ratings.php', { method: 'POST', body: fd });
      const data = await res.json();
      if (!data.success) throw new Error(data.message || 'Unable to save rating.');

      showToast('ratingToast', data.message, 'success');
      setTimeout(() => {
        closeModal('ratingModal');
        loadProfileRatings();
        ratingSaveButton.disabled = false;
        ratingSaveButton.textContent = 'Save Rating';
      }, 800);
    } catch (error) {
      showToast('ratingToast', error.message, 'error');
      ratingSaveButton.disabled = false;
      ratingSaveButton.textContent = 'Save Rating';
    }
  });

  // Switch between modals
  $('switchToSignup').addEventListener('click', () => { closeModal('loginModal');  openModal('signupModal'); });
  $('switchToLogin') .addEventListener('click', () => { closeModal('signupModal'); openModal('loginModal'); });

  if (loggedIn) {
    loadProfileRatings();
  }

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
