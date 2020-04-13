<template>
  <div class="btns">
    <button class="animate-out btn-diff btn-easy" :class="{selected: difficulty=='easy'}" @click="selectDifficulty('easy')">Easy</button>
    <button class="animate-out btn-diff btn-medium" :class="{selected: difficulty=='medium'}" @click="selectDifficulty('medium')">Medium</button>
    <button class="animate-out btn-diff btn-hard" :class="{selected: difficulty=='hard'}" @click="selectDifficulty('hard')">Hard</button>
  </div>
</template>

<style scoped>
.btn-diff {
  font-size: .9rem;
  color: rgb(255, 240, 18) !important;
  padding: .2rem .8rem;
  margin: 0 .5rem;
  margin-bottom: 1rem;
  background: rgb(11, 3, 27);
  transition: background .2s, box-shadow .2s, transform .5s;
  box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
  border: none;
}

.btn-diff:hover {
  background: hsl(260, 70%, 13%);
  box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
}

.btn-diff:active {
  transform: scale(.94)
}

.btn-diff:focus {
  outline: none;
}

.btn-easy.selected {
  background-color: green;
}

.btn-medium.selected {
  background-color: yellow;
  color: rgb(11, 3, 27) !important;
}

.btn-hard.selected {
  background-color: red;
}
</style>

<script>
export default {
  props: ['default'],
  data() {
    return {
      difficulty: null
    }
  },
  mounted() {
    this.difficulty = this.default;
    this.$emit('input', this.difficulty);
  },
  methods: {
    selectDifficulty(difficulty) {
      this.difficulty = difficulty;
      this.$emit('input', difficulty);
    }
  }
}
</script>