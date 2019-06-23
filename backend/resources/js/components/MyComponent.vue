<template>
  <div class="my-component">{{ message }}</div>
</template>

<script>
export default {
  data() {
    return {
      message: "This is my first component using binding data"
    };
  }
};
</script>

<style lang="scss" scoped>
.my-component {
  color: red;
}
</style>
