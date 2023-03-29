<template>
    <a @click.prevent="show" :class="{ 'mx-auto': comment }" class="flex flex-col space-y-4 max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
      <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ post?.title ?? comment?.content }}</h5>
      <p class="text-end font-normal text-gray-700 dark:text-gray-400">{{ post?.created_at ?? comment?.created_at}}</p>
      <div class="self-end">
        <button @click.stop="destroy" class="py-2 px-4 bg-red-400 rounded-lg">Delete</button>
        <button @click.stop="edit" class="py-2 px-4 bg-yellow-400 rounded-lg">Edit</button>
      </div>
  </a>
  </template>
  
  <script>
import { mapActions } from 'pinia';
import { usePostStore } from '../store/store';
  export default {
      props: ["post", "comment"],
      methods: {
        ...mapActions(usePostStore, ['destroyPost', 'destroyComment']),
        show() {
          this.$router.push(`/${this.comment ? 'comment' : 'post'}/${this.post.id}`)
        },
        edit() {
          let id = this.comment?.id ?? this.post.id;
          this.$router.push(`/${this.comment?.id ? 'comment' : 'post'}/${id}/edit`);
        },
        destroy() {
          if(this.post?.id) this.destroyPost(this.post.id, (data) => {
            this.$swal(data)
          })
          else this.destroyComment(this.comment.id, (data) => {
            this.$swal(data)
          })
        }
      }
  }
  </script>
  
  <style>
  
  </style>