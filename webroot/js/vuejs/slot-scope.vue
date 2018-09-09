<template>
    <tbody>
    <tr @click="expand = !expand" class="row-click">
        <slot name="row-to-expand" :items="items">
        </slot>
    </tr>
    <tr v-show="show">
        <td colspan="100%">
            <collapse class="sub-table" v-model="expand" @hidden="show = false" @show="show = true">
                <slot name="expandable"></slot>
            </collapse>
        </td>
    </tr>
    <slot></slot>
    </tbody>
</template>

<script>
    export default {
        name: "slot-scope",
        props: ['items'],
        data: function() {
            return {
                expand: false,
                show: false,
                hah: 'hahahah',
            }
        },

    }
</script>

<style scoped>

</style>