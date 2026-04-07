<?= $this->extend('layout/AdminLayout') ?>

<?= $this->section('content') ?>

<?php	$userName = $userName ?? 'Admin';
	$userEmail = $userEmail ?? 'demo@scholarcurator.id';
?>

<div class="p-8 space-y-8">
	<!-- Application Status & Active Criteria -->
	<div class="grid grid-cols-3 gap-6">
		<!-- Application Status -->
		<div class="bg-gradient-to-br from-[#f3e8ff] to-[#e9d5ff] rounded-2xl p-6 shadow-sm border border-purple-200">
			<h3 class="text-lg font-bold text-gray-900 mb-6">Summary Aplication</h3>
			<div class="space-y-4">
				<div class="flex items-center justify-between">
					<div class="flex items-center gap-2">
						<span class="w-3 h-3 bg-[#6b3a9d] rounded-full"></span>
						<span class="text-sm font-medium text-gray-700">Total User</span>
					</div>
					<span class="text-lg font-bold text-gray-900"> <?= $mahasiswaCount ?></span>
				</div>
				<div class="flex items-center justify-between">
					<div class="flex items-center gap-2">
						<span class="w-3 h-3 bg-[#6b3a9d] rounded-full"></span>
						<span class="text-sm font-medium text-gray-700">Pass</span>
					</div>
					<span class="text-lg font-bold text-gray-900"> <?= $mahasiswaPassCount ?></span>
				</div>
				<div class="flex items-center justify-between">
					<div class="flex items-center gap-2">
						<span class="w-3 h-3 bg-[#6b3a9d] rounded-full"></span>
						<span class="text-sm font-medium text-gray-700">did not qualify</span>
					</div>
					<span class="text-lg font-bold text-gray-900"> <?= $mahasiswaFailCount ?></span>
				</div>
			</div>
			<button class="mt-6 w-full flex items-center justify-between px-4 py-2 text-[#6b3a9d] font-semibold hover:bg-white/50 rounded-lg transition">
				REVIEW QUEUE
				<i class="bi bi-chevron-right"></i>
			</button>
		</div>

		<!-- Active Scholarship Programs -->
		<div class="col-span-2 bg-white rounded-2xl p-6 shadow-sm overflow-y-auto">
			<div class="flex items-center justify-between mb-6">
				<h3 class="text-lg font-bold text-gray-900">Student That Pass</h3>
				<a href="#" class="text-[#6b3a9d] font-semibold text-sm hover:underline">View All Programs</a>
			</div>
			<div class="space-y-4">
				<!-- Program 1 -->
				<?php foreach ($mahasiswaPass as $mahasiswa): ?>
					<div class="flex items-center justify-between p-4 border border-gray-200 rounded-xl hover:border-[#6b3a9d] transition">
						<div class="flex items-center gap-4">
							<div class="w-12 h-12 rounded-full bg-gradient-to-br from-[#6b3a9d] to-[#4f2782] flex items-center justify-center text-white">
								<i class="bi bi-globe"></i>
							</div>
							<div>
								<h4 class="font-semibold text-gray-900"><?= $mahasiswa['name'] ?></h4>
								<p class="text-sm text-gray-500"><?= $mahasiswa['NIM'] ?></p>
							</div>
						</div>
						<div class="text-right">
							<p class="font-bold text-green-500"><?= $mahasiswa['finalScore'] ?></p>
							<span class="text-xs bg-green-500/10 text-green-500 px-2 py-1 rounded font-semibold">PASSED</span>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>

	<!-- Active Criteria -->
	<div class="grid grid-cols-3 gap-6">
		<!-- list Active Criteria -->
		<div class="col-span-2 bg-white rounded-2xl p-6 shadow-sm">
			<div class="flex items-center justify-between mb-6">
				<h3 class="text-lg font-bold text-gray-900">Active Criteria</h3>
				<a href="#" class="text-[#6b3a9d] font-semibold text-sm hover:underline">Go to Inbox</a>
			</div>
			<div class="grid grid-cols-1 gap-4 md:grid-cols-2">
				<?php foreach ($criteriaList as $criteria) : ?>
					<?php 
						$type = strtolower($criteria['criteriaType'] ?? 'benefit');
						$badgeClass = $type === 'benefit' 
							? 'bg-yellow-400 text-white' 
							: 'bg-red-500 text-white';
						$iconBgClass = $type === 'benefit' 
							? 'bg-yellow-400/50' 
							: 'bg-red-500/50';
						$iconClass = $type === 'benefit' ? 'text-yellow-600' : 'text-red-600';
						$cardHoverClass = $type === 'benefit' ? 'hover:border-yellow-300' : 'hover:border-red-300';
					?>
					<div class="group relative overflow-hidden rounded-2xl border border-gray-200 bg-gradient-to-br from-white to-gray-50 p-4 transition duration-200 hover:-translate-y-0.5 hover:shadow-md <?= $cardHoverClass ?>">
						<div class="absolute -right-6 -top-6 h-16 w-16 rounded-full bg-[#6b3a9d]/5"></div>
						<div class="absolute -left-6 -bottom-6 h-16 w-16 rounded-full bg-[#6b3a9d]/5"></div>
						<div class="relative flex items-center justify-between">
							<div class="flex items-center gap-3">
								<div class="w-12 h-12 rounded-xl <?= $iconBgClass ?> flex items-center justify-center flex-shrink-0">
									<i class="bi bi-check2-circle <?= $iconClass ?>"></i>
								</div>
								<div class="min-w-0">
									<h4 class="font-semibold text-gray-900 leading-tight"><?= $criteria['criteriaName'] ?></h4>
									<p class="text-xs text-gray-500 mt-1"><?= ucfirst($type) ?></p>
								</div>
							</div>
							<div class="text-right flex-shrink-0 ml-2">
								<p class="font-bold text-gray-900 text-base"><?= (int)($criteria['criteriaWeight'] * 100) ?>%</p>
								<span class="text-[11px] px-2.5 py-1 rounded-full font-semibold tracking-wide <?= $badgeClass ?>"><?= strtoupper($type) ?></span>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>

		<!-- Scale Your Impact -->
		<div class="bg-gradient-to-br from-[#6b3a9d] to-[#4f2782] rounded-2xl p-6 text-white shadow-lg">
			<h3 class="text-lg font-bold mb-2">Scale your impact with Analytics</h3>
			<p class="text-sm opacity-75 mb-6">Export detailed demographic reports to better understand your applicant pool reach.</p>
			<button class="w-full bg-white text-[#6b3a9d] font-bold py-2 rounded-lg hover:bg-gray-100 transition">
				Generate Report
			</button>
		</div>
	</div>
	</div>

		
</div>

<?= $this->endSection() ?>
