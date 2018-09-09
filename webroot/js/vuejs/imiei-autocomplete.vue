<template>
    <div>
        <input type="text" placeholder="Insert your IMIEI"
               v-model="imieiToQuery" class="form-control" maxlength="15">
        <div class="panel-footer autocomplete"
             v-if="imieiToQuery.length > 1 && !selectedFromList
                    && !isResultEmpty">
            <ul class="list-group" v-if="imieiList && imieiList.length">
                <template v-for="(imiei, index) in imieiList">
                    <li class="list-group-item"
                        @click="imieiSelected(imiei.text, index)">
                        <span v-html="$options.filters.highlight(imiei.text, imieiToQuery)"></span> - <b>{{ imiei["data-subtext"] }}</b>
                    </li>
                </template>
            </ul>
            <div class="loading" v-if="loadingImieiList">
                <div class="lds-ring-small"><div></div><div></div><div></div><div></div></div></div>
        </div>
        <span class="help-block" v-show="imieiToQuery.length < 15">
            IMIEI must be of 15 numbers.
        </span>
    </div>
</template>

<script>
    import axios from 'axios'
    import _ from 'lodash'

    export default {
        name: "imiei-autocomplete",
        data: function() {
            return {
                imieiToQuery: '',
                imieiList: [],
                isResultEmpty: false,
                loadingImieiList: false,
                selectedFromList: false,
            }
        },
        created: function() {
            this.debouncedGetAnswer = _.debounce(this.autoCompleteImiei, 500);
        },
        watch: {
            imieiToQuery: function(newImiei, oldImiei)  {
                this.selectedFromList = (newImiei === oldImiei
                                        || oldImiei.length < newImiei.length) && this.selectedFromList;
                if (!this.selectedFromList)
                    this.$emit('imiei-changed', newImiei);
                this.isResultEmpty = false;

                if (this.imieiToQuery.length < 2)
                    return;
                this.filterImieiList();
                this.loadingImieiList = true;
                this.debouncedGetAnswer();
            },
        },

        filters: {
            highlight: function(string, query) {
                return string.replace(query, '<b>'+query+'</b>')
            }
        },
        methods: {
            filterImieiList: function() {
                this.imieiList = this.imieiList.filter(imiei => {
                    return imiei.text.indexOf(this.imieiToQuery) > -1;
                });
            },
            imieiSelected: function(imiei, index) {
                this.imieiToQuery = imiei;
                this.selectedFromList = true;
                this.$emit('imiei-selected', this.imieiList[index]);
                this.loadingImieiList = false;
                // this.imieiList = [];
            },
            autoCompleteImiei: function() {
                var vm = this;
                axios.get('phoneRecords/imiei-list/' + this.imieiToQuery)
                    .then((response) => {
                        vm.imieiList = response.data.phonesList;
                        this.filterImieiList();
                    })
                    .then(() => {
                        /**
                         * This means that the imiei is not present in DB
                         */
                        vm.isResultEmpty = vm.imieiList.length === 0;

                        if (vm.imieiToQuery.length === 15
                            && vm.imieiList.length === 0) {
                            vm.$emit('add-new-imiei', vm.imieiToQuery);
                        }
                        vm.loadingImieiList = false;
                    })
                    .catch((error) => {
                        console.log('An error occurred while loading imiei list' + error);
                        this.$notify({title: 'An error occurred while loading imiei list', type: 'danger'});
                        vm.loadingImieiList = false;
                        return false;
                    })




            }
        }
    }
</script>

<style scoped>

</style>