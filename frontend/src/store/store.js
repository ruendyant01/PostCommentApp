import {defineStore} from 'pinia';

const baseURL = "http://localhost:8000/api";
const token = localStorage.access_token;
const headers = {Authorization: token};
import axios from 'axios';

export const usePostStore = defineStore('post', {
    state: () => ({ 
        isLogged: false,
        userPost:[],
        post:[],
        comment:[],
        userComment:[],
        allPosts:[]
    }),
    getters: {
      
    },
    actions: {
      fetchAllPost(page) {
        axios.get(baseURL+`/post?page=${page ?? 1}`, {
          headers: {
            Authorization: localStorage.access_token
          }
        })
        .then(({data}) => {
          this.allPosts = data;
        })
        .catch(err => console.log(err));
      },
      fetchUserPosts() {
        axios.get(baseURL+"/user/post", {
          headers: {
            Authorization: token
          }
        })
        .then(res => {
          this.userPost = res.data;
        })
        .catch(err => console.log(err))
      },
      createPost(data,cb) {
        axios.post(baseURL+"/post", data, {
          headers
        })
        .then(({data}) => {
          cb(data)
        })
        .catch(err => console.log(err));
      },
      editPost(id,datas, cb) {
        axios.put(baseURL+`/post/${id}`, datas, {headers})
        .then(({data}) => {
          cb(data)
        })
        .catch(err => console.log(err))
      },
      getSinglePost(posts, cb=null) {
        axios.get(baseURL+`/post/${posts}`, {
            headers
        })
        .then(({data}) => {
            this.post = data;
            if(cb) cb(data)
        })
        .catch(err => console.log(err));
      },
      destroyPost(id,cb=null) {
        axios.delete(baseURL+`/post/${id}`, {headers})
        .then(({data}) => {
          this.userPost = this.userPost.filter(val => val.id !== +id);
          cb(data)
        })
        .catch(err => console.log(err));
      },
      fetchUserComments() {
        axios.get(baseURL+"/comment", {headers})
        .then(({data}) => {
          this.userComment = data;
        })
        .catch(err => console.log(err))
      },
      createUserComment(data) {
        axios.post(baseURL+"/comment", data, {headers})
        .then(({data}) => {
          this.post.comments.push(data.comment)
        })
        .catch(err => console.log(err));
      },
      editUserComment(id, data, cb)  {
        axios.put(baseURL+`/comment/${id}`, data, {headers})
        .then(({datas}) => {
          cb(datas)
        })
        .catch(err => console.log(err))
      },
      getSingleComment(id, cb) {
        axios.get(baseURL+`/comment/${id}`, {headers})
        .then(({data}) => {
          this.comment = data;
          cb(data)
        })
        .catch(err => console.log(err));
      },
      destroyComment(id,cb) {
        axios.delete(baseURL+`/comment/${id}`, {headers})
        .then(({data}) => {
          this.userComment = this.userComment.filter(val => val.id !== +id);
          cb(data)
        })
        .catch(err => console.log(err))
      }
    },
  })