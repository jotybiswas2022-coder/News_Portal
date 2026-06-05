<template>
  <div class="min-h-screen bg-[#0a0a0a] flex flex-col">
    <Navbar />
    <main class="flex-1">
      <router-view />
    </main>
    <Footer />
    <CookieBanner />
    <Toast />
  </div>
</template>

<script setup>
import Navbar from './components/Navbar.vue'
import Footer from './components/Footer.vue'
import CookieBanner from './components/CookieBanner.vue'
import Toast from './components/Toast.vue'
</script>
