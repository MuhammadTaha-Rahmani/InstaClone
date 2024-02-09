<template>
  <q-page padding>
    <div class="row justify-center q-mt-xl">
      <div class="col-6 q-gutter-y-lg q-pa-lg shadow-10 glass">
        <q-input
          type="email"
          v-model="email"
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
        <q-btn class="full-width" color="pink-5" label="Login" @click="login" />
      </div>
    </div>
  </q-page>
</template>

<script>
import { reactive, toRefs } from "vue";
import { api } from "src/boot/axios";
import { useQuasar } from "quasar";
import { useRouter } from "vue-router";
export default {
  setup() {
    const $q = useQuasar();
    const router = useRouter();
    const props = reactive({
      email: null,
      password: null,
    });
    function login() {
      api
        .post("oauth/token", {
          username: props.email,
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
            router.push("/");
          }else{
            $q.notify({
              message: "Some Thing Went wrong",
              color: "negative",
              position: "top",
            });
          }
        })
        .catch((e) => {
          console.log(e);
        });
    }
    return {
      ...toRefs(props),
      login,
    };
  },
};
</script>
