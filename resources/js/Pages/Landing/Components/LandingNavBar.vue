<script setup>
import { computed } from 'vue';
import { Avatar, Button, Toolbar } from 'primevue';

const props = defineProps({
  currentSport: {
    type: String,
    default: 'futebol',
  },
});

const emit = defineEmits(['navigate']);

const items = [
  { label: 'Overview',    section: 'overview',  icon: 'fas fa-home' },
  { label: 'Features',   section: 'features',  icon: 'fas fa-cogs' },
  { label: 'Modalidades',section: 'modality',  icon: 'fas fa-futbol' },
  { label: 'Network',    section: 'network',   icon: 'fas fa-globe' },
  { label: 'Download',   section: 'download',  icon: 'fas fa-download' },
];

const sportClass = computed(() => `navbar-${props.currentSport}`);

</script>
<template>
  <Toolbar 
    :class="['navbar', sportClass, 'rounded-2xl!']"
  >
    <template #start>
      <div class="flex items-center gap-3">
        <Avatar image="/svg/logo.svg" size="large" />
        <span class="brand-name">E-sportly</span>
      </div>
    </template>

    <template #center>
      <nav class="flex gap-1">
        <Button
          v-for="item in items"
          :key="item.section"
          :label="item.label"
          variant="text"
          class="nav-link"
          @click="$emit('navigate', item.section)"
        />
      </nav>
    </template>

    <template #end>
      <div class="flex gap-2">
        <Button 
          label="Login"    
          variant="link"     
          as="a" 
          href="/login"    
          class="nav-link" 
        />
        <Button 
          label="Cadastrar" 
          severity="contrast" 
          as="a" 
          href="/register" 
          class="nav-cta" 
          size="small" 
          rounded 
        />
      </div>
    </template>
  </Toolbar>
</template>

<style scoped>
.navbar {
  background: rgba(255, 255, 255, 0.15);
  backdrop-filter: blur(18px);
  -webkit-backdrop-filter: blur(18px);
  border: 1px solid rgba(255, 255, 255, 0.08);
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.35);
  position: fixed;
  top: 0; left: 0; right: 0;
  z-index: 1000;
  margin: 0.75rem !important;
  width: calc(100% - 1.5rem);
  transition: background 0.5s ease, border-color 0.5s ease;
}

.navbar-futebol  { background: rgba(4, 211, 97, 0.5)!important;  border-color: rgba(4, 211, 97, 0.3); }
.navbar-basquete { background: rgba(235, 61, 11, 0.5)!important; border-color: rgba(235, 61, 11, 0.3); }
.navbar-volei    { background: rgba(209, 165, 122, 0.5)!important; border-color: rgba(209, 165, 122, 0.3); }

.navbar-futebol:hover  { background: var(--green-500)!important;  border-color: rgba(4, 211, 97, 0.3); }
.navbar-basquete:hover { background: var(--orange-500)!important; border-color: rgba(235, 61, 11, 0.3); }
.navbar-volei:hover    { background: var(--bege-500)!important; border-color: rgba(209, 165, 122, 0.3); }

.brand-name {
  color: var(--blue-500);
  font-weight: 800;
  font-size: 1.1rem;
  letter-spacing: -0.01em;
}

:deep(.nav-link) {
  background: transparent !important;
  border: none !important;
  color: var(--blue-500) !important;
  font-weight: bold !important;
  transition: color 0.2s ease !important;
}

:deep(.nav-cta) {
  background: white !important;
  color: var(--blue-500) !important;
  border: none !important;
  font-weight: bold !important;
  font-size: 0.8rem !important;
}

:deep(.nav-link:hover) { color: #ffffff !important; }
</style>
