<?= $this->extend('layout/main') ?>

<?= $this->section('menu') ?>
<li class="has-submenu">
    <a href="<?= site_url("layout") ?>#satu"><i class="mdi mdi-airplay"></i>Dashboard</a>
</li>

<li class="has-submenu">
    <a href="<?= site_url("layout") ?>#dua"><i></i>Profile</a>
</li>

<li class="has-submenu">
    <a href="<?= site_url("layout") ?>#tiga"><i></i>Alamat</a>
</li>

<li class="has-submenu">
    <a href="<?= site_url("layout") ?>#empat"><i></i>About ME</a>
</li>

<li class="has-submenu">
    <a href="<?= site_url("layout") ?>#lima"><i></i>Referensi</a>
</li>


<li class="has-submenu">
    <a href="<?= site_url("property") ?>">Properties</a>
</li>

<?= $this->endSection() ?>