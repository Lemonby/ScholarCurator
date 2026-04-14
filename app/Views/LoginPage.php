<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>ScholarCurator | Login & Register</title>
	<link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">
</head>
<body class="min-h-screen bg-[radial-gradient(circle_at_20%_20%,#fff9ff_0%,#f7f1fb_38%,#f2ebf8_100%)] px-4 py-6 text-[#2b1f3b] md:px-6">
<?php
	$activeTab = session('activeTab') ?: 'register';
	$message = session('message');
	$loginErrors = session('loginErrors') ?? [];
	$registerErrors = session('register_errors') ?? [];
?>
<main class="mx-auto grid w-full max-w-6xl overflow-hidden rounded-2xl border border-[#f0e6f8] bg-white shadow-[0_20px_50px_rgba(74,28,125,0.12)] lg:grid-cols-2">
	<section class="hidden bg-linear-to-br from-[#4d1e82] via-[#5f249f] to-[#6c2eb0] p-10 text-white lg:block">
		<h1 class="text-4xl font-black tracking-tight">ScholarCurator</h1>
		<p class="mt-4 leading-relaxed text-[#e9d9fb]">Transparent scholarship assessment system using fair, data-driven methodology with measurable SAW approach.</p>
		<div class="mt-6 space-y-4">
			<div class="rounded-xl border border-white/20 bg-white/10 p-4">
				<h3 class="text-base font-bold">Transparent Assessment</h3>
				<p class="mt-2 text-sm text-[#efe2ff]">View weight calculations and scores for each criterion in your selection process in real-time.</p>
			</div>
			<div class="rounded-xl border border-white/20 bg-white/10 p-4">
				<h3 class="text-base font-bold">Science-Based Decision</h3>
				<p class="mt-2 text-sm text-[#efe2ff]">SAW algorithm ensures efficiency, consistency, and accountability in every decision.</p>
			</div>
		</div>
		<div class="mt-8 rounded-xl border border-white/20 bg-white/10 p-4 text-sm text-[#efe2ff]">
			<p class="font-semibold">Quick Access</p>
			<p class="mt-1">Admin: demo@scholarcurator.id / password123</p>
			<p>Student: mahasiswa@scholarcurator.id / password123</p>
		</div>
	</section>

	<section class="p-6 sm:p-8 lg:p-10">
		<h2 class="text-3xl font-black tracking-tight text-[#4d1e82] sm:text-4xl">Begin Your Journey</h2>
		<p class="mt-2 text-sm leading-relaxed text-[#7b7288] sm:text-base">Satu halaman untuk membuat akun baru atau masuk ke akun yang sudah ada.</p>
		<p class="mt-2 rounded-lg bg-[#f7f0fc] px-3 py-2 text-xs text-[#6d6180] sm:hidden">Admin: demo@scholarcurator.id / password123</p>

		<?php if (! empty($message)): ?>
			<div class="mb-4 mt-4 rounded-xl border border-emerald-200 bg-emerald-50 px-3 py-2 text-sm text-emerald-700"><?= esc($message) ?></div>
		<?php endif; ?>

		<div class="mt-5 grid grid-cols-2 gap-2 rounded-xl bg-[#f7f0fc] p-1.5" role="tablist" aria-label="Auth Tabs">
			<button type="button" class="tab-btn rounded-lg px-4 py-2 text-sm font-bold text-[#6d6180] transition" data-target="register">Register</button>
			<button type="button" class="tab-btn rounded-lg px-4 py-2 text-sm font-bold text-[#6d6180] transition" data-target="login">Login</button>
		</div>

		<form id="register" class="auth-form hidden" method="post" action="<?= site_url('register') ?>" novalidate>
			<?= csrf_field() ?>
			<?php if (! empty($registerErrors)): ?>
				<div class="mb-4 mt-4 rounded-xl border border-rose-200 bg-rose-50 px-3 py-2 text-sm text-rose-700">
					Ada data registrasi yang belum valid.
					<ul class="mt-2 list-disc pl-5">
						<?php foreach ($registerErrors as $error): ?>
							<li><?= esc($error) ?></li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endif; ?>

			<div class="mt-4 grid gap-3 sm:grid-cols-2">
				<div>
					<label for="fullName" class="mb-1.5 block text-[11px] font-bold uppercase tracking-[0.08em] text-[#7c728d]">Full Name</label>
					<input id="fullName" name="fullName" type="text" value="<?= esc(old('fullName')) ?>" class="w-full rounded-xl border border-[#ece1f4] bg-[#faf7fd] px-3.5 py-2.5 text-sm text-[#2b1f3b] outline-none ring-0 transition focus:border-[#bf9be7] focus:bg-white" required>
				</div>
				<div>
					<label for="nim" class="mb-1.5 block text-[11px] font-bold uppercase tracking-[0.08em] text-[#7c728d]">NIM</label>
					<input id="nim" name="nim" type="text" value="<?= esc(old('nim')) ?>" class="w-full rounded-xl border border-[#ece1f4] bg-[#faf7fd] px-3.5 py-2.5 text-sm text-[#2b1f3b] outline-none ring-0 transition focus:border-[#bf9be7] focus:bg-white" required>
				</div>
			</div>

			<label for="major" class="mb-1.5 mt-3 block text-[11px] font-bold uppercase tracking-[0.08em] text-[#7c728d]">Major</label>
			<input id="major" name="major" type="text" value="<?= esc(old('major')) ?>" class="w-full rounded-xl border border-[#ece1f4] bg-[#faf7fd] px-3.5 py-2.5 text-sm text-[#2b1f3b] outline-none ring-0 transition focus:border-[#bf9be7] focus:bg-white" required>

			<label for="registerEmail" class="mb-1.5 mt-3 block text-[11px] font-bold uppercase tracking-[0.08em] text-[#7c728d]">Email Address</label>
			<input id="registerEmail" name="email" type="email" value="<?= esc(old('email')) ?>" class="w-full rounded-xl border border-[#ece1f4] bg-[#faf7fd] px-3.5 py-2.5 text-sm text-[#2b1f3b] outline-none ring-0 transition focus:border-[#bf9be7] focus:bg-white" required>

			<label for="registerPassword" class="mb-1.5 mt-3 block text-[11px] font-bold uppercase tracking-[0.08em] text-[#7c728d]">Password</label>
			<input id="registerPassword" name="password" type="password" class="w-full rounded-xl border border-[#ece1f4] bg-[#faf7fd] px-3.5 py-2.5 text-sm text-[#2b1f3b] outline-none ring-0 transition focus:border-[#bf9be7] focus:bg-white" required>

			<button class="mt-5 w-full rounded-xl bg-linear-to-r from-[#5f249f] to-[#6f2fb8] px-4 py-3 text-sm font-bold text-white shadow-[0_10px_22px_rgba(95,36,159,0.25)] transition hover:-translate-y-0.5" type="submit">Create My Profile</button>
		</form>

		<form id="login" class="auth-form hidden" method="post" action="<?= site_url('login') ?>" novalidate>
			<?= csrf_field() ?>
			<?php if (! empty($loginErrors)): ?>
				<div class="mb-4 mt-4 rounded-xl border border-rose-200 bg-rose-50 px-3 py-2 text-sm text-rose-700">
					Login gagal, cek kembali email atau password.
					<ul class="mt-2 list-disc pl-5">
						<?php foreach ($loginErrors as $error): ?>
							<li><?= esc($error) ?></li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endif; ?>

			<label for="loginEmail" class="mb-1.5 mt-4 block text-[11px] font-bold uppercase tracking-[0.08em] text-[#7c728d]">Email Address</label>
			<input id="loginEmail" name="email" type="email" value="<?= esc(old('email')) ?>" class="w-full rounded-xl border border-[#ece1f4] bg-[#faf7fd] px-3.5 py-2.5 text-sm text-[#2b1f3b] outline-none ring-0 transition focus:border-[#bf9be7] focus:bg-white" required>

			<label for="loginPassword" class="mb-1.5 mt-3 block text-[11px] font-bold uppercase tracking-[0.08em] text-[#7c728d]">Password</label>
			<input id="loginPassword" name="password" type="password" class="w-full rounded-xl border border-[#ece1f4] bg-[#faf7fd] px-3.5 py-2.5 text-sm text-[#2b1f3b] outline-none ring-0 transition focus:border-[#bf9be7] focus:bg-white" required>

			<button class="mt-5 w-full rounded-xl bg-linear-to-r from-[#5f249f] to-[#6f2fb8] px-4 py-3 text-sm font-bold text-white shadow-[0_10px_22px_rgba(95,36,159,0.25)] transition hover:-translate-y-0.5" type="submit">Login</button>
		</form>
	</section>
</main>

<script>
	(function () {
		const tabs = document.querySelectorAll('.tab-btn');
		const forms = document.querySelectorAll('.auth-form');
		let current = '<?= esc($activeTab) ?>';

		if (location.hash === '#login' || location.hash === '#register') {
			current = location.hash.replace('#', '');
		}

		function activateTab(target) {
			tabs.forEach((btn) => {
				btn.classList.toggle('active', btn.dataset.target === target);
				btn.classList.toggle('bg-white', btn.dataset.target === target);
				btn.classList.toggle('text-[#4d1e82]', btn.dataset.target === target);
				btn.classList.toggle('shadow-[0_4px_14px_rgba(95,36,159,0.12)]', btn.dataset.target === target);
			});

			forms.forEach((form) => {
				form.classList.toggle('hidden', form.id !== target);
			});
		}

		tabs.forEach((btn) => {
			btn.addEventListener('click', () => {
				const target = btn.dataset.target;
				activateTab(target);
				history.replaceState(null, '', '#' + target);
			});
		});

		activateTab(current === 'login' ? 'login' : 'register');
	})();
</script>
</body>
</html>
