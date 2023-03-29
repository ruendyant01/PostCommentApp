<template>
  <div class="w-full h-full flex justify-center items-center">
    <form class="bg-white shadow-lg rounded py-14 px-16 w-1/3 mb-4" @submit.prevent="submit">
      <h1 class="text-2xl text-center mb-4">Create An Account</h1>
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="name"> Name </label>
        <input
          v-model="form.name"
          id="name"
          :class="{ 'border-red-500': errors?.name }"
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          type="text"
          @blur="validate('name')"
          placeholder="Name"
          required
        />
      </div>
      <p class="text-red-500" v-if="!!errors?.name">{{ errors.name }}</p>
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
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="password_confirmation">
          Confirm Password
        </label>
        <input
          v-model="form.password_confirmation"
          id="password_confirmation"
          :class="{ 'border-red-500': errors?.password_confirmation }"
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
          type="password"
          @blur="validate('password_confirmation')"
          placeholder="******************"
          required
        />
      </div>
      <p class="text-red-500" v-if="!!errors?.password_confirmation">{{ errors.password_confirmation }}</p>
      <div class="flex items-center justify-between">
        <button
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
          type="submit"
        >
          Create Account
        </button>
      </div>
    </form>
  </div>
</template>

<script>
import axios from 'axios'
import * as Yup from 'yup'

const RegisterSchema = Yup.object().shape({
    email: Yup.string().email().required(),
  name: Yup.string().required(),
  password: Yup.string().required(),
  password_confirmation: Yup.string().required()
})

export default {
  data() {
    return {
      form: {
        email: '',
        password: '',
        password_confirmation: '',
        name: ''
      },
      errors: {}
    }
  },
  methods: {
    submit() {
      axios
        .post('http://localhost:8000/api/register', this.form)
        .then(() => {
          this.form = {
            email: '',
            password: '',
            password_confirmation: '',
            name: ''
          }
          return this.$swal('Register Success')
        })
        .then(() => {
          this.$router.push('/login')
        })
        .catch((err) => {
          console.log(err)
        })
    },
    submitHandler() {
      RegisterSchema.validate(this.form, { abortEarly: false })
        .then(() => {
          this.submit()
        })
        .catch((err) => {
          err.inner.forEach((val) => {
            this.errors = { ...this.errors, [err.path]: err.message }
          })
        })
    },
    validate(field) {
      RegisterSchema.validateAt(field, this.form)
        .then(() => (this.errors[field] = ''))
        .catch((err) => {
          this.errors[err.path] = err.message
        })
    }
  }
}
</script>
