<template>
  <div class="w-full flex flex-col space-y-10">
    <div class="grid grid-cols-3 gap-3 p-6">
    <div v-for="post in allPosts.data" :key="post.id">
      <Card :post="post" />
    </div>
  </div>
  <div class="self-center flex space-x-4">
      <button @click="prev">Prev</button>
      <p>{{ this.allPosts.current_page }}</p>
      <button @click="next">Next</button>
    </div>
  </div>
</template>

<script>

import Card from '../components/CardComp.vue'
import { mapActions, mapState } from 'pinia';
import { usePostStore } from '../store/store';
export default {
  components: {Card},
  computed: {
    ...mapState(usePostStore, ['allPosts'])
  },
  methods: {
    ...mapActions(usePostStore, ["fetchAllPost"]),
    next() {
      if(!this.allPosts.next_page_url) return;
      this.fetchAllPost(this.allPosts.current_page + 1);
    },
    prev() {
      if(!this.allPosts.prev_page_url) return;
      this.fetchAllPost(this.allPosts.current_page - 1);
    }
  },
  created() {
    this.fetchAllPost();
  },
  mounted() {
    if(this.allPosts) this.fetchAllPost();
  }
}
</script>

<style>

</style>