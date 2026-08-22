<script setup>
import { ref } from 'vue';
import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

import LandingNavBar    from './Components/LandingNavBar.vue';
import HeroSection      from './Sections/HeroSection.vue';
import FeaturesSection  from './Sections/FeaturesSection.vue';
import NetworkSection   from './Sections/NetworkSection.vue';
import ModalitySection  from './Sections/ModalitySection.vue';
import DownloadSection  from './Sections/DownloadSection.vue';
import FooterSection    from './Sections/FooterSection.vue';

// Register once — child components reuse without re-registering
gsap.registerPlugin(ScrollTrigger);

const currentSport = ref('futebol');

const scrollTo = (section) => {
  document.getElementById(section)?.scrollIntoView({ behavior: 'smooth' });
};
</script>

<template>
  <LandingNavBar :current-sport="currentSport" @navigate="scrollTo" />
  <main>
    <HeroSection @sport-changed="(s) => currentSport = s" />
    <FeaturesSection />
    <NetworkSection  />
    <ModalitySection />
    <DownloadSection />
    <FooterSection   />
  </main>
</template>

<style>
html { scroll-behavior: smooth; }
body { margin: 0; padding: 0; background: #ffffff; overflow-x: hidden; }
</style>
