   <script setup>
   import { onMounted, onUnmounted } from 'vue';
   import { Button } from 'primevue';
   import gsap from 'gsap';
   import { useCurrentSport } from '@/composables/useCurrentSport';

   const { sports, sportCurrent, sportNext, switchSport, cycleNext } = useCurrentSport();

   //STATISTICS
   const stats = [
      { title: 'Esportes', value: '3'},
      { title: 'Modalidades', value: '9'},
      { title: 'Usuários', value: '+100'},
      { title: 'Peladas', value: '+30'},
   ]

   let intervalId = null;

   onMounted(() => {
      intervalId = setInterval(() => cycleNext(), 10000);

      // Entrance timeline
      const tl = gsap.timeline({ delay: 0.4 });
      tl.from('.h-eyebrow',  { opacity: 0, y: 18, duration: 0.55, ease: 'power2.out' })
         .from('.h-title',    { opacity: 0, y: 50, duration: 0.75, ease: 'power3.out' }, '-=0.25')
         .from('.h-subtitle', { opacity: 0, y: 24, duration: 0.6,  ease: 'power2.out' }, '-=0.4')
         .from('.h-buttons',  { opacity: 0, y: 20, duration: 0.5,  ease: 'power2.out' }, '-=0.35')
         .from('.h-stat',     { opacity: 0, y: 16, duration: 0.5,  ease: 'power2.out', stagger: 0.1 }, '-=0.3')
         .from('.h-tabs',     { opacity: 0, y: 14, duration: 0.4,  ease: 'power2.out' }, '-=0.25');

      // Floating scroll indicator
      gsap.to('.scroll-cue', {
         y: 10, duration: 1.1, ease: 'sine.inOut', repeat: -1, yoyo: true,
      });
   });

   onUnmounted(() => clearInterval(intervalId));

</script>
<template>
   <section 
      id="overview" 
      class="flex flex-col jsutify-center items-center p-5 pt-30! min-h-screen"
   >
      <!-- Background Video -->
      <div class="absolute z-0 inset-0">
         <video
            :key="sportCurrent.id"
            autoplay 
            muted 
            loop 
            playsinline
            class="fade-video absolute w-full h-full object-cover"
         >
            <source :src="sportCurrent.video" type="video/mp4" />
         </video>
         <div :class="['overlay', sportCurrent.overlay]" />
         <div :class="['overlay', sportNext.overlay]" v-if="sportNext" />
         <div 
            class="absolute bottom-0 left-0 right-0 h-[40%]" 
            style="background: linear-gradient(to top, rgba(246, 245, 250, 1), transparent);"
         />
      </div>
      <!-- Floating particles -->
      <div class="absolute inset-0 pointer-none z-1" aria-hidden="true">
         <span v-for="n in 11" :key="n" :class="`particle particle-${n} p-${n}`" />
      </div>
      <!-- Content -->
      <div class="flex flex-col gap-5 relative z-2 pt-10 text-center max-w-200">
         <!-- Title -->
         <h1 class="text-7xl font-bold text-white">
            Eleve sua pelada<br />
            para o Próximo Nível
         </h1>
         <!-- Subtitle -->
         <h2 class="text-2xl text-white pt-5">
            Encontre e organize partidas, pontue dentro e fora das quadras e aproveite
            uma experiência única no seu esporte favorito — com amigos, na sua cidade.
         </h2>
         <!-- Buttons Action -->
         <div class="flex justify-center items-center gap-5 mb-5">
            <Button 
               label="Começar agora" 
               size="large" 
               class="btn btn-primary" 
               rounded 
               raised 
            />
            <Button 
               label="Ver o app"
               size="large" 
               class="btn btn-outline" 
               rounded 
               raised
            />
         </div>
         <!-- Stats -->
         <div class="flex flex-row justify-center items-center">
            <div
               v-for="(stat, i) in stats"
               class="flex flex-col justify-center items-center gap-1 px-5 text-white"
               :class="[[0,1].includes(i) ? 'border-r' : 'border-l']"
            >
               <strong class="text-[1.8rem] font-bold">{{ stat.value}}</strong>
               <span class="text-[0.78rem]">{{ stat.title }}</span>
            </div>
         </div>
         <!-- Buttons Sport -->
         <div class="flex flex-row justify-center items-center gap-5 mt-5 w-full">
            <Button
               v-for="(sp, i) in sports"
               :key="sp.id"
               :label="sp.label"
               :icon="sp.icon"
               variant="outlined"
               class="btn-sport py-3! px-5!"
               :class="[sportCurrent.key == sp.key ? `btn-sport-${sp.key}` : null]"
               rounded
               @click="switchSport(i)"
            />
         </div>
      </div>
   </section>
</template>
<style scoped>
   /* Background video fade-in ao trocar esporte */
   .fade-video {
      animation: oFadeIn 0.65s ease both;
   }

   /* Overlay de videos */
   .overlay {
      position: absolute;
      inset: 0;
      pointer-events: none;
      animation: oFadeIn 0.65s ease both;
   }
   .overlay-futebol {
      background: linear-gradient(
         150deg,
         rgba(4, 211, 97, 0.82) 0%,
         rgba(3, 152, 62, 0.65) 35%,
         rgba(1, 89, 36, 0.65) 100%
      );
   }
   .overlay-basquete {
      background: linear-gradient(
         150deg,
         rgba(235, 61, 11, 0.82) 0%,
         rgba(155, 41, 8, 0.65) 35%,
         rgba(73, 19, 4, 0.65) 100%
      );
   }
   .overlay-volei {
      background: linear-gradient(
         150deg,
         rgba(209, 165, 122, 0.82) 0%,
         rgba(148, 108, 75, 0.65) 35%,
         rgba(75, 45, 21, 0.65) 100%
      );
   }

   @keyframes oFadeIn { from { opacity: 0 } to { opacity: 1 } }

   /* Particles */
   .particle {
      position: absolute;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.18);
      animation: float linear infinite;
      will-change: transform;
   }
   /* 8 partículas com posições variadas — equilibra visual e performance */
   .particle-1 { width: 8px;  height: 8px;  top: 12%; left:  8%; animation-duration:  8s; animation-delay: 0s; }
   .particle-2 { width: 5px;  height: 5px;  top: 25%; left: 78%; animation-duration: 11s; animation-delay: 1s; }
   .particle-3 { width: 12px; height: 12px; top: 60%; left:  5%; animation-duration:  9s; animation-delay: 2s; }
   .particle-4 { width: 6px;  height: 6px;  top: 80%; left: 88%; animation-duration: 13s; animation-delay: 0.5s; }
   .particle-5 { width: 9px;  height: 9px;  top: 40%; left: 85%; animation-duration:  7s; animation-delay: 1.5s; }
   .particle-6 { width: 4px;  height: 4px;  top: 70%; left: 45%; animation-duration: 10s; animation-delay: 3s; }
   .particle-7 { width: 7px;  height: 7px;  top: 15%; left: 55%; animation-duration: 12s; animation-delay: 0.8s; }
   .particle-8 { width: 10px; height: 10px; top: 55%; left: 28%; animation-duration:  8s; animation-delay: 2.5s; }

   @keyframes float {
      0%   { transform: translateY(0)    rotate(0deg);   opacity: 0.6; }
      50%  { transform: translateY(-28px) rotate(180deg); opacity: 1; }
      100% { transform: translateY(0)    rotate(360deg); opacity: 0.6; }
   }

   /* Buttons Action */

   :deep(.btn) {
      font-weight: 600 !important;
      padding: 0.9rem 2.2rem !important;
      font-size: 1rem !important;
      transition: transform 0.2s ease, box-shadow 0.2s ease !important;
   }
   :deep(.btn-primary) {
      background: #ffffff !important;
      color: var(--blue-500) !important;
      border: none !important;
   }
   :deep(.btn-outline) {
      background: rgba(255,255,255,0.1) !important;
      color: white !important;
      border: 2px solid rgba(255,255,255,0.55) !important;
      backdrop-filter: blur(6px);
      transition: background 0.2s ease,
   }
   :deep(.btn:hover) {
      transform: translateY(-3px) !important;
      box-shadow: 0 12px 32px rgba(0,0,0,0.25) !important;
   }
   :deep(.btn-outline:hover) {
      background: rgba(255,255,255,0.2) !important;
      border-color: white !important;
   }

   /* Button Sports */
   :deep(.btn-sport) {
      background: rgba(255,255,255,0.1) !important;
      color: white !important;
      border: 2px solid rgba(255,255,255,0.55) !important;
      backdrop-filter: blur(6px);
      transition: background 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease !important;
   }

   :deep(.btn-sport:hover) {
      transform: translateY(-3px) !important;
      box-shadow: 0 3px 10px rgba(0,0,0,0.25) !important;
   }

   :deep(.btn-sport-futebol) {
      background-color: var(--green-300) !important;
      border: 1px solid var(--green-500) !important;
      color: var(--blue-500) !important;
      transform: scale(1.1) !important;
   }
   :deep(.btn-sport-basquete) {
      background-color: var(--orange-300) !important;
      border: 1px solid var(--organge-500) !important;
      color: var(--blue-500) !important;
      transform: scale(1.1) !important;
   }
   :deep(.btn-sport-volei) {
      background-color: var(--bege-300) !important;
      border: 1px solid var(--bege-500) !important;
      color: var(--blue-500) !important;
      transform: scale(1.1) !important;
   }
</style>
