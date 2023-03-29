<template>
  <div class="flex flex-col space-y-6 px-40 mt-4">
    <h1 class="text-4xl font-semibold">My Post</h1>
    <a href="/post/create" class="self-end bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
        + Add Post 
    </a>
    <div class="grid grid-cols-3 gap-4">
        <div v-for="post in userPost" :key="post.id">
            <UserCard :post="post"/>
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
        ...mapActions(usePostStore, ['fetchUserPosts'])
    },
    created() {
        this.fetchUserPosts();
    },
    computed: {
        ...mapState(usePostStore, ['userPost'])
    }
}
</script>

<style>

</style>