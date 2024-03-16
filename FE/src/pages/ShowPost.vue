<template>
  <q-page padding>
    <!-- content -->
    <div><h1>{{id}}</h1></div>
  </q-page>
</template>

<script>
import { onUpdated, reactive, toRefs } from 'vue'
import { useRoute } from 'vue-router'
export default {
  // name: 'PageName',
  setup(){
    const route = useRoute();
    const props = reactive({
      id:null,
      post:null
    })
    function fechThisPost(){
      props.id = route.params.id
    }
    fechThisPost()
  return{
    ...toRefs(props)
  }
  },
}
</script>
