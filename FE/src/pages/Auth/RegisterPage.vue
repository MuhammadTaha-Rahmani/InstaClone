<template>
  <q-page padding>
    <div class="row justify-center q-mt-xl">
      <div class="col-6 q-gutter-y-lg q-pa-lg shadow-10 glass">
        <q-input
          type="text"
          standout="bg-pink-8 text-white"
          label="name"
          v-model="name"
        >
          <template v-slot:prepend>
            <q-icon name="person" />
          </template>
        </q-input>
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
        <q-btn
          class="full-width"
          color="pink-5"
          label="Register"
          @click="register"
        />
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
  // name: 'PageName',
  setup() {
    const $q = useQuasar();
    const router = useRouter();
    const props = reactive({
      name: null,
      email: null,
      password: null,
    });
    function register() {
      api
        .post("api/register", {
          name: props.name,
          email: props.email,
          password: props.password,
        })
        .then((r) => {
          if (r.data.status) {
            $q.notify({
              message: "Successfully Registered",
              color: "positive",
            });
            router.push("/login");
          } else {
            $q.notify({
              message: "Try again",
              color: "negative",
            });
          }
        })
        .catch((e) => {
          console.log(e);
        });
    }
    return {
      ...toRefs(props),
      register,
    };
  },
};
</script>
<style>
.glass {
  /* From https://css.glass */
  background: #ffffff47;
  border-radius: 16px;
  /* box-shadow: 0 10px 60px rgba(0, 0, 0, 0.1); */
  backdrop-filter: blur(7px);
  -webkit-backdrop-filter: blur(7px);
  border: 1px solid rgba(248, 247, 247, 0.3);
}
</style>
