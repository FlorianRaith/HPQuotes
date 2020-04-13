<template>
  <div class="app centered-container">
    <div id="particles"></div>
    <div class="main centered-container">
      <Navbar/>
      <router-view></router-view>
      <!-- <Footer/> -->
    </div>
  </div>
</template>

<style scoped>
.main {
  font-family: 'Noto Serif JP', serif;
  width: 100%;
  max-width: 1000px;
  min-height: 100vh;
  color: rgb(11, 3, 27);
  background: #fff;
  background-image: url("/images/paper.png");
  z-index: 10;
}

.app {
  background: rgb(16, 5, 36);
  background-image: url('/images/forest.jpg');
  background-position: center;
  background-size: contain;
  box-shadow: inset 0 0 0 100vmax rgba(16, 5, 36, 0.5);
}

#particles {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  overflow: hidden;
  z-index: 1;
}
</style>

<style>
h1 {
  margin-top: 3.5rem;
  font-size: 2.5rem;
  text-align: center;
}

.centered-container {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.btns {
  justify-content: center;
  display: flex;
  flex-wrap: wrap;
}

.btn.btn-link, .btn.btn-link:focus, .btn.btn-link:active {
  color: rgb(255, 243, 80);
}

.btn.btn-link:hover {
  color: rgb(255, 243, 80);
  text-decoration: underline;
}

a:focus, .btn:focus {
  outline: none;
  box-shadow: none;
}

.btn-main {
  font-size: 1.3rem;
  color: rgb(255, 240, 18) !important;
  padding: .4rem 1.5rem;
  margin: 0 .5rem;
  margin-bottom: 1rem;
  background: rgb(11, 3, 27);
  transition: background .2s, box-shadow .2s, transform .5s;
  box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
}

.btn-main:hover {
  background: hsl(260, 70%, 13%);
  box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
}

.btn-main:active {
  transform: scale(.94);
}

.btn-main:hover, .btn-main:active, .btn-main:focus {
  text-decoration: none;
}
</style>

<script>
import Navbar from './Navbar';
import Footer from './Footer';
import Home from './Home';
import { authors } from '../staticData';

export default {
  mounted() {
    particlesJS.load('particles', '/assets/particlesjs-config.json');
  },
  components: {
    Navbar,
    Footer,
    Home
  }
}
</script>
