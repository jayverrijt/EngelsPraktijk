<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/cms/cards.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/cms/popups.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/cms/users.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/cms/launch.css')); ?>">
    <div class="container popup-container" style="display: none" id="popupContainer">
        <?php echo $__env->yieldContent('popupcontent'); ?>
    </div>
    <div class="container contentcardsfs">
        <div class="container cardsfshead">
            <p style="font-size: 1rem; position:relative; left: 2%; color: #2e3440; font-weight: 600; width: 50%">
                <?php if($type == 1): ?> Open Vragen - Fullscreen <?php elseif($type == 2): ?> Ja/Nee vragen - Fullscreen <?php endif; ?>
            </p>
            <a href="<?php echo e(route('admin.cards')); ?>"><i style="right: 1%; position:absolute; top: 25%; font-size: 1.5rem; color: darkred" class="fas fa-times"></i></a>
        </div>
        <div class="container cardsfsbody">
            <table id="customers">
                <tr class="">
                    <th>Vraag</th>
                    <th>Antwoord</th>
                    <th>Categorie</th>
                    <th>Level</th>
                    <th>Actions</th>
                </tr>
                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $q): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($q->question); ?></td>
                        <td><?php echo e($q->answer); ?></td>
                        <td><?php echo e($q->category_id); ?></td>
                        <td><?php echo e($q->level_id); ?></td>
                        <td style="display: inline-flex; width: 100%; position:relative;">
                            <div id="btnEdit" style="height: 100%; width: 15%">
                                <form method="get" action="">
                                    <button type="submit" name="item" value="<?php echo e($q->id); ?>"><i class="fas fa-pencil-alt"></i></button>
                                </form>
                            </div>
                            <div id="btnDelete">
                                <form method="get" action="<?php echo e(route('noti.cards-del', ['t' => $type])); ?>">
                                    <button type="submit" name="item" value="<?php echo e($q->id); ?>"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("admin/dashboard", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/jayv/Projects/EngelsPraktijk/resources/views/admin/layouts/cards-fs.blade.php ENDPATH**/ ?>