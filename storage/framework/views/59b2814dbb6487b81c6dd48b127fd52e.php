<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/cms/cards.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/cms/users.css')); ?>">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet" href="<?php echo e(asset('css/cms/launch.css')); ?>">
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Questions', 'Type of Questions'],
                ['Open vragen',     <?php echo e($ov); ?>],
                ['Ja/Nee vragen',      <?php echo e($jnv); ?>],
            ]);

            var options = {
                legend: 'none',
                pieSliceText: 'label',
                backgroundColor: 'transparent',
                pieStartAngle: 0,
                pieHole: 0.1,
                stroke: '#2e3440',
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }

    </script>
    <div class="container" id="dashContainer">
        <div class="locationBody" style="height: 100%; top: 1%">
            <!--- Card Left Top - Donut Chart GoogleChartAPI --->
            <div class="bodyControl" style="left: 0; top: 0">
                <div class="canvaGenderHead">
                    <i id="labelGen" class="fas fa-chart-pie" style="left: 2%; position:absolute; top: 1%; color: #2e3440; font-size: 2rem"></i>
                    <label id="labelGenLabel" for="labelGen" style="left: 8%; position:absolute; padding: 0; margin: 0; color: #2e3440; font-size: 1.8rem">Soorten vragen</label>
                </div>
                <div class="canvaGenderBody">
                    <div id="piechart" style="min-height: 100%; min-width: 100% "></div>
                </div>

            </div>
            <!--- Card Left Bottom - List Yes No Qs --->
            <div class="bodyControl" style="bottom: 0; left: 0">
                <div class="maxbtn">
                    <form method="get" action="<?php echo e(route('admin.cards-fs')); ?>">
                        <button name="type" value="1" style="border: solid 0; background-color: transparent" type="submit"><i id="maxbtnico" class="fas fa-compress"></i></button>
                    </form>
                </div>
                <table id="customers">
                    <tr class="">
                        <th>Vraag</th>
                        <th>Antwoord</th>
                        <th>Categorie</th>
                        <th>Level</th>
                    </tr>
                    <?php $__currentLoopData = $qs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $q): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($q->question); ?></td>
                            <td><?php echo e($q->answer); ?></td>
                            <td><?php echo e($q->category_id); ?></td>
                            <td><?php echo e($q->level_id); ?></td>
                        </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </table>

            </div>
            <!--- Card Right Top - Controls --->
            <div class="bodyControl" style="right: 0; top: 0; background-color: transparent">
                <div class="bodyControl" style="width: 48%;height: 100%; left: 0; top: 0;">
                    <div class="cardAddHeader">
                        <p class="cardAddHeaderP">Open vragen toevoegen</p>
                    </div>
                    <div class="cardAddBody">
                        <form method="get" action="<?php echo e(route('admin.cards-add')); ?>">
                            <div style="height: 5vh">
                                <label style="left: 5%; position:relative;" for="qname">Naam van vraag</label>
                                <input type="text" id="qname" name="qname"/>
                            </div>
                            <div style="height: 5vh">
                                <label style="left: 5%; position:relative;" for="qanswer">Antwoord</label>
                                <input type="text" id="qanswer" name="qanswer"/>
                            </div>
                            <div style="height: 5vh">
                            <label style="left: 5%; position:relative;" for="qlevel">Level</label>
                            <select name="qlevel" id="qlevel">
                                <?php $__currentLoopData = $levels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lvl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($lvl->id); ?>"><?php echo e($lvl->level_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            </div>
                            <button class="cardBtnSubmit" name="type" value="1" type="submit"> Toevoegen</button>
                        </form>
                    </div>
                </div>
                <div class="bodyControl" style="width: 48%;height: 100%; right: 0; top: 0;">
                    <div class="cardAddHeader">
                        <p class="cardAddHeaderP">Ja/Nee vragen toevoegen</p>
                    </div>
                    <form method="get" action="<?php echo e(route('admin.cards-add')); ?>">
                        <div class="cardAddBody">
                            <div style="height: 5vh">
                                <label style="left: 5%; position:relative;" for="qname">Naam van vraag</label>
                                <input type="text" id="qname" name="qname"/>
                            </div>
                            <div style="height: 5vh">
                                <label style="left: 5%; position:relative;" for="qansweryn">Antwoord</label>
                                <select name="qansweryn" id="qansweryn">
                                    <option value="0">Ja/nee kiezen</option>
                                    <option value="1">Ja</option>
                                    <option value="2">Nee</option>
                                </select>
                            </div>
                            <div style="height: 5vh">
                                <label style="position:relative; left: 5%" for="qlevel">Level</label>
                                <select name="qlevel" id="qlevel">
                                    <?php $__currentLoopData = $levels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lvl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($lvl->id); ?>"><?php echo e($lvl->level_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <button class="cardBtnSubmit" name="type" value="2" type="submit"> Toevoegen</button>
                        </div>
                    </form>
                </div>
            </div>
            <!--- Card Right Bottom - List Qs --->
            <div class="bodyControl" style="right: 0; bottom: 0">
                <div class="maxbtn">
                    <form method="get" action="<?php echo e(route('admin.cards-fs')); ?>">
                        <button style="border: solid 0; background-color: transparent" name="type" value="2" type="submit"><i id="maxbtnico" class="fas fa-compress"></i></button>
                    </form>
                </div>
                <table id="customers">
                    <tr class="">
                        <th>Vraag</th>
                        <th>Antwoord (Ja/Nee)</th>
                        <th>Categorie</th>
                        <th>Level</th>
                    </tr>
                    <?php $__currentLoopData = $qsyn; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $qy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($qy->question); ?></td>
                            <td><?php echo e($qy->answer); ?></td>
                            <td><?php echo e($qy->category_id); ?></td>
                            <td><?php echo e($qy->level_id); ?></td>
                        </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </table>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make("admin/dashboard", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/jayv/Projects/EngelsPraktijk/resources/views/admin/layouts/cards.blade.php ENDPATH**/ ?>