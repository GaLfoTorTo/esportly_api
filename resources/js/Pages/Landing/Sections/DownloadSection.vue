<script setup>
import { useInView } from '@/Composables/useInView.js';

const { el, inView } = useInView(0.1);

const features = [
  { icon: 'fas fa-map-marker-alt', text: 'Encontre peladas perto de você' },
  { icon: 'fas fa-chart-line',     text: 'Estatísticas detalhadas do seu desempenho' },
  { icon: 'fas fa-trophy',         text: 'Sistema de conquistas e gamificação' },
  { icon: 'fas fa-comments',       text: 'Chat integrado com seus colegas de time' },
];
</script>

<template>
  <section id="download" ref="el" class="dl-section">
    <div class="blob blob-1" aria-hidden="true" />
    <div class="blob blob-2" aria-hidden="true" />

    <!-- Left: text -->
    <div class="dl-text" :class="{ visible: inView }">
      <span class="eyebrow">Download</span>
      <h2 class="section-title">
        O esporte que você ama<br />
        <span class="title-accent">na palma da sua mão</span>
      </h2>
      <p class="section-sub">
        Disponível para iOS e Android. Baixe gratuitamente, crie sua conta e comece
        a organizar peladas em minutos.
      </p>

      <ul class="dl-features">
        <li v-for="feat in features" :key="feat.text">
          <span class="feat-icon"><i :class="feat.icon" /></span>
          {{ feat.text }}
        </li>
      </ul>

      <h3 class="section-subtitle">Em breve e todas as lojas de aplicativos</h3>

      <div class="dl-buttons">
        <a href="#" class="store-btn" aria-label="App Store">
          <i class="fab fa-apple text-2xl" />
          <div>
            <small>Disponível na</small>
            <strong>App Store</strong>
          </div>
        </a>
        <a href="#" class="store-btn" aria-label="Google Play">
          <i class="fab fa-google-play text-2xl" />
          <div>
            <small>Disponível no</small>
            <strong>Google Play</strong>
          </div>
        </a>
      </div>

      <!-- <p class="dl-note">
        <i class="fas fa-star text-yellow-400 mr-1" />
        <i class="fas fa-star text-yellow-400 mr-1" />
        <i class="fas fa-star text-yellow-400 mr-1" />
        <i class="fas fa-star text-yellow-400 mr-1" />
        <i class="fas fa-star text-yellow-400 mr-2" />
        <span>4.9 de 5 • +1.200 avaliações</span>
      </p> -->
    </div>

    <!-- Right: phone mockup -->
    <div class="dl-phone" :class="{ visible: inView }" aria-hidden="true">
      <div class="phone-frame">
        <div class="phone-notch" />
        <div class="phone-screen">
          <div class="app-header">
            <span class="app-logo">⚽ E-sportly</span>
            <i class="fas fa-bell app-bell" />
          </div>
          <div class="app-hero">
            <img
              src="https://images.unsplash.com/photo-1529156069898-49953e39b3ac?w=340&auto=format&fit=crop&q=75"
              alt="Pelada"
              class="app-img"
              loading="lazy"
            />
            <div class="app-img-overlay">
              <span class="live-badge">● AO VIVO</span>
            </div>
          </div>
          <div class="app-card">
            <div class="app-match-title">Pelada da Vila</div>
            <div class="app-match-sub">
              <i class="fas fa-map-marker-alt mr-1" />Quadra Norte
              <i class="fas fa-clock mx-2" />Sábado 15h
            </div>
            <div class="app-avatars">
              <div v-for="n in 5" :key="n" class="app-avatar" />
              <span class="app-more">+3</span>
            </div>
          </div>
          <div class="app-card app-card-sm">
            <i class="fas fa-trophy mr-2 text-yellow-400" />
            <span>Você marcou <strong>2 gols</strong> ontem!</span>
          </div>
        </div>
        <div class="phone-home-bar" />
      </div>

      <div class="dl-badge">
        <span class="badge-icon">🏆</span>
        <div>
          <strong>GOAT da Semana</strong>
          <small>Você lidera o ranking!</small>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
.dl-section {
  background: linear-gradient(135deg, #140750 0%, #0c0626 60%, #1a0860 100%);
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 5rem;
  padding: 7rem 3rem;
  flex-wrap: wrap;
  position: relative;
  overflow: hidden;
}

.blob {
  position: absolute; border-radius: 50%;
  filter: blur(80px); pointer-events: none;
}
.blob-1 { width: 500px; height: 500px; background: var(--green-300); top: -150px; left: -100px; opacity: 0.08; }
.blob-2 { width: 400px; height: 400px; background: var(--purple-500); bottom: -100px; right: -80px; opacity: 0.15; }

/* ─── Entrance ─── */
.dl-text {
  flex: 1; min-width: 300px; max-width: 500px; position: relative; z-index: 1;
  opacity: 0; transform: translateX(-36px);
  transition: opacity 0.75s ease, transform 0.75s ease;
}
.dl-text.visible { opacity: 1; transform: none; }

.dl-phone {
  flex: 0 0 auto; position: relative; z-index: 1;
  opacity: 0; transform: translateY(48px);
  transition: opacity 0.75s ease 0.2s, transform 0.75s ease 0.2s;
  animation: none;
}
.dl-phone.visible {
  opacity: 1; transform: translateY(0);
  animation: phoneFloat 3.5s ease-in-out 0.5s infinite;
}
@keyframes phoneFloat {
  0%,100% { transform: translateY(0); }
  50%      { transform: translateY(-12px); }
}

/* ─── Text ─── */
.eyebrow {
  display: inline-block; color: var(--green-300);
  font-weight: 700; font-size: 0.78rem; letter-spacing: 0.12em;
  text-transform: uppercase; margin-bottom: 0.75rem;
}
.section-title {
  font-size: clamp(2rem, 3.5vw, 3rem); font-weight: 900;
  color: white; line-height: 1.12; letter-spacing: -0.025em; margin-bottom: 1.25rem;
}
.section-subtitle {
  font-size: clamp(1.5rem, 2vw, 1.5rem); font-weight: 400;
  color: white; line-height: 1.12; letter-spacing: -0.025em; margin-bottom: 1.25rem;
}
.title-accent { color: var(--green-300); }
.section-sub {
  font-size: 1.05rem; color: rgba(255,255,255,0.65);
  line-height: 1.7; margin-bottom: 2rem;
}

.dl-features {
  list-style: none; padding: 0; margin: 0 0 2.5rem;
  display: flex; flex-direction: column; gap: 0.85rem;
}
.dl-features li {
  display: flex; align-items: center; gap: 0.85rem;
  color: rgba(255,255,255,0.82); font-size: 0.95rem;
}
.feat-icon {
  width: 36px; height: 36px; border-radius: 50%;
  background: rgba(4, 211, 97, 0.15);
  display: flex; align-items: center; justify-content: center;
  color: var(--green-300); font-size: 0.85rem; flex-shrink: 0;
}

/* Store buttons */
.dl-buttons { display: flex; gap: 1rem; margin-bottom: 1.5rem; flex-wrap: wrap; }
.store-btn {
  display: flex; align-items: center; gap: 0.85rem;
  background: rgba(255,255,255,0.08);
  border: 1.5px solid rgba(255,255,255,0.15);
  border-radius: 0.875rem; padding: 0.75rem 1.25rem;
  color: white; text-decoration: none; min-width: 160px;
  transition: background 0.3s ease, border-color 0.3s ease, transform 0.25s ease;
}
.store-btn:hover { background: rgba(255,255,255,0.14); border-color: rgba(255,255,255,0.35); transform: translateY(-2px); }
.store-btn div { display: flex; flex-direction: column; line-height: 1.2; }
.store-btn small { font-size: 0.7rem; color: rgba(255,255,255,0.6); }
.store-btn strong { font-size: 0.95rem; font-weight: 700; }

.dl-note { color: rgba(255,255,255,0.5); font-size: 0.85rem; }

/* ─── Phone ─── */
.phone-frame {
  width: 260px; background: #1a1a2e; border-radius: 40px;
  border: 3px solid rgba(255,255,255,0.12); overflow: hidden;
  box-shadow: 0 0 0 6px rgba(255,255,255,0.04), 0 40px 80px rgba(0,0,0,0.5);
  position: relative;
}
.phone-notch { width: 90px; height: 24px; background: #0d0d1a; border-radius: 0 0 16px 16px; margin: 0 auto; }
.phone-screen { padding: 0.75rem; display: flex; flex-direction: column; gap: 0.6rem; min-height: 480px; }

.app-header { display: flex; justify-content: space-between; align-items: center; padding: 0 0.25rem; }
.app-logo   { color: white; font-weight: 800; font-size: 0.9rem; }
.app-bell   { color: rgba(255,255,255,0.5); font-size: 0.9rem; }

.app-hero { position: relative; border-radius: 1rem; overflow: hidden; height: 160px; }
.app-img  { width: 100%; height: 100%; object-fit: cover; }
.app-img-overlay {
  position: absolute; inset: 0;
  background: linear-gradient(to top, rgba(0,0,0,0.5), transparent);
  display: flex; align-items: flex-start; justify-content: flex-end; padding: 0.5rem;
}
.live-badge {
  background: #e20505; color: white;
  font-size: 0.62rem; font-weight: 700; padding: 2px 7px; border-radius: 999px;
  animation: blink 1.5s ease infinite;
}
@keyframes blink { 0%,100%{opacity:1} 50%{opacity:0.6} }

.app-card {
  background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.08);
  border-radius: 0.875rem; padding: 0.75rem;
}
.app-match-title { color: white; font-weight: 700; font-size: 0.88rem; margin-bottom: 0.3rem; }
.app-match-sub   { color: rgba(255,255,255,0.5); font-size: 0.72rem; }
.app-avatars { display: flex; align-items: center; margin-top: 0.5rem; }
.app-avatar {
  width: 24px; height: 24px; border-radius: 50%;
  background: linear-gradient(135deg, var(--green-300), var(--blue-500));
  border: 2px solid #1a1a2e; margin-right: -6px;
}
.app-more { color: rgba(255,255,255,0.6); font-size: 0.72rem; margin-left: 10px; }
.app-card-sm { display: flex; align-items: center; color: rgba(255,255,255,0.75); font-size: 0.78rem; padding: 0.6rem 0.75rem; }
.phone-home-bar { width: 90px; height: 4px; background: rgba(255,255,255,0.2); border-radius: 2px; margin: 0.75rem auto; }

/* Floating badge */
.dl-badge {
  position: absolute; top: 20px; right: -70px;
  background: rgba(255,255,255,0.1); backdrop-filter: blur(12px);
  border: 1px solid rgba(255,255,255,0.15); border-radius: 1rem;
  padding: 0.6rem 0.9rem; display: flex; align-items: center; gap: 0.65rem;
  animation: floatBadge 3.5s ease-in-out infinite; white-space: nowrap;
}
@keyframes floatBadge { 0%,100%{transform:translateY(0) rotate(-1deg)} 50%{transform:translateY(-8px) rotate(1deg)} }
.badge-icon { font-size: 1.5rem; }
.dl-badge strong { display: block; color: white; font-size: 0.82rem; font-weight: 700; }
.dl-badge small  { color: rgba(255,255,255,0.55); font-size: 0.7rem; }
</style>
