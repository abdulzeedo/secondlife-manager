<template>
    <div>
    <button v-if="imiei && currentImiei" class="btn btn-primary"
            @click.prevent="open=true"
    >Add New Phone</button>
    <modal v-model="open" title="Add new phone from imiei" auto-focus>
        <div class="container">
        <form class="form" @submit.prevent="onSubmit">
            <div class="form-group">
                <label for="imiei" class="control-label">IMIEI</label>
                <p id="imiei" name="imiei" class="form-control-static">{{imiei}}</p>
            </div>
        </form>
        </div>
        <div slot="footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary"
                    data-action="auto-focus"
                    @click.prevent="onSubmit">Add New Phone</button>
        </div>
    </modal>
    </div>
</template>

<script>
    export default {
        name: "modal-new-phone",
        props: {
            id: String,
            imiei: String,
            currentImiei: String,
        },
        created: function() {
            eventHub.$on('add-new-phone-open-modal', this.openModal);
        },
        beforeDestroy: function() {
            eventHub.$off('add-new-phone-open-modal', this.openModal);
        },
        data: function() {
            return {
                open: false,
            }
        },
        methods: {
            onSubmit: function() {
                this.$emit('new-phone-submit');
                this.open = false;
            },
            openModal: function() {
                console.log('hey I am here');
                this.open = true;
            }
        }
    }
</script>

<style scoped>

</style>