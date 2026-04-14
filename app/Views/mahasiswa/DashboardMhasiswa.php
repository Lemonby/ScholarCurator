<!-- <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ScholarCurator | Mahasiswa Dashboard</title>
	<link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">
</head>
<body class="min-h-screen bg-[#f8f2fb] text-[#2b1f3b]">
<?php
	$userName = $userName ?? 'Mahasiswa';
	$userEmail = $userEmail ?? 'mahasiswa@scholarcurator.id';
?>
<div class="mx-auto flex min-h-screen max-w-5xl items-center justify-center px-4 py-10">
	<div class="w-full rounded-[30px] border border-white/70 bg-white/90 p-8 shadow-[0_18px_40px_rgba(95,36,159,0.08)] backdrop-blur-xl">
		<p class="text-xs uppercase tracking-[0.3em] text-[#8a7a9d]">ScholarCurator</p>
		<h1 class="mt-3 text-4xl font-black text-[#4d1e82]">Dashboard Mahasiswa</h1>
		<p class="mt-3 max-w-2xl text-sm leading-6 text-[#7b7288]">Halaman mahasiswa masih disiapkan. Dummy account ini sudah diarahkan ke route yang tepat, jadi nanti kita tinggal isi konten dashboard-nya.</p>

		<div class="mt-8 grid gap-4 md:grid-cols-2">
			<div class="rounded-[24px] bg-[#f7f0fc] p-5">
				<p class="text-xs uppercase tracking-[0.25em] text-[#8a7a9d]">User</p>
				<p class="mt-2 text-xl font-bold"><?= esc($userName) ?></p>
				<p class="mt-1 text-sm text-[#7b7288]"><?= esc($userEmail) ?></p>
			</div>
			<div class="rounded-[24px] bg-[#f7f0fc] p-5">
				<p class="text-xs uppercase tracking-[0.25em] text-[#8a7a9d]">Status</p>
				<p class="mt-2 text-xl font-bold text-[#5f249f]">Ready for next iteration</p>
				<p class="mt-1 text-sm text-[#7b7288]">Nanti kita isi dengan dashboard mahasiswa yang sesungguhnya.</p>
			</div>
		</div>

		<div class="mt-8 flex flex-wrap gap-3">
			<a class="rounded-xl bg-[#5f249f] px-4 py-3 text-sm font-bold text-white shadow-[0_10px_22px_rgba(95,36,159,0.25)]" href="<?= site_url('logout') ?>">Logout</a>
			<a class="rounded-xl border border-[#eadcf5] bg-white px-4 py-3 text-sm font-bold text-[#5f249f]" href="<?= site_url('login') ?>">Back to Login</a>
		</div>
	</div>
</div>
</body>
</html> -->