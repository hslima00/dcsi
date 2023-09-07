<template>
    <p>Value: {{ value }}</p>
    <vue-number-input v-model="value" :min="1" :max="10" inline controls></vue-number-input>
</template>

<script>
export default {
    data() {
        return {
            value: 1,
        };
    },
};
</script>
