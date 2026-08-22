<script setup>
import { computed, ref, watch } from 'vue';
import { useInView } from '@/Composables/useInView.js';
import { Card } from 'primevue';
import { useCurrentSport } from '@/composables/useCurrentSport';

//COMPOSABEL - VIEW
const { el, inView } = useInView(0.12);
//COMPOSABEL - CURRENT SPORT
const { sportCurrent } = useCurrentSport();

//STATISTICS
const stats = [
   { value: 15000, suffix: '+', label: 'Jogadores ativos',   icon: 'fas fa-users' },
   { value: 5200,  suffix: '+', label: 'Peladas realizadas', icon: 'fas fa-futbol' },
   { value: 120,   suffix: '+', label: 'Cidades alcançadas', icon: 'fas fa-map-marker-alt' },
   { value: 4.9,   suffix: '★', label: 'Avaliação média',    icon: 'fas fa-star', decimal: true },
];

//USUERS ORBITING
const users = computed(() => [
   {
      color: null,
      icon: null,
      img: "https://images.unsplash.com/photo-1544723795-3fb6469f5b39?w=80&h=80&fit=crop&auto=format&q=75"
   },
   {
      color: 'blue-500',
      icon: 'fas fa-clipboard',
      img: "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=80&h=80&fit=crop&auto=format&q=75"
   },
   {
      color: null,
      icon: null,
      img: "https://images.unsplash.com/photo-1488426862026-3ee34a7d66df?w=80&h=80&fit=crop&auto=format&q=75"
   },
   {
      color: null,
      icon: null,
      img: "https://images.unsplash.com/photo-1463453091185-61582044d556?w=80&h=80&fit=crop&auto=format&q=75"
   },
   {
      color: 'red-500',
      icon: 'fas fa-user-gear',
      img: "https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?80&h=80&fit=crop&auto=format&q=75"
   },
   {
      color: 'yellow-500',
      icon: 'fas fa-sliders',
      img: "https://images.unsplash.com/photo-1529626455594-4ff0802cfb7e?w=80&h=80&fit=crop&auto=format&q=75"
   },
   
]);

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
   <section
      id="network"
      ref="el"
      class="flex flex-wrap justify-center items-center gap-5 p-5 min-h-screen net-section"
      :style="`--net-dark: var(--${sportCurrent.color}-700); --net-mid: var(--${sportCurrent.color}-500);`"
   >
      <!-- Left: text + card stats -->
      <div class="flex flex-1 flex-col max-w-lg max-h-lg net-cards gap-5" :class="{ visible: inView }">
         <h2 class="text-2xl text-secondary-500 uppercase font-bold">Comunidade</h2>
         <h3 class="text-5xl text-white font-semibold">Conecte-se com novo atletas e amigos</h3>
         <p class="text-zinc-300">O E-sportly vai além da organização de partidas. Ele conecta atletas da sua
         região, constrói comunidades e torna cada pelada uma experiência social única.</p>
         <!-- Cards stats -->
         <div class="net-stats">
            <Card
               v-for="(stat, i) in stats" 
               :key="i" 
               class="stat-card anim-item" 
               :style="`--delay:${i * 80}ms`"
            >
               <template #content>
                  <i :class="[stat.icon, 'text-white stat-icon mb-5']" />
                  <p class="text-4xl font-bold text-white">{{ formatNum(displayed[i], stat) }}</p>
                  <small class="text-sm text-zinc-300">{{ stat.label }}</small>
               </template>
            </Card>
         </div>
      </div>

      <!-- Right: visual network -->
      <div class="flex flex-1 flex-col max-w-lg max-h-lg net-visual" :class="{ visible: inView }" aria-hidden="true">
         <!-- Central hub -->
         <div class="hub-wrapper" :style="`--hub-color: var(--${sportCurrent.color}-500);`">
            <div class="hub-pulse" />
            <div class="hub-pulse delay1" />
            <Button
               :icon="sportCurrent.icon"
               class="hub w-30! h-30! text-3xl!"
               :class="`bg-${sportCurrent.background}`"
               iconOnly
               rounded
            />
         </div>

         <!-- Orbiting player nodes — CSS animations only, no GSAP -->
         <div 
            v-for="(item, i) in users"
            class="absolute rounded-full overflow-visible w-16 h-16 z-2"
            :class="`node-${i + 1}`"
         >
            <img
               :src="item.img"
               alt="player" 
               class="object-cover rounded-full shadow-sm w-16 h-16" 
               loading="lazy"
            />
            <Button
               :icon="item.icon ?? sportCurrent.icon"
               class="border-none! text-xs! absolute! -bottom-1 -right-1 w-6! h-6! p-2"
               :class="[item.color ? `bg-${item.color} text-white!`: null]"
               iconOnly
               rounded
            />
         </div>

         <!-- SVG connection lines -->
         <svg class="connections" viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg">
            <line x1="250" x2="50" y1="260" y2="220" class="conn-line" />
            <line x1="250" x2="100" y1="250" y2="130" class="conn-line" />
            <line x1="250" x2="400" y1="250" y2="120" class="conn-line" />
            <line x1="250" x2="430" y1="250" y2="310" class="conn-line" />
            <line x1="250" x2="130" y1="250" y2="370" class="conn-line" />
            <line x1="250" x2="280" y1="250" y2="420" class="conn-line" />
            <line x1="100" x2="400" y1="130" y2="120" class="conn-line conn-thin" />
            <line x1="400" x2="430" y1="120" y2="310" class="conn-line conn-thin" />
            <line x1="430" x2="130" y1="310" y2="370" class="conn-line conn-thin" />
            <line x1="50"  x2="100" y1="250" y2="120" class="conn-line conn-thin" />
            <line x1="50"  x2="150" y1="200" y2="400" class="conn-line conn-thin" />
         </svg>

         <!-- Floating event card -->
         <Card class="event-card text-white! z-3 w-60">
            <template #content>
               <i :class="sportCurrent.icon"></i>
               <div class="flex flex-col">
                  <strong>Pelada da Galera</strong>
                  <small><i class="mr-2 fas fa-calendar"></i>Sábado, 16h</small>
                  <small><i class="mr-2 fas fa-location-dot"></i>Quadra Norte</small>
               </div>
            </template>
         </Card>
      </div>
   </section>
</template>

<style scoped>

/* Variáveis tipadas como <color> — único jeito de animar gradientes no CSS */
@property --net-dark {
   syntax: '<color>';
   inherits: false;
   initial-value: #015924;
}
@property --net-mid {
   syntax: '<color>';
   inherits: false;
   initial-value: #03983E;
}

.net-section {
   background: linear-gradient(135deg, var(--net-dark) 0%, var(--net-mid) 50%, var(--net-dark) 100%);
   transition: --net-dark 0.65s ease, --net-mid 0.65s ease;
}

/* ─── Entrance animations (CSS only) ─── */
.net-cards {
   opacity: 0;
   transform: translateX(-40px);
   transition: opacity 0.75s ease, transform 0.75s ease;
}

.net-visual {
   opacity: 0;
   position: relative;
   top: 50px;
   left: 70px;
   min-height: 500px;
   transform: translateX(40px);
   transition: opacity 0.75s ease 0.2s, transform 0.75s ease 0.2s;
}

.anim-item {
   opacity: 0;
   transform: translateY(20px);
   transition: opacity 0.55s ease var(--delay, 0ms),
               transform 0.55s ease var(--delay, 0ms);
}

.net-cards.visible { opacity: 1; transform: none; }
.net-visual.visible { opacity: 1; transform: none; }
.net-cards.visible .anim-item { opacity: 1; transform: none; }

/* Stats */
.net-stats { 
   display: grid; 
   grid-template-columns: 1fr 1fr; 
   gap: 1rem; 
}

.stat-card {
   background: rgba(255,255,255,0.06);
   border: 1px solid rgba(255,255,255,0.15);
   backdrop-filter: blur(4px);
   border-radius: 1rem;
   padding: 1.25rem;
   text-align: center;
   transition: background 0.3s ease, transform 0.3s ease,
               opacity 0.55s ease var(--delay,0ms), transform 0.55s ease var(--delay,0ms);
}

.stat-card:hover { background: rgba(255,255,255,0.1); transform: translateY(-3px); }
.stat-icon  { display: block; }

/* ─── Network visual ─── */
/* Central hub */
.hub-wrapper {
   position: absolute; top: 50%; left: 50%;
   transform: translate(-50%, -50%);
   display: flex; 
   align-items: center; 
   justify-content: center;
   z-index: 3;
}

.hub {
   background: rgba(255,255,255,0.1);
   border: none !important;
   position: relative;
   z-index: 1;
   transition: background 0.5s ease,
}

.hub-pulse {
   position: absolute;
   inset: -12px;
   border-radius: 50%;
   border: 2px solid var(--hub-color, rgba(4, 211, 97, 0.45));
   animation: pulse 2.5s ease-out infinite;
   pointer-events: none;
   opacity: 0.65;
}
.hub-pulse.delay1 {
   inset: -26px;
   animation-delay: 0.8s;
   opacity: 0.35;
   border-color: var(--hub-color, rgba(4, 211, 97, 0.3));
}

@keyframes pulse {
   0%   { transform: scale(1);   opacity: 1; }
   100% { transform: scale(1.4); opacity: 0; }
}

/* Nodes — pure CSS float*/
.node-1 { top: 14%; left: 12%; animation: nodeFloat1 6s ease-in-out infinite; }
.node-2 { top: 10%; left: 68%; animation: nodeFloat2 7s ease-in-out infinite; }
.node-3 { top: 52%; left: 78%; animation: nodeFloat3 8s ease-in-out infinite; }
.node-4 { top: 68%; left: 18%; animation: nodeFloat1 9s ease-in-out infinite reverse; }
.node-5 { top: 78%; left: 50%; animation: nodeFloat2 6.5s ease-in-out infinite; }
.node-6 { top: 39%; left: 2%; animation: nodeFloat3 9s ease-in-out infinite reverse; }

@keyframes nodeFloat1 { 0%,100%{transform:translateY(0) translateX(0)} 50%{transform:translateY(-10px) translateX(5px)} }
@keyframes nodeFloat2 { 0%,100%{transform:translateY(0) translateX(0)} 50%{transform:translateY(-7px) translateX(-6px)} }
@keyframes nodeFloat3 { 0%,100%{transform:translateY(0) translateX(0)} 50%{transform:translateY(-12px) translateX(4px)} }


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
   position: absolute; bottom: 28px; right: -80px;
   background: rgba(255,255,255,0.08);
   border: 1px solid rgba(255,255,255,0.25);
   backdrop-filter: blur(12px);
   border: 1px solid rgba(255,255,255,0.15);
   animation: cardFloat 4s ease-in-out infinite;
}
@keyframes cardFloat { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-8px)} }
</style>
