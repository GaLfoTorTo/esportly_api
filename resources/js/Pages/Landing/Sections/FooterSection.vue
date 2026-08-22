<script setup>
const products = ['Overview', 'Features', 'Modalidades', 'Network', 'Download'];
const company  = ['Sobre nós', 'Contato', 'Suporte'];
const legal    = ['Privacidade', 'Termos de Uso', 'Serviços'];

const socials = [
  { icon: 'fab fa-instagram', href: '#', label: 'Instagram' },
  { icon: 'fab fa-twitter',   href: '#', label: 'Twitter' },
  { icon: 'fab fa-linkedin',  href: '#', label: 'LinkedIn' },
  { icon: 'fab fa-github',    href: '#', label: 'GitHub' },
];
</script>

<template>
  <footer id="footer" class="footer">
    <!-- Top glow line -->
    <div class="footer-glow" aria-hidden="true" />

    <div class="footer-inner">
      <!-- Brand col -->
      <div class="footer-brand">
        <div class="brand-logo">
          <img src="/svg/logo.svg" alt="E-sportly" class="brand-img" />
          <span>E-sportly</span>
        </div>
        <p class="brand-tagline">
          Sua diversão entre amigos nunca mais será o mesmo.
          Organize, jogue e se destaque.
        </p>
        <div class="socials">
          <a
            v-for="s in socials"
            :key="s.label"
            :href="s.href"
            :aria-label="s.label"
            class="social-link"
          >
            <i :class="s.icon" />
          </a>
        </div>
      </div>

      <!-- Links cols -->
      <div class="footer-links">
        <div class="link-col">
          <strong>Produto</strong>
          <ul>
            <li v-for="item in products" :key="item">
              <a href="#">{{ item }}</a>
            </li>
          </ul>
        </div>
        <div class="link-col">
          <strong>Empresa</strong>
          <ul>
            <li v-for="item in company" :key="item">
              <a href="#">{{ item }}</a>
            </li>
          </ul>
        </div>
        <div class="link-col">
          <strong>Legal</strong>
          <ul>
            <li v-for="item in legal" :key="item">
              <a href="#">{{ item }}</a>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <!-- Bottom bar -->
    <div class="footer-bar">
      <small>&copy; E-sportly {{ new Date().getFullYear() }} — Todos os direitos reservados.</small>
      <small>Feito por <a href="https://www.linkedin.com/in/leonardo-moreira-995842200" target="_blank" rel="noopener">Leonardo Moreira</a></small>
    </div>
  </footer>
</template>

<style scoped>
.footer {
  background: linear-gradient(180deg, var(--green-700) 0%, var(--green-500) 100%);
  position: relative;
  padding: 4rem 3rem 2rem;
}

.footer-glow {
  position: absolute;
  top: 0; left: 15%; right: 15%;
  height: 1px;
  background: linear-gradient(
    90deg,
    transparent,
    rgba(4, 211, 97, 0.45),
    rgba(31, 123, 242, 0.35),
    transparent
  );
}

.footer-inner {
  max-width: 1100px;
  margin: 0 auto;
  display: flex;
  gap: 4rem;
  flex-wrap: wrap;
  margin-bottom: 3rem;
}

/* Brand */
.footer-brand {
  flex: 1;
  min-width: 240px;
  max-width: 320px;
}

.brand-logo {
  display: flex;
  align-items: center;
  gap: 0.6rem;
  margin-bottom: 1rem;
}
.brand-img {
  width: 36px; height: 36px;
  border-radius: 8px;
  object-fit: contain;
}
.brand-logo span {
  color: white;
  font-weight: 800;
  font-size: 1.2rem;
}

.brand-tagline {
  color: rgba(255,255,255,0.5);
  font-size: 0.88rem;
  line-height: 1.65;
  margin-bottom: 1.5rem;
}

.socials {
  display: flex;
  gap: 0.6rem;
}
.social-link {
  width: 36px; height: 36px;
  border-radius: 50%;
  background: rgba(255,255,255,0.07);
  border: 1px solid rgba(255,255,255,0.1);
  display: flex; align-items: center; justify-content: center;
  color: rgba(255,255,255,0.55);
  font-size: 0.85rem;
  text-decoration: none;
  transition: background 0.25s ease, color 0.25s ease, border-color 0.25s ease;
}
.social-link:hover {
  background: rgba(4, 211, 97, 0.15);
  border-color: rgba(4, 211, 97, 0.35);
  color: var(--green-300);
}

/* Links */
.footer-links {
  display: flex;
  gap: 3rem;
  flex-wrap: wrap;
  flex: 1;
  justify-content: flex-end;
}

.link-col strong {
  display: block;
  color: white;
  font-size: 0.85rem;
  font-weight: 700;
  letter-spacing: 0.06em;
  text-transform: uppercase;
  margin-bottom: 1rem;
}

.link-col ul {
  list-style: none;
  padding: 0; margin: 0;
  display: flex;
  flex-direction: column;
  gap: 0.6rem;
}
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
.footer-bar small, .footer-bar a {
  color: rgba(255,255,255,0.3);
  font-size: 0.8rem;
}
.footer-bar a:hover { color: rgba(255,255,255,0.65); text-decoration: none; }
</style>
