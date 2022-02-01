<template>
  <fieldset class="mb-4">
    <div>
      <legend class="text-base font-medium text-gray-900">
        {{ index + 1 }}.{{ question.question }}
      </legend>
      <p class="text-sm text-gray-500">{{ question.description }}</p>
    </div>
    <div class="mt-3">
      <div v-if="question.type==='select'">
        <select
          :value="modelValue"
          class="
        mt-1
          py-2
          px-3
          bg-white
          focus:ring-indigo-500 focus:border-indigo-500
          block
          w-full
          shadow-sm
          sm:text-sm
          border-gray-300
          rounded-md"
          @change="emits('update:modelValue',$event.target.value)"
        >
          <option value="">Please Select</option>
          <option v-for="option in question.data.options" :key="option.uuid" :value="option.text">{{ option.text }}
          </option>
        </select>
      </div>
      <div v-else-if="question.type==='checkbox'">
        <div v-for="(option,ind) of question.data.options" :key="option.uuid" class="flex items-center">
          <input :id="option.uuid" v-model="model[option.text]" :name="'question' + question.id" :value="option.text"
                 class="focus:ring-indigo-500 text-indigo-600 h-4 w-4 text-gray-300 rounded"
                 type="checkbox"
                 @change="onCheckboxChange">
          <label :for="option.uuid" class="ml-3 block text-sm font-medium text-gray-700"> {{ option.text }}</label>
        </div>
      </div>
      <div v-else-if="question.type==='radio'">
        <div v-for="(option,ind) of question.data.options" :key="option.uuid" class="flex items-center">
          <input :id="option.uuid" :name="'question' + question.id" :value="option.text"
                 class="focus:ring-indigo-500 text-indigo-600 h-4 w-4 text-gray-300"
                 type="radio"
                 @change="emits('update:modelValue',$event.target.value)">
          <label :for="option.uuid" class="ml-3 block text-sm font-medium text-gray-700"> {{ option.text }}</label>
        </div>
      </div>
      <div v-else-if="question.type==='text'">
        <input :value="modelValue" class="
        mt-1
        py-2
        px-3
          bg-white
          focus:ring-indigo-500 focus:border-indigo-500
          block
          w-full
          shadow-sm
          sm:text-sm
          border-gray-300
          rounded-md"
               type="text"
               @change="emits('update:modelValue',$event.target.value)">
      </div>
      <div v-else-if="question.type==='textarea'">
        <textarea :value="modelValue"
                  class="
        mt-1
        py-2
        px-3
          bg-white
          focus:ring-indigo-500 focus:border-indigo-500
          block
          w-full
          shadow-sm
          sm:text-sm
          border-gray-300
          rounded-md"
                  @change="emits('update:modelValue',$event.target.value)"></textarea>
      </div>
    </div>
  </fieldset>
  <hr class="mb-4">
</template>

<script setup>
import {ref} from "vue";

const {question, index, modelValue} = defineProps({
  question: Object,
  index: Number,
  modelValue: [String, Array]
})

const emits = defineEmits(["update:modelValue"])

let model;
if (question.type === "checkbox") {
  model = ref({});
}

function onCheckboxChange($event) {
  const selectedOptions = [];
  for (let text in model.value) {
    if (model.value[text]) {
      selectedOptions.push(text)
    }
  }
  emits("update:modelValue",selectedOptions);
}
</script>
<style scoped>

</style>
