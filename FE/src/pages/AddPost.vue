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
        <q-btn @click="addPost" color="pink" icon="send" label="Add Post" class="full-width" />
      </div>
    </div>
  </q-page>
</template>

<script>
import { reactive, toRefs } from "vue";
import { api } from "src/boot/axios";
export default {
  // name: 'PageName',
  setup() {
    const props = reactive({
      tilte: null,
      description: null,
    });
    function AddPost() {
      api
        .post("/posts", {
          tilte: props.tilte,
          description: props.description,
        })
        .then((r) => {
          console.log(r.data);
        })
        .catch((e) => {
          console.log(e);
        });
    }

    return {
      ...toRefs(props),
      AddPost
    };
  },
};
</script>
