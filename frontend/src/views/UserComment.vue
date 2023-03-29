<template>
    <div class="flex flex-col space-y-6 px-40 mt-4">
      <h1 class="text-4xl font-semibold">My Comment</h1>
      <div class="grid grid-cols-3 gap-4">
          <div v-for="comment in userComment" :key="comment.id">
              <UserCard :comment="comment"/>
          </div>
      </div>
    </div>
  </template>
  
  <script>
  import { mapActions, mapState } from 'pinia'
  import { usePostStore } from '../store/store'
  import UserCard from '../components/UserComp.vue';
  export default {
      components: {UserCard},
      methods: {
          ...mapActions(usePostStore, ['fetchUserComments'])
      },
      created() {
          this.fetchUserComments();
      },
      computed: {
          ...mapState(usePostStore, ['userComment'])
      }
  }
  </script>
  
  <style>
  
  </style>