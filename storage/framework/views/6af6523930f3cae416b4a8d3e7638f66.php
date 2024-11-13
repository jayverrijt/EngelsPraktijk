<?php $__env->startSection('popupcontent'); ?>
    <script>
        document.getElementById('popupContainer').style.display = 'block';
    </script>
    <div class="popup-icon-holder">
        <i class="fas fa-exclamation-triangle"></i>
    </div>
    <div class="popup-text-holder">
        <p>Weet je zeker je dit wil verwijderen?</p>
    </div>
    <div class="popup-btn-holder">
    <form method="get" action="<?php echo e(route('admin.cards-del-item', ['t' => $type, 'id' => $item])); ?>">
        <button type="submit" name="choise" value="1" style="left: 0">Ja</button>
        <button type="submit" name="choise" value="2" style="right: 0">Nee</button>
    </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layouts/cards-fs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/jayv/Projects/EngelsPraktijk/resources/views/admin/layouts/cards-popup-del.blade.php ENDPATH**/ ?>