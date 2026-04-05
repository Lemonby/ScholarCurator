<?=  $this->include('layout/AdminLayout') ?>
<?=  $this->section('content') ?>


<?php
	$userName = $userName ?? 'Admin';
	$userEmail = $userEmail ?? 'demo@scholarcurator.id';
?>
<div class="p-8 bg-amber-400">
	<h1 class="text-3xl font-bold text-white">Welcome back, <?= esc($userName) ?>!</h1>
	<p class="mt-2 text-sm text-white/90">Your email: <?= esc($userEmail) ?></p>

</div>
