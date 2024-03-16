<template>
  <q-page padding>
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
    <div class="row q-col-gutter-md">
      <div
        v-for="(post, index) in posts"
        :key="'posts - ' + index"
        class="col-12 col-md-6 col-lg-4"
      >
        <q-card>
          <q-item>
            <q-item-section avatar>
              <q-avatar>
                <img src="https://cdn.quasar.dev/img/boy-avatar.png" />
              </q-avatar>
            </q-item-section>

            <q-item-section>
              <q-item-label>{{ post.title }}</q-item-label>
              <q-item-label caption>
                {{ post.user.email }}
              </q-item-label>
            </q-item-section>
          </q-item>

          <q-separator />

          <q-card-section horizontal>
            <q-card-section>
              {{ post.description }}
            </q-card-section>
          </q-card-section>

          <q-separator />

          <q-card-actions class="row justify-between">
            <q-btn
              @click="toggleLike(post.id, index)"
              unelevated
              flat
              :label="post.likes.length"
            >
              <q-icon
                :name="post.liked ? 'favorite' : 'favorite_outline'"
                :color="post.liked ? 'negative' : 'white-outline'"
              />
            </q-btn>
            <q-btn
              @click="$router.push(`/posts/${post.id}`)"
              unelevated
              flat
              label="more"
              color="pink"
            />
          </q-card-actions>
        </q-card>
      </div>
    </div>
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
    const props = reactive({
      userData: null,
      posts: [],
    });
    function fetchMe() {
      api.get("api/user").then((r) => {
        props.userData = r.data;
        appData.userDetail = r.data;
      });
    }
    fetchMe();
    // if (!appData.userDetail) {
    //   router.push("/login");
    // }
    function fetchPosts() {
      api
        .get("api/posts")
        .then((r) => {
          console.log(r.data);
          props.posts = r.data;
        })
        .catch((e) => {
          console.log(e);
        });
    }
    fetchPosts();

    function toggleLike(postId, index) {
      api
        .post("api/like", {
          postId: postId,
        })
        .then((r) => {
          if (r.data.status) {
            props.posts[index].liked = r.data.likeStat;
            if (r.data.likeStat) {
              props.posts[index].likes.push(r.data.like);
            } else {
              let myLikeIndex;
              props.posts[index].likes.forEach((val, index) => {
                if (val.user_id == appData.userDetail.user_id) {
                  myLikeIndex = index;
                } else {
                  myLikeIndex = null;
                }
              });
              console.log(myLikeIndex);
              if (myLikeIndex !== null) {
                props.posts[index].likes.splice(myLikeIndex, 1);
              }
            }
          }
        })
        .catch((e) => {
          console.log(e);
        });
    }

    return {
      ...toRefs(props),
      appData,
      toggleLike,
    };
  },
});
</script>
