<script setup lang="ts">
import { ref } from 'vue';
import { Card } from 'primevue';

const imgLoaded = ref(false);

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
    class:       ['w-[25rem]', 'h-[30rem]'],
    accent:      'var(--green-500)',
    img:         '/img/feature/card_manager.jpg',
  },
  {
    type:        'chat',
    icon:        'fas fa-paper-plane',
    title:       'Comunicação',
    subtitle:    'Chat centralizado no app.',
    description: 'Chats individuais e em grupo para combinar horários e estratégias com seus amigos sem sair do E-sportly.',
    class:       ['w-[25rem]', 'h-[14rem]'],
    accent:      'var(--blue-500)',
    img:         '/img/feature/card_chat.jpg',
  },
  {
    type:        'notify',
    icon:        'fas fa-bell',
    title:       'Notificações',
    subtitle:    'Fique por dentro de tudo.',
    description: 'Alertas em tempo real sobre partidas, convites e atualizações da sua vida de atleta.',
    class:       ['w-[25rem]', 'h-[14rem]'],
    accent:      'var(--orange-500)',
    img:         '/img/feature/card_notify.png',
  },
  {
    type:        'maps',
    icon:        'fas fa-compass',
    title:       'Mapas',
    subtitle:    'Explore eventos próximos a você.',
    description: 'Encontre peladas e quadras na sua região usando nossa base de dados geolocalizada.',
    footer:      '+15.000 locais cadastrados.',
    class:       ['w-[25rem]', 'h-[30rem]'],
    accent:      'var(--cyan-500)',
    img:         '/img/feature/card_map.jpg',
  },
  {
    type:        'custom',
    icon:        'fas fa-user-edit',
    title:       'Personalização',
    subtitle:    'Seu perfil, suas características.',
    description: 'Defina posições, arquétipos e habilidades do seu atleta para uma experiência única.',
    footer:      'Personalize seu perfil de atleta.',
    class:       ['w-[38rem]', 'h-[15rem]'],
    accent:      'var(--purple-500)',
    img:         '/img/feature/card_custom.png',
  },
  {
    type:        'achievement',
    icon:        'fas fa-medal',
    title:       'Conquistas',
    subtitle:    'Suba de nível a cada partida.',
    description: 'Gamificação com desafios semanais, mensais e emblemas especiais para os melhores atletas.',
    footer:      'Desafios esportivos e recompensas.',
    class:       ['w-[38rem]', 'h-[15rem]'],
    accent:      'var(--yellow-500)',
    img:         '/img/feature/card_achiviement.jpg',
  },
];

const card = features.find(f => f.type === props.feature);
const hovered = ref(false);
</script>

<template>
  <Card
    class="feat-card relative cursor-pointer select-none overflow-hidden"
    :class="card.class"
    @mouseenter="hovered = true"
    @mouseleave="hovered = false"
  >
    <template #content>
      <!-- Background image with lazy load + fade-in -->
      <img
        :src="card.img"
        alt=""
        class="card-bg-img"
        :class="{ loaded: imgLoaded }"
        loading="lazy"
        aria-hidden="true"
        @load="imgLoaded = true"
      />

      <!-- Dark gradient base -->
      <div class="card-gradient" />

      <!-- Accent glow on hover -->
      <div
        class="card-gradiente-houver"
        :style="{ background: card.accent, opacity: hovered ? 0.45 : 0 }"
      />

      <!-- Default state: icon + title -->
      <Transition name="flip">
        <div v-if="!hovered" class="flex flex-col justify-center items-center absolute inset-0 z-2 gap-2 p-2 text-center">
          <Button 
            :icon="card.icon"
            size="large"
            class="card-icon-wrap"
            iconOnly
            rounded
          />
          <h3 class="font-semibold text-white">{{ card.title }}</h3>
          <small class="text-zinc-300">{{ card.subtitle }}</small>
        </div>
      </Transition>

      <!-- Hover state: description -->
      <Transition name="flip-reverse">
        <div v-if="hovered" class="flex flex-col justify-end items-start absolute inset-0 z-2 gap-2 p-5">
          <Button 
            :icon="card.icon"
            size="large"
            class="card-icon-wrap"
            iconOnly
            rounded
          />
          <h3 class="font-semibold text-white">{{ card.title }}</h3>
          <small class="text-zinc-300">{{ card.description }}</small>
          <small v-if="card.footer" class="text-zinc-300">{{ card.footer }}</small>
        </div>
      </Transition>
    </template>
  </Card>
</template>

<style scoped>
/* Background image — lazy load com fade-in */
.card-bg-img {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
  opacity: 0;
  transition: opacity 0.6s ease;
  z-index: 0;
}
.card-bg-img.loaded { opacity: 1; }

/* Card Gradiente Background */
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

.card-gradiente-houver {
  position: absolute;
  inset: 0;
  z-index: 1;
  pointer-events: none;
  transition: opacity 0.45s ease;
  mix-blend-mode: screen;
}

/* Card base */
.feat-card {
  transition: transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1),
              box-shadow  0.35s ease;
  box-shadow: 0 4px 20px rgba(0,0,0,0.12);
}

.feat-card:hover {
  transform: translateY(-6px) scale(1.02);
  box-shadow: 0 16px 40px rgba(0,0,0,0.22);
}

/*  Card feture Front (default) */
.card-icon-wrap {
  color: white;
  background: rgba(255,255,255,0.1);
  backdrop-filter: blur(4px);
  border: 1px solid rgba(255,255,255,0.15);
  transition: transform 0.3s ease;
}

.feat-card:hover .card-icon-wrap { transform: scale(1.1); }

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
