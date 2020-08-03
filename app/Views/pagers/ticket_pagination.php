<!-- jumlah angka halaman di pagination -->
<?php $pager->setSurroundCount(2) ?>

<div class="pagination justify-content-center mt-3">
    <!-- <nav aria-label="Page navigation "> -->
    <!-- <ul class="pagination"> -->
    <?php if ($pager->hasPrevious()) : ?>
        <li class="page-item">
            <a class="page-link" href="<?= $pager->getFirst() ?>" aria-label="<?= lang('Pager.first') ?>" style="color: #2B50B4;border:none !important;">
                <!-- <span aria-hidden="true"><?= lang('Pager.first') ?></span> -->
                <span aria-hidden="true">&laquo</span>
            </a>
        </li>
        <!-- <li class="page-item">
                <a class="page-link" href="<?= $pager->getPrevious() ?>" aria-label="<?= lang('Pager.previous') ?>">
                    <span aria-hidden="true"><?= lang('Pager.previous') ?></span>
                </a>
            </li> -->
    <?php endif ?>

    <?php foreach ($pager->links() as $link) : ?>
        <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
            <a class="page-link" href="<?= $link['uri'] ?>" style="color: #2B50B4;border:none !important;outline:none !important;background-color: white;">
                <?= $link['title'] ?>
            </a>
        </li>
    <?php endforeach ?>

    <?php if ($pager->hasNext()) : ?>
        <!-- <li class="page-item">
                <a class="page-link" href="<?= $pager->getNext() ?>" aria-label="<?= lang('Pager.next') ?>">
                    <span aria-hidden="true"><?= lang('Pager.next') ?></span>
                </a>
            </li> -->
        <li class="page-item">
            <a class="page-link" href="<?= $pager->getLast() ?>" aria-label="<?= lang('Pager.last') ?>" style="color: #2B50B4;border:none !important;">
                <!-- <span aria-hidden="true"><?= lang('Pager.last') ?></span> -->
                <span aria-hidden="true">&raquo</span>
            </a>
        </li>
    <?php endif ?>
    <!-- </ul> -->
    <!-- </nav> -->
</div>