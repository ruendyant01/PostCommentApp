<template>
  <div class="w-full h-full flex justify-center items-center mt-12">
    <form
      class="bg-white space-y-6 shadow-lg rounded py-14 px-16 w-1/3 mb-4"
      @submit.prevent="submitHandler"
    >
      <h1 class="text-4xl text-center">Login</h1>
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="email"> Email </label>
        <input
          v-model="form.email"
          id="email"
          :class="{ 'border-red-500': errors?.email }"
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          type="email"
          @blur="validate('email')"
          placeholder="Email"
          required
        />
      </div>
      <p class="text-red-500" v-if="!!errors?.email">{{ errors.email }}</p>
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="password"> Password </label>
        <input
          v-model="form.password"
          id="password"
          :class="{ 'border-red-500': errors?.password }"
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
          type="password"
          @blur="validate('password')"
          placeholder="******************"
          required
        />
      </div>
      <p class="text-red-500" v-if="!!errors?.password">{{ errors.password }}</p>
      <div class="flex items-center justify-between">
        <button
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
          type="submit"
        >
          Sign In
        </button>
      </div>
    </form>
  </div>
</template>

<script>
import axios from 'axios'
import { mapWritableState } from 'pinia'
import { usePostStore } from '../store/store'
import * as Yup from 'yup'

const LoginSchema = Yup.object().shape({
  email: Yup.string().email().required(),
  password: Yup.string().required()
})

export default {
  data() {
    return {
      form: {
        email: '',
        password: ''
      },
      errors: {}
    }
  },
  computed: {
    ...mapWritableState(usePostStore, ['isLogged'])
  },
  methods: {
    submit() {
      axios
        .post('http://localhost:8000/api/login', this.form)
        .then((res) => {
          this.form = {
            email: '',
            password: ''
          }
          localStorage.access_token = 'Bearer ' + res.data
          this.isLogged = true
          return this.$swal('Login Success')
        })
        .then(() => {
          this.$router.push('/')
        })
        .catch((err) => {
          this.errors = err.response.data.errors
        })
    },
    submitHandler() {
        LoginSchema.validate(this.form, {abortEarly:false})
        .then(() => {
            this.submit();
        })
        .catch(err => {
            err.inner.forEach(val => {
                this.errors = {...this.errors, [err.path]:err.message}
            });
        })
    },
    validate(field) {
      LoginSchema.validateAt(field, this.form)
        .then(() => (this.errors[field] = ''))
        .catch((err) => {
          this.errors[err.path] = err.message
        })
    }
  }
}
</script>
