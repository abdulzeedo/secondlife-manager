<template>
    <select v-bind:value="value" v-on:change="$emit('input', $event.target.value)">
        <option
                v-for="option in options"
                :value="option.value"
                :data-subtext="option['data-subtext']"
        >
            {{ option.text }}
        </option>
    </select>
</template>

<script>
    export default {
        name: "b-select",
        props: ['options', 'value'],
    }
</script>

<style scoped>

</style>