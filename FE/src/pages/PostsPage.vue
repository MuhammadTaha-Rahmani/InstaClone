<template>
  <q-page padding>
    <!-- content -->
    <div class="row q-gutter-y-xl" v-if="posts.length > 0">
      <q-btn
        icon="add"
        @click="$router.push('/addPost')"
        label="Add Your New Post"
        color="pink"
        class="full-width"
        rounded
      />
      <div v-for="(post,index) in posts" :key="'my-post '+index" class="col-12 col-md-6 col-lg-4">
        <q-card>
          <q-item>
        <q-item-section avatar>
          <q-avatar>
            <img src="https://cdn.quasar.dev/img/boy-avatar.png">
          </q-avatar>
        </q-item-section>

        <q-item-section>
          <q-item-label>{{post.title}}</q-item-label>
          <q-item-label caption>
            Subhead
          </q-item-label>
        </q-item-section>
      </q-item>

      <q-separator />

      <q-card-section horizontal>
        <q-card-section>
          {{ post.description }}
        </q-card-section>
      </q-card-section>

        </q-card>
      </div>
    </div>
    <div v-else>
      <q-btn
        icon="add"
        @click="$router.push('/addPost')"
        label="Post your First Post"
        color="pink"
        class="full-width"
        rounded
      />
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
      posts: [],
    });
    function fetchMyPosts() {
      api
        .get("api/my-posts")
        .then((r) => {
          props.posts = r.data.MyPosts;
        })
        .catch((e) => {
          console.log(e);
        });
    }
    fetchMyPosts();
    return {
      ...toRefs(props),
    };
  },
};
</script>
