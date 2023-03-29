<template>
    <div class="w-full h-full flex justify-center items-center mt-16">
    <form class="bg-white space-y-6 shadow-lg rounded py-14 px-16 w-1/3 mb-4" @submit.prevent="add">
        <h1 class="text-4xl text-center">Edit Comment</h1>
        <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="content">
            Content
        </label>
        <input v-model="content" id="content" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="Content" required>
    </div>
        <div class="flex items-center justify-between">
        <button class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
            Edit
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
        }
    },
    created() {
        this.$watch(
            () => this.$route.params?.comment,
            () => {
                this.fetchData()
            },
            {immediate:true}
        )
    },
    methods: {
        ...mapActions(usePostStore, ['editUserComment', 'getSingleComment']),
        add() {
            this.editUserComment(this.$route.params.comment,{title:this.title,content:this.content}, (data) => {
                this.$swal(data)
                .then(({isConfirmed}) => {
                    if(isConfirmed) this.$router.push("/comment")
                })
            });
        },
        fetchData() {
            this.getSingleComment(this.$route.params.comment, (comment) => {
                this.content = comment.content
            })
        }
    }
}
</script>