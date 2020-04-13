import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from './components/Home';
import GameView from './components/game/GameView';
import Game from './components/Game';
import GameSettings from './components/settings/GameSettings';

Vue.use(VueRouter);

export default new VueRouter({
  mode: 'history',
  routes: [
    { path: '/', component: Home },
    { path: '/game/:gameid', component: Game },
    { path: '/create', component: GameSettings }
  ]
});