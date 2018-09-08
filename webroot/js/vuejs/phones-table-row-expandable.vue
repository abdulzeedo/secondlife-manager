<template>
    <tbody>
        <tr>
            <slot name="row-to-expand" :expand="doExpand">
                default
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
        name: "phones-table-row-expandable",
        data: function() {
            return {
                expand: false,
                show: false,
                hah: 'hahahah',
            }
        },
        methods: {
            doExpand: function() {
                this.expand = !this.expand;
            }
        }

    }
</script>

<style scoped>

</style>