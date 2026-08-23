<script setup>
   import { ref } from 'vue';
   import { useInView } from '@/Composables/useInView.js';
import { Card } from 'primevue';

   const { el, inView } = useInView(0.1);
   const active = ref(0);
   //ESPORTES
   const sports = [
      {
         key:         'futebol',
         label:       'Futebol',
         icon:        'fas fa-futbol',
         subtitle:     'O esporte mais amado do Mundo',
         description: 'Do campo amador ao profissional, o E-sportly transforma toda pelada em uma experiência de alto nível. Organize times, registre gols e acompanhe seu desempenho.',
         features:    ['Configurações de partidas', 'Acompanhamento ao vivo', 'Ranking de Artilharia / Assistência', 'Modo técnico (Cartola-like)'],
         modalities:  ['Futebol', 'Fut7', 'Futsal'],
         color:       'green',
         image:       'https://images.unsplash.com/photo-1574629810360-7efbbe195018?w=900&auto=format&fit=crop&q=75',
      },
      {
         key:         'basquete',
         label:       'Basquete',
         icon:        'fas fa-basketball-ball',
         subtitle:     'Domine a quadra. Lidere o ranking.',
         description: 'Peladas de basquete com tudo que você precisa: contagem de pontos, assistências, rebotes e muito mais. Suba no ranking e mostre que você é o GOAT.',
         features:    ['Contagem de pontos', 'Estatísticas de atleta', 'Votação de MVP', 'Agendamento de partidas'],
         modalities:  ['Tradicional', '3x3', 'Streetball'],
         color:       'orange',
         image:       'https://images.unsplash.com/photo-1546519638-68e109498ffc?w=900&auto=format&fit=crop&q=75',
      },
      {
         key:         'volei',
         label:       'Vôlei',
         icon:        'fas fa-volleyball-ball',
         subtitle:     'A praia, a areia e a sua rede de amigos.',
         description: 'Vôlei de praia ou quadra — organize sets, registre serviços e bloqueios. O E-sportly leva o espírito competitivo para cada saque e defesa espetacular.',
         features:    ['Definição de Sets e pontos', 'Gestão de equipes', 'Estatísticas de pontuação', 'Busca de quadras próximas'],
         modalities:  ['Volei Indor', 'Volei de Praia', 'Fut Volei'],
         color:       'bege',
         image:       'https://images.unsplash.com/photo-1612872087720-bb876e2e67d1?w=900&auto=format&fit=crop&q=75',
      },
   ];
   //ESPORTE SELECIONADO
   const sportCurrent = ref(sports[active.value]);

</script>
<template>
   <section 
      id="modality" 
      ref="el" 
      class="flex flex-col justify-center gap-5 min-h-screen py-28"
   >
      <!-- Header -->
      <div class="flex flex-col gap-5 justify-center items-center text-center feat-header" :class="{ visible: inView }">
         <h2 class="text-2xl text-primary-500 uppercase font-bold">Modalidades</h2>
         <h3 class="text-5xl text-secondary-500 font-semibold">Seu esporte, suas regras</h3>
         <p class="text-zinc-500 max-w-[40%]">E-sportly foi criado para os amantes do futebol, mas cresce junto com você. Escolha sua modalidade e domine o jogo do seu jeito.</p>
      </div>

      <!-- Tab selector -->
      <div class="flex justify-center gap-5 mod-tabs" :class="{ visible: inView }">
         <Button
         v-for="item in sports"
         :key="item.key"
         :icon="item.icon"
         :label="item.label"
         class="btn-sport"
         :class="[sportCurrent.key == item.key ? `btn-sport-${item.key}`: null]"
         rounded
         @click="sportCurrent = item"
         />
      </div>

      <!-- Active card -->
      <Transition name="card-fade" mode="out-in">
         <div
            :key="sportCurrent.key"
            id="mod-card"
            class="relative flex items-center w-[75%] min-h-130 overflow-hidden rounded-2xl shadow-2xl self-center"
            :class="{ visible: inView }"
            :style="{
               background: `var(--${sportCurrent.color}-500)`
            }"
         >
            <div class="mod-bg" :style="{ backgroundImage: `url(${sportCurrent.image})`, opacity: 0.5}" />
            <div
               class="absolute inset-0 z-1 pointer-events-none"
               :style="{
                  background: `linear-gradient(120deg,
                     color-mix(in srgb, var(--${sportCurrent.color}-500) 80%, transparent) 0%,
                     color-mix(in srgb, var(--${sportCurrent.color}-300) 60%, transparent) 30%,
                     color-mix(in srgb, var(--${sportCurrent.color}-700) 100%, transparent) 100%)`
               }"
            />
            <div class="flex flex-col gap-5 p-10 z-2 relative">
               <div class="flex items-end gap-3">
                  <i :class="[sportCurrent.icon, 'text-white block text-7xl']" />
                  <h2 class="text-white font-bold text-5xl">{{ sportCurrent.label }}</h2>
               </div>
               <h3 class="text-white font-semibold text-3xl">{{ sportCurrent.subtitle }}</h3>
               <p class="text-white max-w-md">{{ sportCurrent.description }}</p>
               <div class="flex justify-between items-end w-full">
                  <ul class="list-none flex flex-col gap-1">
                     <li v-for="feat in sportCurrent.features" :key="feat" class="text-white">
                        <i class="fas fa-check-circle mr-2 text-white" />
                        <span>{{ feat }}</span>
                     </li>
                  </ul>
                  <div class="flex gap-2">
                     <Badge 
                        v-for="item in sportCurrent.modalities"
                        :value="item" 
                        class="mod-badge rounded-4xl!"
                     />
                  </div>
               </div>
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
.mod-tabs {
   opacity: 0; 
   transform: translateY(24px);
   transition: opacity 0.65s ease, transform 0.65s ease;
   transition-delay: 0.15s;
}

.mod-tabs.visible { opacity: 1; transform: none; }

/* Tabs */
.mod-tab {
   backdrop-filter: blur(4px);
   cursor: pointer; 
   transition: border-color 0.3s ease, color 0.3s ease;
}
.mod-tab:hover { 
   border-color: #9ca3af;
   color: #374151; 
}

/* Button Sports */
:deep(.btn-sport) {
   background: rgba(255,255,255,0.1) !important;
   color: var(--color-zinc-400) !important;
   border: 2px solid var(--color-zinc-300) !important;
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
   transform: scale(1.03) !important;
}
:deep(.btn-sport-basquete) {
   background-color: var(--orange-300) !important;
   border: 1px solid var(--organge-500) !important;
   color: var(--blue-500) !important;
   transform: scale(1.03) !important;
}
:deep(.btn-sport-volei) {
   background-color: var(--bege-300) !important;
   border: 1px solid var(--bege-500) !important;
   color: var(--blue-500) !important;
   transform: scale(1.03) !important;
}

/* Card */
#mod-card {
   opacity: 0; transform: translateY(32px) scale(0.98);
   transition: opacity 0.7s ease 0.25s, transform 0.7s ease 0.25s;
}
#mod-card.visible { opacity: 1; transform: none; }

.mod-bg {
   position: absolute; inset: 0;
   background-size: cover; 
   background-position: center;
   transition: transform 6s ease;
}
#mod-card:hover .mod-bg { transform: scale(1.04); }

.mod-badge {
  color: white !important;
  background: rgba(12,6,38,0.15);
  backdrop-filter: blur(4px);
  border: 1px solid white !important;
}

/* Transition */
.card-fade-enter-active, .card-fade-leave-active {
   transition: opacity 0.3s ease, transform 0.3s ease;
}
.card-fade-enter-from { opacity: 0; transform: translateY(12px) scale(0.98); }
.card-fade-leave-to   { opacity: 0; transform: translateY(-8px) scale(0.98); }
</style>
