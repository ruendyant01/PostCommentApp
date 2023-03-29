<script>
import { mapWritableState } from 'pinia';
import Headers from './components/Headers.vue';
import {usePostStore} from './store/store';

export default {
  components: {Headers},
  computed: {
    ...mapWritableState(usePostStore, ['isLogged'])
  },
  created() {
    if(localStorage?.access_token)  this.isLogged = true;
  }
}
</script>

<template>
  <div class="w-full h-full">
    <Headers />
    <router-view></router-view>
  </div>
</template>