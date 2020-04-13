import Vue from 'vue';
import Vuex from 'vuex';
import { authors } from './staticData';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    gameSettings: null,
    bookImagesLoaded: false,
    characterImagesLoaded: false
  },
  mutations: {
    setBookImagesLoaded(state) {
      state.bookImagesLoaded = true;
    },
    setCharacterImagesLoaded(state) {
      state.characterImagesLoaded = true;
    },
    setGameSettings(state, settings) {
      state.gameSettings = settings;
    }
  },
  actions: {
    loadBookImages({ commit }) {
      let loaded = 0;

      for(let i = 1; i <= 7; i++) {
        const image = new Image();
        image.onload = () => {
          loaded++;
          console.log('loaded book' + i);

          if(loaded === 7) {
            commit('setBookImagesLoaded');
          } 
        }
        image.src = '/images/book' + i + '.jpg';
      }
    },
    loadCharacterImages({ commit }) {
      let loaded = 0;

      for(let i = 1; i <= authors.length + 1; i++) {
        const image = new Image();
        image.onload = () => {
          loaded++;
          if(loaded === authors.length + 1) {
            commit('setCharacterImagesLoaded');
            console.log('loaded character' + i);
          }
        }
        image.src = '/images/character' + i + '.jpg';
      }
    }
  }
});