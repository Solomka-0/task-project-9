<!-- resources/js/components/ExampleComponent.vue -->
<template>
    <div>
        <h1>{{ message }}</h1>
    </div>
</template>

<script>
export default {
    name: 'ExampleComponent',
    data() {
        return {
            message: 'Привет из Vue 3 с Options API!',
        };
    },
};
</script>

<style scoped>
/* Стили компонента */
</style>
