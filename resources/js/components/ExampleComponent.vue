<template>
    <div class="p-6 bg-white rounded-lg shadow-md">
        <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ greeting }}</h3>
        <p class="text-gray-600">This is a Vue.js component in your Laravel application!</p>
        <button @click="incrementCount" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
            Clicked {{ count }} times
        </button>
    </div>
</template>

<script>
export default {
    name: 'ExampleComponent',
    data() {
        return {
            greeting: 'Hello from Vue.js!',
            count: 0
        }
    },
    methods: {
        incrementCount() {
            this.count++;
        }
    }
}
</script>