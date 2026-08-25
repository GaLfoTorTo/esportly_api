<script setup>
import { useInView } from '@/Composables/useInView.js';
import CardFeatures from '@/Components/CardFeatures.vue';

const { el, inView } = useInView(0.1);
</script>

<template>
  <section 
    id="features" 
    ref="el" 
    class="flex flex-col gap-5 min-h-screen py-28 bg-white"
  >
    <!-- Header -->
    <div class="flex flex-col gap-5 justify-center items-center text-center feat-header" :class="{ visible: inView }">
      <span class="text-2xl uppercase text-primary-500 font-semibold">Funcionalidades</span>
      <h2 class="text-5xl font-bold text-secondary-500 max-w-[50%]">Uma experiência única no mundo tecno-esportivo</h2>
      <p class="text-zinc-500 max-w-[40%]">Toda a facilidade que a tecnologia proporciona na palma das suas mãos, a serviço da sua diversão e do seu esporte.</p>
    </div>
    <!-- Row 1: Manager | Chat+Notify | Maps -->
    <div id="feat-row-1" class="flex flex-row justify-center items-center gap-5" :class="{ visible: inView }">
      <div class="anim-item" style="--delay: 0ms">
        <CardFeatures feature="manager" />
      </div>
      <div class="flex flex-col justify-between gap-8">
        <div class="anim-item" style="--delay: 120ms">
          <CardFeatures feature="chat" />
        </div>
        <div class="anim-item" style="--delay: 200ms">
          <CardFeatures feature="notify" />
        </div>
      </div>
      <div class="anim-item" style="--delay: 80ms">
        <CardFeatures feature="maps" />
      </div>
    </div>
    <!-- Row 2: Custom + Achievement -->
    <div id="feat-row-2" class="flex flex-row justify-center items-center gap-5" :class="{ visible: inView }">
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

/* Header */
.feat-header {
  opacity: 0;
  transform: translateY(28px);
  transition: opacity 0.7s ease, transform 0.7s ease;
}

.feat-header.visible { opacity: 1; transform: none; }

/* Card animation wrapper */
.anim-item {
  opacity: 0;
  transform: translateY(36px);
  transition: opacity 0.65s ease var(--delay, 0ms),
              transform 0.65s ease var(--delay, 0ms);
}
#feat-row-1.visible .anim-item,
#feat-row-2.visible .anim-item {
  opacity: 1;
  transform: none;
}
</style>
