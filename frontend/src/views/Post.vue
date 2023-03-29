<template>
  <div class="flex flex-col space-y-10 py-3 px-10">
    <div class="flex justify-between px-10">
      <div class="rounded-lg p-6 flex flex-col space-y-6 border">
        <h2 class="text-4xl">{{ post.title }}</h2>
        <p>{{ post.content }}</p>
        <h6 class="self-end text-lg font-semibold">{{ post.userName }}</h6>
      </div>
      <div class="flex flex-col space-y-8">
        <h1 class="text-xl">Comment</h1>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Content</label>
          <textarea
          v-model="content"
            id="content"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            placeholder="Content"
          ></textarea>
        </div>
        <button @click="send" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
            Send
        </button>
      </div>
    </div>
    <div v-for="comment in post.comments" :key="comment.id" class="flex flex-col space-y-4">
      <Card :comment="comment" />
    </div>
  </div>
</template>

<script>
import Card from '../components/CardComp.vue'
import { mapActions, mapState } from 'pinia'
import { usePostStore } from '../store/store'

export default {
  components: { Card },
  data() {
    return {
      content: ""
    }
  },
  methods: {
    ...mapActions(usePostStore, ['getSinglePost', 'createUserComment']),
    send() {
      this.createUserComment({"post_id": this.post.id, content:this.content})
      this.content = "";
    }
  },
  computed: {
    ...mapState(usePostStore, ['post'])
  },
  created() {
    const { post } = this.$route.params
    this.getSinglePost(post)
  }
}
</script>
