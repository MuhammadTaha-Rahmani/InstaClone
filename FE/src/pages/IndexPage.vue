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
        <post-card @like="toggleLike(post.id , index)" :post="post"/>
      </div>
    </div>
  </q-page>
</template>

<script>
import { defineComponent, reactive, toRefs } from "vue";
import { api } from "src/boot/axios";
import { useAppDataStore } from "src/stores/appData";
import { useRouter } from "vue-router";
import PostCard from "src/components/PostCard.vue";
export default defineComponent({
  components:{
    PostCard
  } , 
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
