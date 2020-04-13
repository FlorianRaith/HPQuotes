<template>
  <div class="rounds btns">
    <input type="range" min="1" max="30" class="slider" v-model="rounds">
    <p>{{ rounds }} Rounds</p>
  </div>
</template>

<style scoped>
.rounds p {
  margin-bottom: 0;
  margin-left: 1rem;
  white-space: nowrap;
  width: 4rem;
}

.slider {
  -webkit-appearance: none;
  width: 10rem;
  height: 25px;
  background: rgba(11, 3, 27, 0.5);
  border: solid 3px rgb(11, 3, 27);
  outline: none;
}

.slider::-webkit-slider-thumb {
  -webkit-appearance: none;
  appearance: none;
  width: 25px;
  height: 25px;
  background: rgb(255, 240, 18);
  cursor: pointer;
}

.slider::-moz-range-thumb {
  width: 25px;
  height: 25px;
  background: rgb(255, 240, 18);
  cursor: pointer;
}
</style>

<script>
export default {
  props: ['default'],
  data() {
    return {
      rounds: null,
    }
  },
  mounted() {
    this.rounds = this.default;
    this.$emit('input', this.rounds);
  },
  watch: {
    rounds(val) {
      this.$emit('input', val);
    }
  }
}
</script>
