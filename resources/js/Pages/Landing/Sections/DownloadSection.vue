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
  <section 
    id="download" 
    ref="el" 
    class="flex flex-wrap justify-center items-center gap-10 p-5 min-h-screen download-section"
  >
    <!-- Left: text -->
    <div class="dl-left flex flex-1 flex-col max-w-lg gap-5" :class="{ visible: inView }">
      <h2 class="text-2xl text-primary-500 uppercase font-bold anim-item" style="--delay: 0ms">Download</h2>
      <h3 class="text-5xl text-white font-semibold anim-item" style="--delay: 80ms">O esporte que você ama
        <span class="text-4xl text-primary-500 font-semibold">Na palma da sua mão</span>
      </h3>
      <p class="text-zinc-300 anim-item" style="--delay: 160ms">
        Disponível para iOS e Android. Baixe gratuitamente, crie sua conta e comece
        a organizar peladas em minutos.
      </p>
      <!-- Features -->
      <div
        v-for="(feat, i) in features"
        :key="feat.text"
        class="flex gap-2 anim-item"
        :style="`--delay: ${240 + i * 80}ms`"
      >
        <span class="rounded-full p-2" style="background: rgba(4, 211, 97, 0.15);">
          <i :class="[feat.icon, 'text-primary-500']" />
        </span>
        <span class="text-white">{{ feat.text }}</span>
      </div>
      <!-- Soon message -->
      <h3 class="text-2xl text-white anim-item" style="--delay: 560ms">Em breve em todas as lojas de aplicativos</h3>
      <!-- Buttons store -->
      <div class="flex justify-between items-center anim-item" style="--delay: 640ms">
        <a href="#" class="flex flex-1 items-center text-white rounded-xl p-3 gap-3 max-w-60 store-btn" aria-label="App Store">
          <i class="fab fa-apple text-2xl" />
          <div class="flex flex-col">
            <small>Disponível na</small>
            <strong>App Store</strong>
          </div>
        </a>
        <a href="#" class="flex flex-1 items-center text-white rounded-xl p-3 gap-3 max-w-60 store-btn" aria-label="Google Play">
          <i class="fab fa-google-play text-2xl" />
          <div class="flex flex-col">
            <small>Disponível no</small>
            <strong>Google Play</strong>
          </div>
        </a>
      </div>
    </div>

    <!-- Right: phone mockup -->
    <div class="flex flex-1 flex-col self-auto relative top-65! left-30! max-w-lg max-h-lg" :class="{ visible: inView }">
      <img src="/img/mockups/mockup_1.png" class="mockup mockup-1" alt="">
      <img src="/img/mockups/mockup_3.png" class="mockup mockup-3" alt="">
      <img src="/img/mockups/mockup_2.png" class="mockup mockup-2" alt="">
    </div>
  </section>
</template>

<style scoped>
.download-section {
  background: linear-gradient(135deg, var(--blue-500) 0%, var(--blue-700) 60%, var(--blue-500) 100%);
  transition: --net-dark 0.65s ease, --net-mid 0.65s ease;
}

/* ─── Left entrance (igual à NetworkSection) ─── */
.dl-left {
  opacity: 0;
  transform: translateX(-40px);
  transition: opacity 0.75s ease, transform 0.75s ease;
}
.dl-left.visible { opacity: 1; transform: none; }

.anim-item {
  opacity: 0;
  transform: translateY(20px);
  transition: opacity 0.55s ease var(--delay, 0ms),
              transform 0.55s ease var(--delay, 0ms);
}
.dl-left.visible .anim-item { opacity: 1; transform: none; }

/* ─── Mockup stack (scroll-reveal) ─── */
.mockup {
  position: absolute;
  bottom: 0;
  filter: drop-shadow(0 24px 40px rgba(0, 0, 0, 0.45));
  opacity: 0;
  transition: opacity 0.7s ease, transform 0.7s ease;
}

.mockup-1 {
  width: 60%;
  left: 0;
  transform: rotate(-10deg) translateY(60px);
  transform-origin: bottom center;
  z-index: 1;
}
.mockup-1 { transition-delay: 0.1s; }
.mockup-3 { transition-delay: 0.5s; }
.mockup-2 { transition-delay: 0.9s; }

.visible .mockup-1 { opacity: 1; transform: rotate(-10deg) translateY(0); }

.mockup-2 {
  width: 60%;
  right: -25%;
  bottom: 5px;
  transform: translateY(60px);
  transform-origin: bottom center;
  z-index: 3;
}
.visible .mockup-2 { opacity: 1; transform: translateY(0); }

.mockup-3 {
  width: 50%;
  left: 30%;
  bottom: 20px;
  transform: rotate(5deg) translateY(60px);
  transform-origin: bottom center;
  z-index: 2;
}
.visible .mockup-3 { opacity: 1; transform: rotate(5deg) translateY(0); }

/* Store buttons */
.store-btn {
  background: rgba(255,255,255,0.08);
  border: 1.5px solid rgba(255,255,255,0.15);
  transition: background 0.3s ease, border-color 0.3s ease, transform 0.25s ease;
}
.store-btn:hover { background: rgba(255,255,255,0.14); border-color: rgba(255,255,255,0.35); transform: translateY(-2px); }
</style>
