<template>
    <section>
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add phone return</h4>
            </div>
            <div class="modal-body">
                <form v-if="fillDataAjax" @submit.prevent="submitReturn">
                    <div style="display:none;"><input type="hidden" name="_method" class="form-control" value="POST"></div>
                    <fieldset>
                        <div class="form-group select required">
                            <label class="control-label" for="reason">Reason</label>
                            <div class="btn-group bootstrap-select form-control">
                                <b-select  v-model="reasonSelected"
                                          :options="fillDataAjax.values.reason"
                                          name="reason"
                                          class="form-control selectpicker"
                                          data-live-search="true" data-show-subtext="true"
                                          id="reason"></b-select>
                            </div>
                        </div>
                        <div class="form-group select required">
                            <label class="control-label" for="reason">Status</label>
                            <div class="btn-group bootstrap-select form-control">
                                <b-select  v-model="statusSelected"
                                           :options="fillDataAjax.values.status"
                                           name="status"
                                           class="form-control selectpicker"
                                           data-live-search="true" data-show-subtext="true"
                                           id="status"></b-select>
                            </div>
                        </div>
                        <div :class="[{'has-error': ajaxError.returnErrors.refund}, 'form-group text']">
                            <label class="control-label" for="refund">Refund</label>
                            <input type="text" name="refund" v-model="refund"
                                   class="form-control" maxlength="255" id="refund">
                            <span v-show="ajaxError.returnErrors.refund" id="helpBlock" class="help-block"
                                    v-for="property in ajaxError.returnErrors.refund">
                                {{ property }}
                            </span>
                        </div>
                        <div class="form-group textarea">
                            <label class="control-label" for="comments">Comments</label>
                            <textarea name="comments" class="form-control" v-model="comments"
                                      id="comments" rows="5"></textarea></div>
                    </fieldset>
                    <div class="form-group select">
                        <label class="control-label" for="item-id">Item</label>
                        <b-select :options="fillDataAjax.phonesFormatted"
                                  name="item_id"
                                  class="form-control selectpicker"
                                  data-live-search="true" data-show-subtext="true"
                                  id="item-id" disabled="disabled"></b-select>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default" type="submit">Submit</button>
                        <button @click.prevent="$router.push({name: 'modal-content-phone'})" class="btn btn-default" type="submit">Close</button>
                    </div>
                </form>
                <div v-else>
                    Loading the content for you...
                </div>
            </div>
        </div>
    </section>
</template>

<script>

    import bSelect from '../bootstrap/b-select.vue';

    Vue.component('b-select', bSelect);
    export default {
        name: "modal-content-phone-return",
        props: ['id'],
        data: function() {
            return {
                reasonSelected: '',
                statusSelected: '',
                comments: '',
                refund: null,
                fillDataAjax: null,
                ajaxError: {
                    returnErrors: '',
                },
            }
        },
        created: function() {
            this.getReturnData();
        },
        mounted: function () {

            this.$nextTick(function () {

            })
        },
        methods: {
            getReturnDataAJAX: function () {
                var vm = this;
                return axios.get('/phoneRecords/add-return-modal/' + this.id, {responseType: 'json'})
                        .then((resolve) => {
                            vm.fillDataAjax = resolve.data;
                        })
                        .catch((error) => {
                            console.log('Could not load get item return data for the form.' + error);
                        });

            },
            getReturnData: function() {
                this.getReturnDataAJAX()
                    .then(() => {
                        $('select').selectpicker('refresh');
                    });
            },
            submitReturn: function(e) {
                var vm = this;
                this.postSaveReturn($(e.target).serialize())
                    .then((resolve) => {
                        this.savedSuccessfully();
                        this.$router.push({name: 'modal-content-phone'});
                        return resolve;
                    })
                    .catch((error) => {
                        console.log(error);
                        vm.ajaxError = error.response.data;
                        if (error.response.status === 400) {
                            vm.validationError();
                            console.log("A validation error occurred " + error);
                        }
                        else
                            console.log('An unknown error just occurred ' + error);
                        return false;
                    })
            },
            postSaveReturn: function(input) {
                var vm = this;
                return axios.post('/phoneRecords/add-return-modal/' + this.id, input, {responseType: 'json'})
            },
            validationError: function () {
                this.$notify({
                    title: 'You have a validation error.',
                    content: 'Please correct the field in read and submit again.',
                    type: 'danger',
                })
            },
            savedSuccessfully: function () {
                this.$notify({
                    title: 'A new return has been added',
                    content: 'Hurrah! A new return has been created.',
                    type: 'success',
                })
            }
        },
    }
</script>

<style scoped>

</style>