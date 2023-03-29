<template>
  <a @click.prevent="show" :class="{ 'mx-auto': comment }" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
    <h2 v-show="comment">{{ comment?.users?.name }}</h2>
    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ post?.title ?? comment?.content }}</h5>
    <p class="font-normal text-gray-700 dark:text-gray-400">{{ post?.userName ?? comment?.created_at}}</p>
</a>
</template>

<script>
export default {
    props: ["post", "comment"],
    methods: {
      show() {
        this.$router.push(`/${this.comment ? 'comment' : 'post'}/${this.post.id}`) 
      }
    }
}
</script>

<style>

</style>