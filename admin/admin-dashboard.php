<?php
require_once 'assets/php/admin-header.php';
require_once 'assets/php/admin-db.php';
$count = new Admin();
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card-deck mt-3 text-light text-center font-weight-bold">
            <div class="card bg-primary">
                <div class="card-header">所有使用者</div>
                <div class="card-body">
                    <h1 class="display-4">
                        <?= $count->totalCount('users'); ?>
                    </h1>
                </div>
            </div>
            <div class="card bg-warning">
                <div class="card-header">驗證使用者</div>
                <div class="card-body">
                    <h1 class="display-4">
                        <?= $count->verified_users(1); ?>
                    </h1>
                </div>
            </div>
            <div class="card bg-success">
                <div class="card-header">未驗證使用者</div>
                <div class="card-body">
                    <h1 class="display-4">
                        <?= $count->verified_users(0); ?>
                    </h1>
                </div>
            </div>
            <div class="card bg-danger">
                <div class="card-header">網站瀏覽次數</div>
                <div class="card-body">
                    <h1 class="display-4">
                        <?php $data = $count->site_hits();
                        echo $data['hits']; ?>
                    </h1>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card-deck mt-3 text-light text-center font-weight-bold">
            <div class="card bg-danger">
                <div class="card-header">Notes總數</div>
                <div class="card-body">
                    <h1 class="display-4">
                        <?= $count->totalCount('notes'); ?>
                    </h1>
                </div>
            </div>
            <div class="card bg-success">
                <div class="card-header">回饋意見總數</div>
                <div class="card-body">
                    <h1 class="display-4">
                        <?= $count->totalCount('feedback'); ?>
                    </h1>
                </div>
            </div>
            <div class="card bg-info">
                <div class="card-header">訊息通知總數</div>
                <div class="card-body">
                    <h1 class="display-4">
                        <?= $count->totalCount('notification'); ?>
                    </h1>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card-deck my-3">
            <div class="card border-success">
                <div class="card-header bg-success text-center text-white lead">
                    男女使用者比例
                </div>
                <div id="chartOne" style="width: 99%; height: 400px;"></div>
            </div>
            <div class="card border-info">
                <div class="card-header bg-info text-center text-white lead">
                    驗證/未驗證比例
                </div>
                <div id="chartTwo" style="width: 99%; height: 400px;"></div>
            </div>
        </div>
    </div>
</div>

<!-- footer -->
</div>
</div>
</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    checkNotification()

    function checkNotification() {
        $.ajax({
            url: 'assets/php/admin-action.php',
            method: 'post',
            data: {
                action: 'checkNotification'
            },
            success: function(response) {
                $("#checkNotification").html(response);
            }
        });
    }
    // =============  男女比例圖表  ==================
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(pieChart);

    function pieChart() {
        var data = new google.visualization.arrayToDataTable([
            ['Gender', 'Number'],
            <?php
            $gender = $count->genderPer();
            foreach ($gender as $row) {
                echo '["' . $row['gender'] . '",' . $row['number'] . '],';
            }

            ?>

        ]);

        var options = {
            is3D: false
        };
        var chart = new google.visualization.PieChart(document.getElementById('chartOne'));
        chart.draw(data, options);
    }
    // ===========  驗證人數比例  =================
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(colChart);

    function colChart() {
        var data = new google.visualization.arrayToDataTable([
            ['Verified', 'Number'],
            <?php
            $verified = $count->verifiedPer();
            foreach ($verified as $row) {
                if ($row['verified'] == 0) {
                    $row['verified'] = "Unverified";
                } else {
                    $row['verified'] = "Verified";
                }
                echo '["' . $row['verified'] . '",' . $row['number'] . '],';
            }

            ?>

        ]);

        var options = {
            pieHole: 0.4,
        };
        var chart = new google.visualization.PieChart(document.getElementById('chartTwo'));
        chart.draw(data, options);
    }
</script>
</body>

</html>