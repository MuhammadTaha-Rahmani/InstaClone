<template>
  <q-page class="flex flex-center">
    <div v-if="userData">
      {{ userData.email }}
    </div>
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
import { defineComponent, reactive, toRefs } from "vue";
import { api } from "src/boot/axios";
export default defineComponent({
  name: "IndexPage",
  setup() {
    const props = reactive({
      userData: null,
    });
    function fetchMe() {
      api.get("api/user").then((r) => {
        props.userData = r.data;
      });
    }
    fetchMe();
    return {
      ...toRefs(props),
    };
  },
});
</script>
