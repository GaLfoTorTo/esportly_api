<script setup>
import { useInView } from '@/Composables/useInView.js';
import CardFeatures from '@/Components/CardFeatures.vue';

const { el, inView } = useInView(0.1);
</script>

<template>
  <section id="features" ref="el" class="feat-section">
    <!-- Header -->
    <div class="feat-header" :class="{ visible: inView }">
      <span class="eyebrow">Funcionalidades</span>
      <h2 class="section-title">Uma experiência única no mundo tecno-esportivo</h2>
      <p class="section-sub">
        Toda a facilidade que a tecnologia proporciona na palma das suas mãos,
        a serviço da sua diversão e do seu esporte.
      </p>
    </div>

    <!-- Row 1: Manager | Chat+Notify | Maps -->
    <div class="feat-row-1" :class="{ visible: inView }">
      <div class="feat-col-1 anim-item" style="--delay: 0ms">
        <CardFeatures feature="manager" />
      </div>

      <div class="feat-col-mid">
        <div class="anim-item" style="--delay: 120ms">
          <CardFeatures feature="chat" />
        </div>
        <div class="anim-item" style="--delay: 200ms">
          <CardFeatures feature="notify" />
        </div>
      </div>

      <div class="feat-col-3 anim-item" style="--delay: 80ms">
        <CardFeatures feature="maps" />
      </div>
    </div>

    <!-- Row 2: Custom + Achievement -->
    <div class="feat-row-2" :class="{ visible: inView }">
      <div class="anim-item" style="--delay: 0ms">
        <CardFeatures feature="custom" />
      </div>
      <div class="anim-item" style="--delay: 120ms">
        <CardFeatures feature="achievement" />
      </div>
    </div>
  </section>
</template>

<style scoped>
.feat-section {
  background: #f8f9fc;
  padding: 7rem 2rem 6rem;
  min-height: 100vh;
}

/* Header */
.feat-header {
  text-align: center;
  margin-bottom: 4rem;
  opacity: 0;
  transform: translateY(28px);
  transition: opacity 0.7s ease, transform 0.7s ease;
}
.feat-header.visible { opacity: 1; transform: none; }

.eyebrow {
  display: inline-block;
  color: var(--green-500);
  font-weight: 700;
  font-size: 0.78rem;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  margin-bottom: 0.75rem;
}
.section-title {
  font-size: clamp(1.7rem, 3vw, 2.6rem);
  font-weight: 900;
  color: var(--blue-500);
  max-width: 600px;
  margin: 0 auto 1rem;
  line-height: 1.18;
  letter-spacing: -0.02em;
}
.section-sub {
  font-size: 1.05rem;
  color: #6b7280;
  max-width: 520px;
  margin: 0 auto;
  line-height: 1.65;
}

/* Card animation wrapper */
.anim-item {
  opacity: 0;
  transform: translateY(36px);
  transition: opacity 0.65s ease var(--delay, 0ms),
              transform 0.65s ease var(--delay, 0ms);
  will-change: transform, opacity;
}
.feat-row-1.visible .anim-item,
.feat-row-2.visible .anim-item {
  opacity: 1;
  transform: none;
}

/* Layout rows */
.feat-row-1 {
  display: flex;
  justify-content: center;
  align-items: flex-start;
  gap: 1.5rem;
  flex-wrap: wrap;
  margin-bottom: 1.5rem;
}
.feat-col-1, .feat-col-3 { display: flex; flex-direction: column; justify-content: center; }
.feat-col-mid { display: flex; flex-direction: column; gap: 1.5rem; }
.feat-row-2 { display: flex; justify-content: center; gap: 1.5rem; flex-wrap: wrap; }
</style>
