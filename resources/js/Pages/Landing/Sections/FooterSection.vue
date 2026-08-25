<script setup>
const links = [
  {label: 'Produto', items: ['Overview', 'Features', 'Modalidades', 'Network', 'Download']},
  {label: 'Empresa', items: ['Sobre nós', 'Contato', 'Suporte']},
  {label: 'Legal',   items: ['Privacidade', 'Termos de Uso', 'Serviços']},
];

const socials = [
  { icon: 'fab fa-instagram', href: 'https://instagram.com/esportly', label: 'Instagram' },
  { icon: 'fab fa-twitter',   href: '#', label: 'X' },
  { icon: 'fab fa-linkedin',  href: 'https://linkedin.com/in/leonardo-moreira-995842200', label: 'LinkedIn' },
  { icon: 'fab fa-github',    href: 'https://github.com/GalfoTorTo/esportly', label: 'GitHub' },
];
</script>

<template>
  <footer 
    id="footer" 
    class="footer flex flex-col text-white"
  >
    <div class="flex justify-evenly">
      <!-- Brand col -->
      <div class="flex flex-col gap-5 w-60">
        <div class="flex items-center gap-3 font-semibold">
          <img src="/svg/logo.svg" alt="E-sportly" class="brand-img" />
          <span>E-sportly</span>
        </div>
        <small class="brand-tagline">
          Sua diversão entre amigos nunca mais será o mesma.
          Organize, jogue e se destaque.
        </small>
        <div class="socials">
          <Button
            v-for="s in socials"
            :key="s.label"
            as="a"
            :href="s.href"
            :icon="s.icon"
            target="_blank"
            class="btn-social"
            onlyIcon
            rounded
          />
        </div>
      </div>

      <!-- Links cols -->
      <div class="flex gap-10">
        <div 
          v-for="product in links"
          class="flex flex-col"
        >
          <strong>{{ product.label }}</strong>
          <ul>
            <li 
              v-for="item in product.items" 
              :key="item"
              class="link-col"
            >
              <a href="#">{{ item }}</a>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <!-- Bottom bar -->
    <div class="flex justify-center py-5">
      <small class="footer-bar">&copy; E-sportly {{ new Date().getFullYear() }} — Todos os direitos reservados. Feito por <a href="https://www.linkedin.com/in/leonardo-moreira-995842200" target="_blank" rel="noopener">Leonardo Moreira</a></small>
    </div>
  </footer>
</template>

<style scoped>
.footer {
  background: linear-gradient(180deg, var(--green-700) 10%, var(--green-300) 80%);
  position: relative;
  padding: 4rem 3rem 2rem;
}
.brand-img {
  width: 36px; height: 36px;
  border-radius: 8px;
  object-fit: contain;
}

.brand-tagline {
  color: rgba(255,255,255,0.5);
  font-size: 0.88rem;
  line-height: 1.65;
  margin-bottom: 1.5rem;
}

:deep(.btn-social) {
  background: rgba(255,255,255,0.1) !important;
  color: white !important;
  border: 2px solid rgba(255,255,255,0.55) !important;
  backdrop-filter: blur(6px);
}

/* Links */
.link-col a {
  color: rgba(255,255,255,0.45);
  text-decoration: none;
  font-size: 0.88rem;
  transition: color 0.2s ease;
}
.link-col a:hover { color: rgba(255,255,255,0.85); }

/* Bottom bar */
.footer-bar {
  max-width: 1100px;
  margin: 0 auto;
  border-top: 1px solid rgba(255,255,255,0.07);
  padding-top: 1.5rem;
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 0.5rem;
}

.footer-bar a:hover { 
  font-weight: bold;
  text-decoration: none; }
</style>
