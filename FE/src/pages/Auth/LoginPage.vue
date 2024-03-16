<template>
  <q-page padding>
    <div class="row justify-center q-mt-xl">
      <div class="col-11 q-gutter-y-lg q-pa-lg shadow-10 glass">
        <q-input
          type="email"
          v-model="appData.email"
          standout="bg-pink-8 text-white"
          label="email"
        >
          <template v-slot:prepend>
            <q-icon name="email" />
          </template>
        </q-input>
        <q-input
          type="password"
          v-model="password"
          standout="bg-pink-8 text-white"
          label="password"
        >
          <template v-slot:prepend>
            <q-icon name="password" />
          </template>
        </q-input>
        <div class="row align-center justify-between">
          <div>
            <q-checkbox
              class="text-grey-9"
              v-model="right"
              label="Remember Me"
            />
          </div>
          <div class="self-center">
            <a class="text-primary" href="#">Forgot your password?</a>
          </div>
        </div>
        <q-btn class="full-width" color="pink-5" label="Login" @click="login" />
      </div>
    </div>
  </q-page>
</template>

<script>
import { reactive, ref, toRefs } from "vue";
import { api } from "src/boot/axios";
import { useQuasar } from "quasar";
import { useRouter } from "vue-router";
import { useAppDataStore } from "src/stores/appData";
export default {
  setup() {
    const appData = useAppDataStore();
    const $q = useQuasar();
    const $router = useRouter();
    const props = reactive({
      email: null,
      password: null,
    });
    function login() {
      api
        .post("oauth/token", {
          username: appData.email,
          password: props.password,
          grant_type: "password",
          client_id: 2,
          client_secret: "Ypsu7vrhPXnIvrk63I07QD50lWvekLNmLGr0xA8I",
        })
        .then((r) => {
          if (r.data.access_token) {
            $q.notify({
              message: "welcome",
              color: "positive",
              position: "top",
            });
            $q.cookies.set("access_token", r.data.access_token);
            $q.cookies.set("refresh_token", r.data.refresh_token);
            $q.cookies.set("expires_in", r.data.expires_in);
            api.defaults.headers.common = {
              Authorization: "Bearer " + r.data.access_token,
              "Content-Type": "application/json",
              Accept: "application/json;charset=UTF-8",
            };
            $router.push("/");
          } else {
            $q.notify({
              message: "Some Thing Went wrong",
              color: "negative",
              position: "top",
            });
          }
        })
        .catch((e) => {
          // $q.notify({
          //   message: e.response.data.message,
          //   color: "negative",
          //   position: "top",
          // });
          console.log(e);
        });
    }
    return {
      ...toRefs(props),
      login,
      appData,
      right: ref(false),
    };
  },
};
</script>
