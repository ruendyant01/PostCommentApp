import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/Home.vue';
import Register from '../views/Register.vue';
import Login from '../views/Login.vue';
import CreatePost from '../views/CreatePost.vue';
import EditComment from '../views/EditComment.vue';
import UserComment from '../views/UserComment.vue';
import EditPost from '../views/EditPost.vue';
import Post from '../views/Post.vue';
import UserPost from '../views/UserPosts.vue';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
      meta: { requiresAuth: true }
    },
    {
      path:"/login",
      name: "login",
      component: Login
    },
    {
      path:"/register",
      name: "register",
      component: Register
    },
    {
      path:"/post",
      name: "post",
      component: UserPost,
      meta: { requiresAuth: true }
    },
    {
      path:"/comment",
      name: "comment",
      component: UserComment,
      meta: { requiresAuth: true }
    },
    {
      path:"/comment/:comment/edit",
      name: "commentEdit",
      component: EditComment,
      meta: { requiresAuth: true }
    },
    {
      path:"/post/create",
      name: "postCreate",
      component: CreatePost,
      meta: { requiresAuth: true }
    },
    {
      path:"/post/:post/edit",
      name: "postEdit",
      component: EditPost,
      meta: { requiresAuth: true }
    },
    {
      path: '/post/:post',
      name: 'show',
      component: Post,
      meta: { requiresAuth: true }
    },
  ]
})

router.beforeEach((to, from, next) => {
  if((to.name === "login" || to.name === "register") && localStorage.access_token) next("/")
  else if(to.meta.requiresAuth && !localStorage.access_token) next("/login");
  else next()
})

export default router
