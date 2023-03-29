<template>
    <div class="w-full h-full flex justify-center items-center mt-16">
    <form class="bg-white space-y-6 shadow-lg rounded py-14 px-16 w-1/3 mb-4" @submit.prevent="add">
        <h1 class="text-4xl text-center">Create Post</h1>
        <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
            Title
        </label>
        <input v-model="title" id="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="Title" required>
        </div>
        <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="content">
            Content
        </label>
        <input v-model="content" id="content" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" type="text" required placeholder="Content">
    </div>
        <div class="flex items-center justify-between">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
            Add
        </button>
        </div>
    </form>
    </div>
</template>

<script>
import { mapActions } from 'pinia'
import { usePostStore } from '../store/store'
export default {
    data() {
        return {
            content:"",
            title:"",
            
        }
    },
    methods: {
        ...mapActions(usePostStore, ['createPost']),
        add() {
            this.createPost({title:this.title,content:this.content}, (data) => {
                this.$swal(data)
                .then(({isConfirmed}) => {
                    if(isConfirmed) this.$router.push("/post")
                })
            });
        }
    }
}
</script>