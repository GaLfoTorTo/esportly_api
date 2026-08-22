<script setup lang="ts">
import { ref } from 'vue';
import { Card } from 'primevue';

const props = defineProps({
  feature: String,
});

const features = [
  {
    type:        'manager',
    icon:        'fas fa-clipboard-list',
    title:       'Gerenciamento',
    subtitle:    'Mantenha seu evento organizado.',
    description: 'Gestão completa do seu evento esportivo: participantes, partidas, escalações e resultados num só lugar.',
    footer:      'Controle total na palma da mão.',
    class:       ['w-[15rem]', 'h-[30rem]'],
    accent:      'var(--green-300)',
    style: {
      backgroundImage:    "url('/img/feature/card_manager.jpg')",
      backgroundSize:     'cover',
      backgroundPosition: 'center',
    },
  },
  {
    type:        'chat',
    icon:        'fas fa-paper-plane',
    title:       'Comunicação',
    subtitle:    'Chat centralizado no app.',
    description: 'Chats individuais e em grupo para combinar horários e estratégias com seus amigos sem sair do E-sportly.',
    class:       ['w-[15rem]', 'h-[14rem]'],
    accent:      'var(--blue-300)',
    style: {
      backgroundImage:    "url('/img/feature/card_chat.jpg')",
      backgroundSize:     'cover',
      backgroundPosition: 'center',
    },
  },
  {
    type:        'notify',
    icon:        'fas fa-bell',
    title:       'Notificações',
    subtitle:    'Fique por dentro de tudo.',
    description: 'Alertas em tempo real sobre partidas, convites e atualizações da sua vida de atleta.',
    class:       ['w-[15rem]', 'h-[14rem]'],
    accent:      'var(--orange-300)',
    style: {
      backgroundImage:    "url('/img/futebol/football.jpg')",
      backgroundSize:     'cover',
      backgroundPosition: 'center',
    },
  },
  {
    type:        'maps',
    icon:        'fas fa-compass',
    title:       'Mapas',
    subtitle:    'Explore eventos próximos a você.',
    description: 'Encontre peladas e quadras na sua região usando nossa base de dados geolocalizada.',
    footer:      '+15.000 locais cadastrados.',
    class:       ['w-[15rem]', 'h-[30rem]'],
    accent:      'var(--cyan-500)',
    style: {
      backgroundImage:    "url('/img/futebol/football.jpg')",
      backgroundSize:     'cover',
      backgroundPosition: 'center',
    },
  },
  {
    type:        'custom',
    icon:        'fas fa-user-edit',
    title:       'Personalização',
    subtitle:    'Seu perfil, suas características.',
    description: 'Defina posições, arquétipos e habilidades do seu atleta para uma experiência única.',
    footer:      'Personalize seu perfil de atleta.',
    class:       ['w-[23rem]', 'h-[15rem]'],
    accent:      'var(--purple-300)',
    style: {
      backgroundImage:    "url('/img/futebol/football.jpg')",
      backgroundSize:     'cover',
      backgroundPosition: 'center',
    },
  },
  {
    type:        'achievement',
    icon:        'fas fa-medal',
    title:       'Conquistas',
    subtitle:    'Suba de nível a cada partida.',
    description: 'Gamificação com desafios semanais, mensais e emblemas especiais para os melhores atletas.',
    footer:      'Desafios esportivos e recompensas.',
    class:       ['w-[23rem]', 'h-[15rem]'],
    accent:      'var(--yellow-500)',
    style: {
      backgroundImage:    "url('/img/futebol/football.jpg')",
      backgroundSize:     'cover',
      backgroundPosition: 'center',
    },
  },
];

const card = features.find(f => f.type === props.feature);
const hovered = ref(false);
</script>

<template>
  <Card
    class="feat-card relative cursor-pointer select-none"
    :class="card.class"
    :style="card.style"
    @mouseenter="hovered = true"
    @mouseleave="hovered = false"
  >
    <template #content>
      <!-- Dark gradient base -->
      <div class="card-gradient" />

      <!-- Accent glow on hover -->
      <div
        class="card-glow"
        :style="{ background: card.accent, opacity: hovered ? 0.18 : 0 }"
      />

      <!-- Default state: icon + title -->
      <Transition name="flip">
        <div v-if="!hovered" class="card-front">
          <div class="card-icon-wrap" :style="{ color: card.accent }">
            <i :class="card.icon" />
          </div>
          <h3 class="card-title">{{ card.title }}</h3>
          <small class="card-subtitle">{{ card.subtitle }}</small>
        </div>
      </Transition>

      <!-- Hover state: description -->
      <Transition name="flip-reverse">
        <div v-if="hovered" class="card-back">
          <i :class="[card.icon, 'card-back-icon']" :style="{ color: card.accent }" />
          <h3 class="card-back-title">{{ card.title }}</h3>
          <p class="card-desc">{{ card.description }}</p>
          <small v-if="card.footer" class="card-footer-text">{{ card.footer }}</small>
        </div>
      </Transition>
    </template>
  </Card>
</template>

<style scoped>
/* ─── Card base ─── */
.feat-card {
  border-radius: 1.25rem !important;
  overflow: hidden;
  transition: transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1),
              box-shadow  0.35s ease;
  box-shadow: 0 4px 20px rgba(0,0,0,0.12);
}
.feat-card:hover {
  transform: translateY(-6px) scale(1.02);
  box-shadow: 0 16px 40px rgba(0,0,0,0.22);
}

:deep(.p-card-body) {
  flex: 1;
  display: flex;
  flex-direction: column;
  position: relative;
  overflow: hidden;
  padding: 0;
}
:deep(.p-card-content) {
  flex: 1;
  display: flex;
  flex-direction: column;
  padding: 0;
  height: 100%;
}

/* Background layers */
.card-gradient {
  position: absolute;
  inset: 0;
  background: linear-gradient(
    to top,
    rgba(12, 6, 38, 0.92) 0%,
    rgba(12, 6, 38, 0.55) 50%,
    rgba(12, 6, 38, 0.2) 100%
  );
  z-index: 0;
  pointer-events: none;
}
.card-glow {
  position: absolute;
  inset: 0;
  z-index: 1;
  pointer-events: none;
  transition: opacity 0.45s ease;
  mix-blend-mode: screen;
}

/* ─── Front (default) ─── */
.card-front {
  position: absolute;
  inset: 0;
  z-index: 2;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 0.75rem;
  padding: 1.5rem;
  text-align: center;
}
.card-icon-wrap {
  width: 56px; height: 56px;
  border-radius: 50%;
  background: rgba(255,255,255,0.1);
  display: flex; align-items: center; justify-content: center;
  font-size: 1.5rem;
  backdrop-filter: blur(4px);
  border: 1px solid rgba(255,255,255,0.15);
  transition: transform 0.3s ease;
}
.feat-card:hover .card-icon-wrap { transform: scale(1.1); }

.card-title {
  color: white;
  font-weight: 800;
  font-size: 1.05rem;
  margin: 0;
  letter-spacing: -0.01em;
}
.card-subtitle {
  color: rgba(255,255,255,0.6);
  font-size: 0.78rem;
}

/* ─── Back (hover) ─── */
.card-back {
  position: absolute;
  inset: 0;
  z-index: 2;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: flex-end;
  padding: 1.5rem;
  gap: 0.5rem;
}
.card-back-icon {
  font-size: 1.25rem;
  margin-bottom: 0.2rem;
}
.card-back-title {
  color: white;
  font-size: 1.1rem;
  font-weight: 800;
  margin: 0;
  letter-spacing: -0.01em;
}
.card-desc {
  color: rgba(255,255,255,0.78);
  font-size: 0.82rem;
  line-height: 1.55;
  margin: 0;
}
.card-footer-text {
  color: rgba(255,255,255,0.45);
  font-size: 0.72rem;
}

/* ─── Transitions ─── */
.flip-enter-active, .flip-leave-active,
.flip-reverse-enter-active, .flip-reverse-leave-active {
  transition: opacity 0.25s ease, transform 0.25s ease;
}
.flip-enter-from { opacity: 0; transform: scale(0.92) translateY(8px); }
.flip-leave-to   { opacity: 0; transform: scale(0.88) translateY(-6px); }

.flip-reverse-enter-from { opacity: 0; transform: scale(0.92) translateY(-8px); }
.flip-reverse-leave-to   { opacity: 0; transform: scale(0.88) translateY(6px); }
</style>
