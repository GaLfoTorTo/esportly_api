<script setup>
import { ref } from 'vue';
import { useInView } from '@/Composables/useInView.js';

const { el, inView } = useInView(0.1);
const active = ref(0);

const modalities = [
  {
    key:         'futebol',
    label:       'Futebol',
    icon:        'fas fa-futbol',
    tagline:     'O esporte mais amado do Brasil',
    description: 'Do campo amador ao profissional, o E-sportly transforma toda pelada em uma experiência de alto nível. Organize times, registre gols e acompanhe seu desempenho.',
    features:    ['Escalação de times', 'Placar ao vivo', 'Ranking de artilheiros', 'Modo técnico (Cartola-like)'],
    accent:      '#04D361',
    image:       'https://images.unsplash.com/photo-1574629810360-7efbbe195018?w=900&auto=format&fit=crop&q=75',
  },
  {
    key:         'basquete',
    label:       'Basquete',
    icon:        'fas fa-basketball-ball',
    tagline:     'Domine a quadra. Lidere o ranking.',
    description: 'Peladas de basquete com tudo que você precisa: contagem de pontos, assistências, rebotes e muito mais. Suba no ranking e mostre que você é o craque.',
    features:    ['Contagem de pontos', 'Estatísticas de atleta', 'Ranking de jogadores', 'Agendamento de partidas'],
    accent:      '#EB3D0B',
    image:       'https://images.unsplash.com/photo-1546519638-68e109498ffc?w=900&auto=format&fit=crop&q=75',
  },
  {
    key:         'volei',
    label:       'Vôlei',
    icon:        'fas fa-volleyball-ball',
    tagline:     'A praia, a areia e a sua rede de amigos.',
    description: 'Vôlei de praia ou quadra — organize sets, registre serviços e bloqueios. O E-sportly leva o espírito competitivo para cada saque e defesa espetacular.',
    features:    ['Sets e pontos', 'Times fixos ou aleatórios', 'Estatísticas de saque', 'Busca de quadras próximas'],
    accent:      '#D1A57A',
    image:       'https://images.unsplash.com/photo-1612872087720-bb876e2e67d1?w=900&auto=format&fit=crop&q=75',
  },
];
</script>

<template>
  <section id="modality" ref="el" class="mod-section">
    <div class="mod-header" :class="{ visible: inView }">
      <span class="eyebrow">Modalidades</span>
      <h2 class="section-title">Seu esporte, suas regras</h2>
      <p class="section-sub">
        E-sportly foi criado para os amantes do futebol, mas cresce junto com você.
        Escolha sua modalidade e domine o jogo do seu jeito.
      </p>
    </div>

    <!-- Tab selector -->
    <div class="mod-tabs" :class="{ visible: inView }">
      <button
        v-for="(mod, i) in modalities"
        :key="mod.key"
        class="mod-tab"
        :class="{ active: i === active }"
        :style="i === active ? { borderColor: mod.accent, color: mod.accent } : {}"
        @click="active = i"
      >
        <i :class="[mod.icon, 'mr-2']" />
        {{ mod.label }}
      </button>
    </div>

    <!-- Active card -->
    <Transition name="card-fade" mode="out-in">
      <div :key="active" class="mod-card" :class="{ visible: inView }">
        <div
          class="mod-bg"
          :style="{ backgroundImage: `url(${modalities[active].image})` }"
        />
        <div
          class="mod-overlay"
          :style="{
            background: `linear-gradient(120deg,
              ${modalities[active].accent}cc 0%,
              rgba(12,6,38,0.85) 55%,
              rgba(12,6,38,0.95) 100%)`
          }"
        />
        <div class="mod-content">
          <i :class="[modalities[active].icon, 'sport-icon']" />
          <h3 class="mod-tagline">{{ modalities[active].tagline }}</h3>
          <h2 class="mod-name">{{ modalities[active].label }}</h2>
          <p class="mod-desc">{{ modalities[active].description }}</p>
          <ul class="mod-features">
            <li v-for="feat in modalities[active].features" :key="feat">
              <i class="fas fa-check-circle" :style="{ color: modalities[active].accent }" />
              {{ feat }}
            </li>
          </ul>
          <button class="mod-cta" :style="{ background: modalities[active].accent }">
            Explorar {{ modalities[active].label }}
            <i class="fas fa-arrow-right ml-2" />
          </button>
        </div>
      </div>
    </Transition>
  </section>
</template>

<style scoped>
.mod-section {
  background: #ffffff;
  padding: 7rem 2rem 6rem;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  align-items: center;
}

/* Entrance */
.mod-header, .mod-tabs {
  opacity: 0; transform: translateY(24px);
  transition: opacity 0.65s ease, transform 0.65s ease;
}
.mod-tabs { transition-delay: 0.15s; }
.mod-header.visible, .mod-tabs.visible { opacity: 1; transform: none; }

.mod-card {
  opacity: 0; transform: translateY(32px) scale(0.98);
  transition: opacity 0.7s ease 0.25s, transform 0.7s ease 0.25s;
}
.mod-card.visible { opacity: 1; transform: none; }

/* Header */
.mod-header { text-align: center; margin-bottom: 2.5rem; }
.eyebrow {
  display: inline-block;
  color: var(--green-500); font-weight: 700; font-size: 0.78rem;
  letter-spacing: 0.12em; text-transform: uppercase; margin-bottom: 0.75rem;
}
.section-title {
  font-size: clamp(1.7rem, 3vw, 2.6rem); font-weight: 900;
  color: var(--blue-500); line-height: 1.18; letter-spacing: -0.02em; margin-bottom: 1rem;
}
.section-sub {
  font-size: 1.05rem; color: #6b7280;
  max-width: 520px; margin: 0 auto; line-height: 1.65;
}

/* Tabs */
.mod-tabs { display: flex; gap: 0.75rem; margin-bottom: 2.5rem; flex-wrap: wrap; justify-content: center; }
.mod-tab {
  padding: 0.6rem 1.5rem; border-radius: 999px;
  border: 2px solid #e5e7eb; background: transparent;
  color: #6b7280; font-weight: 600; font-size: 0.9rem;
  cursor: pointer; transition: border-color 0.3s ease, color 0.3s ease;
}
.mod-tab:hover { border-color: #9ca3af; color: #374151; }
.mod-tab.active { font-weight: 700; }

/* Card */
.mod-card {
  position: relative; width: 100%; max-width: 1100px; min-height: 520px;
  border-radius: 2rem; overflow: hidden;
  box-shadow: 0 24px 64px rgba(0,0,0,0.18);
  display: flex; align-items: center;
}
.mod-bg {
  position: absolute; inset: 0;
  background-size: cover; background-position: center;
  transition: transform 6s ease;
}
.mod-card:hover .mod-bg { transform: scale(1.04); }
.mod-overlay { position: absolute; inset: 0; }

.mod-content {
  position: relative; z-index: 2;
  padding: 3.5rem 3.5rem 3.5rem 4rem; max-width: 560px;
}
.sport-icon { font-size: 2.5rem; color: white; margin-bottom: 1rem; display: block; }
.mod-tagline {
  font-size: 0.9rem; color: rgba(255,255,255,0.7);
  font-weight: 600; letter-spacing: 0.06em; text-transform: uppercase; margin-bottom: 0.4rem;
}
.mod-name {
  font-size: 3rem; font-weight: 900; color: white;
  line-height: 1; margin-bottom: 1.25rem; letter-spacing: -0.03em;
}
.mod-desc {
  font-size: 1rem; color: rgba(255,255,255,0.78);
  line-height: 1.7; margin-bottom: 2rem;
}
.mod-features {
  list-style: none; padding: 0; margin: 0 0 2rem;
  display: grid; grid-template-columns: 1fr 1fr; gap: 0.6rem;
}
.mod-features li {
  display: flex; align-items: center; gap: 0.5rem;
  color: rgba(255,255,255,0.85); font-size: 0.9rem; font-weight: 500;
}
.mod-cta {
  display: inline-flex; align-items: center;
  padding: 0.8rem 1.75rem; border-radius: 999px; border: none;
  color: white; font-size: 0.95rem; font-weight: 700;
  cursor: pointer; transition: transform 0.25s ease, box-shadow 0.25s ease;
  box-shadow: 0 6px 20px rgba(0,0,0,0.25);
}
.mod-cta:hover { transform: translateY(-2px); box-shadow: 0 10px 28px rgba(0,0,0,0.3); }

/* Transition */
.card-fade-enter-active, .card-fade-leave-active {
  transition: opacity 0.3s ease, transform 0.3s ease;
}
.card-fade-enter-from { opacity: 0; transform: translateY(12px) scale(0.98); }
.card-fade-leave-to   { opacity: 0; transform: translateY(-8px) scale(0.98); }
</style>
