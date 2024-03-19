<template>
  <div>
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
          @click="$emit('like')"
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
</template>

<script>
export default {
  props:['post'],
  // name: 'ComponentName',
  setup(props) {
    return {props};
  },
};
</script>
