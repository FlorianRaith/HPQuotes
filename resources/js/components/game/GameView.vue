<template>
  <component :is="component" @play="startGame" @settings="configureGame" v-model="settings" :settings="settings"></component>
</template>

<script>
import Game from './Game';
import GameSettings from './settings/GameSettings';

export default {
  data() {
    return {
      component: GameSettings,
      settings: null,
    }
  },
  methods: {
    startGame() {
      this.component = Game;
    },
    configureGame() {
      this.component = GameSettings;
    }
  }
}
</script>
