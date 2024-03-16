<template>
  <q-page padding>
    <!-- content -->
    <div class="row q-col-gutter-lg">
      <div class="col-12">
        <q-input v-model="title" label="Post Title" />
      </div>
      <div class="col-12">
        <q-input
          v-model="description"
          type="textarea"
          autogrow
          label="Post Description"
        />
      </div>
      <div class="col-12">
        <q-btn
          @click="AddPost"
          color="pink"
          icon="send"
          label="Add Post"
          class="full-width"
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
      title: null,
      description: null,
    });
    function AddPost() {
      api
        .post("api/posts", {
          title: props.title,
          description: props.description,
        })
        .then((r) => {
          if (r.data.status) {
            $q.notify({
              message: "succesfully added",
              color: "positive",
              position: "top",
            });
            router.push("/posts");
          } else {
            $q.notify({
              message: "try again",
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
      AddPost,
    };
  },
};
</script>
