<template>
  <PageComponent title="Dashboard">
    <div v-if="loading" class="flex justify-center">Loading...</div>
    <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 text-gray-700">
      <div class="bg-white shadow-md p-3 text-center flex flex-col order-1 lg:order-2 animate-fade-in-down"
           style="animation-delay: 0.1s">
        <h3 class="text-2xl font-semibold">Total Surveys</h3>
        <div class="text-8xl font-semibold flex-1 flex items-center justify-center">
          {{ data.totalSurveys }}
        </div>
      </div>
      <div class="bg-white shadow-md p-3 text-center flex flex-col order-2 lg:order-4 animate-fade-in-down"
           style="animation-delay: 0.2s">
        <h3 class="text-2xl font-semibold">Total Answers</h3>
        <div class="text-8xl font-semibold flex-1 flex items-center justify-center">
          {{ data.totalAnswers }}
        </div>
      </div>
      <div class="row-span-2 order-3 bg-white shadow-md p-4 lg:order-1 animate-fade-in-down">
        <h3 class="text-2xl font-semibold">Latest Survey</h3>
        <img :alt="data.latestSurvey.title" :src="data.latestSurvey.image_url" class="w-[240px] mx-auto">
        <h3 class="font-bold text-xl mb-3">
          {{ data.latestSurvey.title }}
        </h3>
        <div class="flex justify-between text-sm mb-1">
          <div>Create Date:</div>
          <div>{{ data.latestSurvey.created_at }}</div>
        </div>
        <div class="flex justify-between text-sm mb-1">
          <div>Expire Date:</div>
          <div>{{ data.latestSurvey.expired_at }}</div>
        </div>
        <div class="flex justify-between text-sm mb-1">
          <div>Status:</div>
          <div>{{ data.latestSurvey.status ? 'Active':'Draft' }}</div>
        </div>
        <div class="flex justify-between text-sm mb-3">
          <div>Questions:</div>
          <div> {{ data.latestSurvey.questions }}</div>
        </div> <div class="flex justify-between text-sm mb-3">
          <div>Answers:</div>
          <div> {{ data.latestSurvey.answers }}</div>
        </div>
        <div class="flex justify-between">
          <router-link :to="{name:'SurveyView',params:{id:data.latestSurvey.id}}" class="flex py-2 px-4 border border-transparent text-sm rounded-md text-indigo-500
                   hover:bg-indigo-700 hover:text-white transition-colors focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
              <path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"
                    stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2"/>
            </svg>
            Edit Survey
          </router-link>
          <button class="flex py-2 px-4 border border-transparent text-sm rounded-md hover:text-white text-indigo-500
                   hover:bg-indigo-700 focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
              <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2"/>
              <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2"/>
            </svg>
            View Survey
          </button>
        </div>
      </div>
      <div class="row-span-2 order-4 bg-white shadow-md p-3 lg:order-3 animate-fade-in-down"
           style="animation-delay: 0.3s">
        <div class="flex justify-between items-center mb-3 px-2">
          <h3 class="text-2xl font-semibold">Latest Answer</h3>
          <a href="javascript:void(0)" class="text-sm text-blue-500 hover:decoration-blue-500"> View all</a>
        </div>
        <a href="#"  v-for="answer of data.latestAnswers" :key="answer.id" class="block p-2 hover:hover:bg-gray-100/90">
          <div class="font-semiblod">{{answer.survey.title}}</div>
          <small>Answer Made at:
            <i class="font-semibold">{{answer.end_date}}</i>
          </small>
        </a>
      </div>
    </div>
  </PageComponent>
</template>

<script setup>
import PageComponent from '../components/PageComponent.vue';
import {useRoute} from "vue-router";
import {computed} from "vue";
import {useStore} from "vuex";

const route = useRoute();
const store = useStore();

const loading = computed(() => store.state.dashboard.loading);
const data = computed(() => store.state.dashboard.data);
//const answer;
store.dispatch('getDashboardData');

</script>


