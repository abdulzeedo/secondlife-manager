<?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js') ?>

<div class="row">
    <div class="col-md-6">
        <div class="island-style">
            <h3>Recently added Phones</h3>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-condensed">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Created</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($recentlyAddedPhones as $recentlyAddedPhone): ?>
                            <tr>
                                <td><?= h($recentlyAddedPhone->id) ?></td>
                                <td><?= $this->Time->i18nFormat($recentlyAddedPhone->created) ?></td>
                                <td>
                                    <?= $this->Html->link($recentlyAddedPhone->label, [
                                        'controller' => 'Phones',
                                        'action' => 'view',
                                        $recentlyAddedPhone->id
                                    ]) ?>
                                    <span class="imiei-text"><?= h($recentlyAddedPhone->imiei) ?></span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="island-style">
            <h3>Recently modified Phones</h3>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-condensed">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Modified</th>
                        <th>Description</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($recentlyModifiedPhones as $recentlyModifiedPhone): ?>
                    <tr>
                        <td><?= h($recentlyModifiedPhone->id) ?></td>
                        <td><?= $this->Time->i18nFormat($recentlyAddedPhone->modified) ?></td>
                        <td>
                            <?= $this->Html->link($recentlyModifiedPhone->label, [
                                'controller' => 'Phones',
                                'action' => 'view',
                                $recentlyModifiedPhone->id
                            ]) ?>
                            <span class="imiei-text"><?= h($recentlyModifiedPhone->imiei) ?></span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="island-style">
            <h4>Phones added and tested compared</h4>
            <canvas id="phones-added-tested-chart" width="1000"></canvas>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="island-style">
            <h4>Phones Sold</h4>
            <canvas id="phones-sold-chart" width="1000"></canvas>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="island-style">
            <h4>Phones in different repairs' status</h4>
            <canvas id="repairs-status-count" width="1000"></canvas>
        </div>
    </div>
    <div class="col-md-6">
        <div class="island-style">
            <h4>Phones in different repairs' reason</h4>
            <canvas id="repairs-reason-count" width="1000"></canvas>
        </div>
    </div>
</div>


<!--suppress SyntaxError, UnterminatedStatementJS -->
<script>
    var phonesAddedTested = document.getElementById("phones-added-tested-chart").getContext('2d');
    var phonesSold = document.getElementById("phones-sold-chart").getContext('2d');
    var repairsStatusCount = document.getElementById("repairs-status-count").getContext('2d');
    var repairsReasonCount = document.getElementById("repairs-reason-count").getContext('2d');

    var phonesAddedArray = {
                    data: <?= json_encode($phonesAddedArray["data"]) ?>,
                    type: "line",
                    fill: "false",
                    label: <?= json_encode($phonesAddedArray["label"]) ?>,

                };
    var phonesTestedArray = {
                    type: "line",
                    fill: false,
                    data: <?= json_encode($phonesTestedArray["data"]) ?>,
                    label: <?= json_encode($phonesTestedArray["label"]) ?>
                }

    var phonesSoldArray = <?= json_encode($phonesSoldArray) ?>;
    phonesSoldArray.type = "line";
    phonesSoldArray.fill = false;

    var chartPhonesAddedTested = new Chart(phonesAddedTested, {
        type: 'bar',
        data: {
            datasets: chartStackColours(fillDataHoles(phonesAddedArray,
                                                <?= json_encode($phonesAddedArrayByModel) ?>)
                                        .concat(phonesTestedArray))



        },
        options: {
            tooltips: {
                 mode: 'index',
                 intersect: true,
                 filter: x => x.yLabel > 0
            },
            scales: {
                xAxes: [{
                    type: "time",
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Date'
                    }
                }],
                yAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'value'
                    }
                }]}
        }
    })

    var chartPhonesSold = new Chart(phonesSold, {
        type: "bar",
        data: {
            datasets: chartStackColours(fillDataHoles(phonesSoldArray, <?= json_encode($phonesSoldArrayByModel) ?>))

        },
        options: {
            tooltips: {
                 mode: 'index',
                 intersect: true
            },
            scales: {
                xAxes: [{
                    type: "time",
                    time: {
                        displayFormats: {
                            day: "MMM D ddd"
                        },
                        tooltipFormat: "ddd D MMM YY"
                    },
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Date'
                    }

                }],
                yAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'value'
                    }
                }]}
        }
    })
    var chartRepairStatusCount = new Chart(repairsStatusCount, {
        type: 'bar',
        data: {
            labels: <?= json_encode($repairsStatusCountArray["labels"]) ?>,
            datasets: [
                {
                    data: <?= json_encode($repairsStatusCountArray["datasets"]["data"]) ?>,
                    label: <?= json_encode($repairsStatusCountArray["datasets"]["label"]) ?>,
                    backgroundColor: 'rgba(53, 222, 53, 0.4)',
                }
            ]
        }
    })
    var chartRepairReasonCount = new Chart(repairsReasonCount, {
        type: 'bar',
        data: {
            labels: <?= json_encode($repairsReasonCountArray["labels"]) ?>,
            datasets: [
                {
                    data: <?= json_encode($repairsReasonCountArray["datasets"]["data"]) ?>,
                    label: <?= json_encode($repairsReasonCountArray["datasets"]["label"]) ?>,
                    backgroundColor: 'rgba(53, 222, 53, 0.4)',
                }
            ]
        }
    })
</script>