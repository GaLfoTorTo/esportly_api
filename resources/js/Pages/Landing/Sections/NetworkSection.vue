<script setup>
import { ref, watch } from 'vue';
import { useInView } from '@/Composables/useInView.js';

const { el, inView } = useInView(0.12);

const stats = [
  { value: 15000, suffix: '+', label: 'Jogadores ativos',   icon: 'fas fa-users' },
  { value: 5200,  suffix: '+', label: 'Peladas realizadas', icon: 'fas fa-futbol' },
  { value: 120,   suffix: '+', label: 'Cidades alcançadas', icon: 'fas fa-map-marker-alt' },
  { value: 4.9,   suffix: '★', label: 'Avaliação média',    icon: 'fas fa-star', decimal: true },
];

const displayed = ref(stats.map(() => 0));

const formatNum = (val, stat) => {
  if (stat.decimal) return val.toFixed(1) + stat.suffix;
  if (val >= 1000)  return (val / 1000).toFixed(1) + 'k' + stat.suffix;
  return val + stat.suffix;
};

const animateCounters = () => {
  stats.forEach((stat, i) => {
    const duration = 1800;
    const start    = performance.now();
    const tick = (now) => {
      const progress = Math.min((now - start) / duration, 1);
      const ease     = 1 - Math.pow(1 - progress, 3); // cubic ease-out
      displayed.value[i] = stat.decimal
        ? parseFloat((ease * stat.value).toFixed(1))
        : Math.round(ease * stat.value);
      if (progress < 1) requestAnimationFrame(tick);
    };
    requestAnimationFrame(tick);
  });
};

// Trigger counters once when section enters view
watch(inView, (val) => { if (val) animateCounters(); });
</script>

<template>
  <section id="network" ref="el" class="net-section">
    <!-- Left: text + stats -->
    <div class="net-text" :class="{ visible: inView }">
      <span class="eyebrow">Comunidade</span>
      <h2 class="section-title">Conecte-se com a sua rede de jogadores</h2>
      <p class="section-sub">
        O E-sportly vai além da organização de partidas. Ele conecta atletas da sua
        região, constrói comunidades e torna cada pelada uma experiência social única.
      </p>

      <div class="net-stats">
        <div v-for="(stat, i) in stats" :key="i" class="stat-card anim-item" :style="`--delay:${i * 80}ms`">
          <i :class="[stat.icon, 'stat-icon']" />
          <div class="stat-value">{{ formatNum(displayed[i], stat) }}</div>
          <div class="stat-label">{{ stat.label }}</div>
        </div>
      </div>
    </div>

    <!-- Right: visual network -->
    <div class="net-visual" :class="{ visible: inView }" aria-hidden="true">
      <!-- Central hub -->
      <div class="hub">
        <i class="fas fa-futbol hub-icon" />
        <div class="hub-pulse" />
        <div class="hub-pulse delay1" />
      </div>

      <!-- Orbiting player nodes — CSS animations only, no GSAP -->
      <div class="node node-1">
        <img
          src="https://images.unsplash.com/photo-1544723795-3fb6469f5b39?w=80&h=80&fit=crop&auto=format&q=75"
          alt="player" class="node-img" loading="lazy"
        />
        <div class="node-badge futebol">⚽</div>
      </div>
      <div class="node node-2">
        <img
          src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=80&h=80&fit=crop&auto=format&q=75"
          alt="player" class="node-img" loading="lazy"
        />
        <div class="node-badge basquete">🏀</div>
      </div>
      <div class="node node-3">
        <img
          src="https://images.unsplash.com/photo-1488426862026-3ee34a7d66df?w=80&h=80&fit=crop&auto=format&q=75"
          alt="player" class="node-img" loading="lazy"
        />
        <div class="node-badge volei">🏐</div>
      </div>
      <div class="node node-4">
        <img
          src="https://images.unsplash.com/photo-1463453091185-61582044d556?w=80&h=80&fit=crop&auto=format&q=75"
          alt="player" class="node-img" loading="lazy"
        />
        <div class="node-badge futebol">⚽</div>
      </div>
      <div class="node node-5">
        <img
          src="https://images.unsplash.com/photo-1529626455594-4ff0802cfb7e?w=80&h=80&fit=crop&auto=format&q=75"
          alt="player" class="node-img" loading="lazy"
        />
        <div class="node-badge basquete">🏀</div>
      </div>

      <!-- SVG connection lines -->
      <svg class="connections" viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg">
        <line x1="250" y1="250" x2="100" y2="130" class="conn-line" />
        <line x1="250" y1="250" x2="400" y2="120" class="conn-line" />
        <line x1="250" y1="250" x2="430" y2="310" class="conn-line" />
        <line x1="250" y1="250" x2="130" y2="370" class="conn-line" />
        <line x1="250" y1="250" x2="280" y2="420" class="conn-line" />
        <line x1="100" y1="130" x2="400" y2="120" class="conn-line conn-thin" />
        <line x1="400" y1="120" x2="430" y2="310" class="conn-line conn-thin" />
        <line x1="430" y1="310" x2="130" y2="370" class="conn-line conn-thin" />
      </svg>

      <!-- Floating event card -->
      <div class="event-card">
        <div class="event-icon">⚽</div>
        <div class="event-info">
          <strong>Pelada da Galera</strong>
          <small>Sábado • 15h • Quadra Norte</small>
        </div>
        <div class="event-count">+7</div>
      </div>
    </div>
  </section>
</template>

<style scoped>
.net-section {
  background: linear-gradient(135deg, var(--green-700) 0%, var(--green-500) 50%, var(--green-700) 100%);
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 5rem;
  padding: 7rem 3rem;
  flex-wrap: wrap;
}

/* ─── Entrance animations (CSS only) ─── */
.net-text {
  flex: 1; min-width: 300px; max-width: 520px;
  opacity: 0;
  transform: translateX(-40px);
  transition: opacity 0.75s ease, transform 0.75s ease;
}
.net-text.visible { opacity: 1; transform: none; }

.net-visual {
  flex: 1; min-width: 300px; max-width: 500px;
  position: relative; height: 500px;
  opacity: 0;
  transform: translateX(40px);
  transition: opacity 0.75s ease 0.2s, transform 0.75s ease 0.2s;
}
.net-visual.visible { opacity: 1; transform: none; }

.anim-item {
  opacity: 0;
  transform: translateY(20px);
  transition: opacity 0.55s ease var(--delay, 0ms),
              transform 0.55s ease var(--delay, 0ms);
}
.net-text.visible .anim-item { opacity: 1; transform: none; }

/* ─── Text ─── */
.eyebrow {
  display: inline-block;
  color: var(--green-300);
  font-weight: 700;
  font-size: 0.78rem;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  margin-bottom: 0.75rem;
}
.section-title {
  font-size: clamp(1.7rem, 3vw, 2.6rem);
  font-weight: 900;
  color: white;
  line-height: 1.18;
  letter-spacing: -0.02em;
  margin-bottom: 1.25rem;
}
.section-sub {
  font-size: 1.05rem;
  color: rgba(255,255,255,0.65);
  line-height: 1.7;
  margin-bottom: 2.5rem;
}

/* Stats */
.net-stats { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
.stat-card {
  background: rgba(255,255,255,0.06);
  border: 1px solid rgba(255,255,255,0.1);
  border-radius: 1rem;
  padding: 1.25rem;
  text-align: center;
  transition: background 0.3s ease, transform 0.3s ease,
              opacity 0.55s ease var(--delay,0ms), transform 0.55s ease var(--delay,0ms);
}
.stat-card:hover { background: rgba(255,255,255,0.1); transform: translateY(-3px); }
.stat-icon  { color: white; font-size: 1.3rem; margin-bottom: 0.5rem; display: block; }
.stat-value { font-size: 1.9rem; font-weight: 900; color: white; line-height: 1; }
.stat-label { font-size: 0.8rem; color: rgba(255,255,255,0.55); margin-top: 0.3rem; }

/* ─── Network visual ─── */
/* Central hub */
.hub {
  position: absolute; top: 50%; left: 50%;
  transform: translate(-50%, -50%);
  width: 80px; height: 80px;
  background: linear-gradient(135deg, var(--green-300), var(--green-500));
  border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  z-index: 3;
  box-shadow: 0 0 30px rgba(4, 211, 97, 0.4);
}
.hub-icon { font-size: 2rem; color: white; }
.hub-pulse {
  position: absolute; inset: -10px;
  border-radius: 50%;
  border: 2px solid rgba(4, 211, 97, 0.4);
  animation: pulse 2.5s ease-out infinite;
}
.hub-pulse.delay1 { inset: -22px; animation-delay: 0.8s; border-color: rgba(4, 211, 97, 0.2); }
@keyframes pulse {
  0%   { transform: scale(1);   opacity: 1; }
  100% { transform: scale(1.4); opacity: 0; }
}

/* Nodes — pure CSS float, no GSAP */
.node { position: absolute; width: 60px; height: 60px; border-radius: 50%; overflow: visible; z-index: 2; }
.node-1 { top: 14%; left: 12%; animation: nodeFloat1 6s ease-in-out infinite; }
.node-2 { top: 10%; left: 68%; animation: nodeFloat2 7s ease-in-out infinite; }
.node-3 { top: 52%; left: 78%; animation: nodeFloat3 8s ease-in-out infinite; }
.node-4 { top: 68%; left: 18%; animation: nodeFloat1 9s ease-in-out infinite reverse; }
.node-5 { top: 78%; left: 50%; animation: nodeFloat2 6.5s ease-in-out infinite; }

@keyframes nodeFloat1 { 0%,100%{transform:translateY(0) translateX(0)} 50%{transform:translateY(-10px) translateX(5px)} }
@keyframes nodeFloat2 { 0%,100%{transform:translateY(0) translateX(0)} 50%{transform:translateY(-7px) translateX(-6px)} }
@keyframes nodeFloat3 { 0%,100%{transform:translateY(0) translateX(0)} 50%{transform:translateY(-12px) translateX(4px)} }

.node-img {
  width: 60px; height: 60px; border-radius: 50%; object-fit: cover;
  border: 3px solid rgba(255,255,255,0.3);
  box-shadow: 0 4px 16px rgba(0,0,0,0.4);
}
.node-badge {
  position: absolute; bottom: -4px; right: -4px;
  width: 22px; height: 22px; border-radius: 50%;
  font-size: 0.65rem;
  display: flex; align-items: center; justify-content: center;
  border: 2px solid rgba(255,255,255,0.25);
}
.node-badge.futebol  { background: var(--green-500); }
.node-badge.basquete { background: var(--orange-500); }
.node-badge.volei    { background: var(--bege-500); }

/* SVG lines */
.connections { position: absolute; inset: 0; width: 100%; height: 100%; z-index: 1; }
.conn-line {
  stroke: white;
  stroke-width: 1.5;
  stroke-dasharray: 5 4;
  animation: dash 3s linear infinite;
}
.conn-thin {
  stroke-width: 1; stroke: rgba(255,255,255,0.5);
  animation: dash 5s linear infinite reverse;
}
@keyframes dash { to { stroke-dashoffset: -36; } }

/* Event card */
.event-card {
  position: absolute; bottom: 5%; right: -5%;
  background: rgba(255,255,255,0.08);
  backdrop-filter: blur(12px);
  border: 1px solid rgba(255,255,255,0.15);
  border-radius: 1rem;
  padding: 0.75rem 1rem;
  display: flex; align-items: center; gap: 0.75rem;
  min-width: 220px;
  animation: cardFloat 4s ease-in-out infinite;
  z-index: 4;
}
@keyframes cardFloat { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-8px)} }
.event-icon { font-size: 1.5rem; }
.event-info { flex: 1; }
.event-info strong { display: block; color: white; font-size: 0.9rem; font-weight: 700; }
.event-info small  { color: rgba(255,255,255,0.55); font-size: 0.75rem; }
.event-count {
  background: var(--green-500); color: white;
  font-size: 0.75rem; font-weight: 700;
  padding: 2px 8px; border-radius: 999px;
}
</style>
