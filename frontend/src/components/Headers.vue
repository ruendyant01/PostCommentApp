<template>
  <div class="w-full flex justify-between p-4 bg-slate-100">
    <a href="/"><h1>Post App</h1></a>
    <div v-if="!isLogged" class="flex justify-between space-x-4 items-center">
        <a href="/login">Login</a>
        <a href="/register">Register</a>
    </div>
    <div v-else class="flex justify-between space-x-4 items-center">
      <a href="/comment">My Comments</a>
      <a href="/post">My Posts</a>
      <button @click="logOut">Log Out</button>
    </div>
  </div>
</template>

<script>
  import axios from 'axios';
import { mapWritableState } from 'pinia';
import { usePostStore } from '../store/store';
export default {
  computed: {
    ...mapWritableState(usePostStore, ['isLogged'])
  },
  methods: {
    logOut() {
      axios.post("http://localhost:8000/api/logout", {}, {
        headers: {
          Authorization: localStorage.access_token
        }
      })
      .then(() => {
        localStorage.clear();
        this.isLogged = false;
        return this.$swal("Log Out Success");
      })
      .then(() => {
        this.$router.push("/login");
      })
      .catch(err => console.log(err));
    }
  }
}
</script>