<template>

  <div>
    <img alt="Workflow" class="mx-auto h-12 w-auto"
         src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg"/>
    <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
      Register for free
    </h2>
    <p class="mt-2 text-center text-sm text-gray-600">
      Or
      {{ ' ' }}
      <router-link :to="{name:'Login'}" class="font-medium text-indigo-600 hover:text-indigo-500">
        Login to your account
      </router-link>
    </p>
  </div>
  <form class="mt-8 space-y-6" @submit="register">
    <Alert v-if="Object.keys(errors).length" class="flex-col items-stretch text-sm">
      <div v-for="(field,i) of Object.keys(errors)" :key="i">
        <div v-for="(error,ind) of errors[field] || []" :key="ind">* {{ error }}</div>
      </div>
      <span
        class="w-8 h-8 flex items-center justify-center rounded-full cursor-pointer transition-colors hover:bg-[rgba(0,0,0,0.2)]"
        @click="errors=''">
          <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
          </svg>
      </span>
    </Alert>
    <input name="remember" type="hidden" value="true"/>
    <div class="rounded-md shadow-sm -space-y-px">
      <div>
        <label class="sr-only" for="full_name">Name</label>
        <input id="full_name" v-model="user.name" autocomplete="name" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" name="name"
               placeholder="Full name"
               required="" type="text"/>
      </div>
      <div>
        <label class="sr-only" for="email-address">Email address</label>
        <input id="email-address" v-model="user.email" autocomplete="email" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900  focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" name="email"
               placeholder="Email address"
               required="" type="email"/>
      </div>
      <div>
        <label class="sr-only" for="password">Password</label>
        <input id="password" v-model="user.password" autocomplete="current-password" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900  focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" name="password"
               placeholder="Password"
               required="" type="password"/>
      </div>
      <div>
        <label class="sr-only" for="password_confirmation">Password confirmation</label>
        <input id="password_confirmation" v-model="user.password_confirmation" autocomplete="current-password_confirmation"
               class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" name="password_confirmation"
               placeholder="Password confirmation"
               required="" type="password"/>
      </div>
    </div>


    <div>
      <button :class="[{'cursor-not-allowed':loading,'hover:bg-indigo-500':loading}]" :disabled="loading" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
              type="submit">
            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
              <LockClosedIcon aria-hidden="true" class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400"/>
            </span>
        <svg v-if="loading" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24"
             xmlns="http://www.w3.org/2000/svg">
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
          <path class="opacity-75"
                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                fill="currentColor"></path>
        </svg>

        Sign up
      </button>
    </div>
  </form>

</template>

<script setup>
import {LockClosedIcon} from '@heroicons/vue/solid'
import store from '../store';
import {useRouter} from "vue-router";
import {ref} from "vue";
import Alert from '../components/Alert.vue'

const router = useRouter();
const user = {
  name: '',
  email: '',
  password: '',
  password_confirmation: ''
};

const errors = ref({});
const loading = ref(false)

function register(ev) {
  ev.preventDefault();
  loading.value=true;
  store
    .dispatch('register', user)
    .then((res) => {
      loading.value=false;
        router.push({
          name: 'Dashboard'
        })
      }
    ).catch(err => {
    loading.value=false;
    if (err.response.status === 422) {
      errors.value = err.response.data.errors;
    }
  })
}
</script>
