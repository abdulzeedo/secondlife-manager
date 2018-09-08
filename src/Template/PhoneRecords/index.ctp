<script>
    window.user_id = <?= $userLoggedIn['id'] ?>;
    $(".se-pre-con").fadeOut("slow");
</script>
<div id="app">
<div class="row">

    <div class="col-sm-12 island-style-v-spaced">
        <form class="form-horizontal">
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-3 text-right">
                        <label for="imiei" class="control-label">IMIEI</label>
                    </div>
                    <div class="col-sm-6">
                        <imiei-autocomplete
                                @imiei-selected="imieiSelected"
                                @add-new-imiei="addNewImiei"
                                @imiei-changed="imieiChanged">
                        </imiei-autocomplete>
                        <span v-if="newImieiToAdd && currentImiei" class="help-block">
                            Looks like this imiei is not in database. Add it.
                        </span>
                        <div v-if="loadingPhonesDetails">
                            Loading phone details...
                            <div class="lds-ring-small"><div></div><div></div><div></div><div></div></div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <modal-new-phone @new-phone-submit="newPhoneSubmit"
                                         :imiei="newImieiToAdd" :current-imiei="currentImiei"></modal-new-phone>
                        <!--<modal-new-phone :id="'addNewPhoneModal'" :imiei="newImieiToAdd"></modal-new-phone>-->
                    </div>
                    <div class="col-sm-2" v-if="!newImieiToAdd ">
                        <button class="btn btn-primary" v-bind:disabled="imieiToAdd === ''"
                                 @click.prevent="addPhone(); removeFocus($event)">Add Phone</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

    <div class="row">
        <div class="col-sm-12 island-style">
            <h3>Phones Table</h3>
            <phones-table @delete-phone-record="deletePhone"
                          v-bind:phones-list="phonesList"
                          v-bind:loading="loadingPhoneRow"
                          ></phones-table>
        </div>
    </div>
<!-- Add modals here -->
    <router-view></router-view>
    <modal v-model="imieiScanPhoneAddLoading" :footer="false" :keyboard="false"
           :dismiss-btn="false">
        <span slot="title">Adding phone for you</span>
        <div class="text-center">
            <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
            <p>Loading phone details and appending to table, please wait!</p>
        </div>
    </modal>
    <barcode-scanner @imiei-scanned="onImieiScanned"></barcode-scanner>
</div>

<?= $this->Html->script('/dist/main.js') ?>
