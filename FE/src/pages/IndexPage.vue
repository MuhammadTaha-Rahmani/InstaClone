<template>
  <q-page class="flex flex-center">
    <q-btn
      rounded
      push
      label="Register"
      color="pink-8"
      class="full-width"
      @click="$router.push('/register')"
    />
  </q-page>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
  name: "IndexPage",
});
</script>
