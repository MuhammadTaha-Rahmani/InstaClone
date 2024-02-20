<template>
  <q-page class="flex flex-center">
    <!-- <div v-if="userData">
      {{appData.userDetail.name}}
    </div>
    {{appData.email}}
    <q-btn
      rounded
      push
      label="Register"
      color="pink-8"
      class="full-width"
      @click="$router.push('/register')"
    /> -->
  </q-page>
</template>

<script>
import { defineComponent, reactive, toRefs } from "vue";
import { api } from "src/boot/axios";
import { useAppDataStore } from "src/stores/appData";
import { useRouter } from "vue-router";
export default defineComponent({
  name: "IndexPage",
  setup() {
    const appData = useAppDataStore();
    const router = useRouter();
    // if (!appData.email) {
    //   router.push("/login");
    // }
    const props = reactive({
      userData: null,
    });
    function fetchMe() {
      api.get("api/user").then((r) => {
        props.userData = r.data;
        appData.userDetail = r.data;
      });
    }
    fetchMe();
    return {
      ...toRefs(props),
      appData,
    };
  },
});
</script>
