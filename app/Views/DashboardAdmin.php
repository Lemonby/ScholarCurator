<?= $this->extend('layout/AdminLayout') ?>

<?= $this->section('content') ?>

<?php	$userName = $userName ?? 'Admin';
	$userEmail = $userEmail ?? 'demo@scholarcurator.id';
?>

<div class="p-8 space-y-8">
	<!-- Welcome Header with Quick Stats -->
	<div class="bg-gradient-to-r from-[#6b3a9d] to-[#4f2782] rounded-2xl p-8 text-white shadow-lg">
		<div class="mb-6">
			<h2 class="text-3xl font-bold mb-2">Welcome back, <?= $userName ?> 👋</h2>
			<p class="text-purple-100">Here's your scholarship selection summary</p>
		</div>

		<!-- Quick Stats Row -->
		<div class="grid grid-cols-4 gap-4">
			<div class="bg-white/10 backdrop-blur rounded-xl p-4 border border-white/20">
				<p class="text-sm text-white/70 mb-1">Total Applications</p>
				<p class="text-3xl font-bold text-white"><?= $mahasiswaCount ?></p>
			</div>
			<div class="bg-green-500/20 backdrop-blur rounded-xl p-4 border border-green-400/30">
				<p class="text-sm text-green-100 mb-1">Selected</p>
				<p class="text-3xl font-bold text-green-300"><?= $mahasiswaPassCount ?></p>
			</div>
			<div class="bg-red-500/20 backdrop-blur rounded-xl p-4 border border-red-400/30">
				<p class="text-sm text-red-100 mb-1">Not Selected</p>
				<p class="text-3xl font-bold text-red-300"><?= $mahasiswaFailCount ?></p>
			</div>
			<div class="bg-blue-500/20 backdrop-blur rounded-xl p-4 border border-blue-400/30">
				<p class="text-sm text-blue-100 mb-1">Selection Rate</p>
				<p class="text-3xl font-bold text-blue-300"><?php echo $mahasiswaCount > 0 ? round(($mahasiswaPassCount / $mahasiswaCount) * 100, 1) : 0; ?>%</p>
			</div>
		</div>
	</div>

	<!-- Application Status & Active Criteria -->
	<div class="grid grid-cols-2 gap-6">
		<!-- Active Scholarship Programs -->
		<div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-200">
			<div class="flex items-center justify-between mb-6">
				<h3 class="text-lg font-bold text-gray-900">Top Selections</h3>
				<a href="/admin/admissions" class="text-[#6b3a9d] font-semibold text-sm hover:underline">View All</a>
			</div>
			<div class="space-y-4">
				<!-- Program 1 -->
				<?php 
					$count = 0;
					foreach ($mahasiswaPass as $mahasiswa): 
						if ($count >= 3) break;
						$count++;
				?>
					<div class="flex items-center justify-between p-4 border border-gray-200 rounded-xl hover:border-[#6b3a9d] transition hover:shadow-md">
						<div class="flex items-center gap-4">
							<div class="w-12 h-12 rounded-full bg-gradient-to-br from-[#6b3a9d] to-[#4f2782] flex items-center justify-center text-white font-bold">
								<?= $count ?>
							</div>
							<div>
								<h4 class="font-semibold text-gray-900"><?= $mahasiswa['name'] ?></h4>
								<p class="text-sm text-gray-500"><?= $mahasiswa['NIM'] ?></p>
							</div>
						</div>
						<div class="text-right">
							<p class="font-bold text-green-600"><?= $mahasiswa['finalScore'] ?></p>
							<span class="text-xs bg-green-500/10 text-green-600 px-2 py-1 rounded-full font-semibold">SELECTED</span>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>

		<!-- Quick Performance Insights -->
		<div class="bg-gradient-to-br from-[#6b3a9d] to-[#4f2782] rounded-2xl p-6 text-white shadow-lg border border-purple-400/20">
			<h3 class="text-lg font-bold mb-6">Selection Insights</h3>
			
			<!-- Stats Grid -->
			<div class="space-y-3">
				<!-- Top Score -->
				<div class="bg-white/10 backdrop-blur rounded-xl p-3 border border-white/20">
					<p class="text-xs text-white/70 mb-1">Highest Score</p>
					<p class="text-2xl font-bold text-yellow-300">
						<?php 
							$topScore = 0;
							foreach ($mahasiswaPass as $mhs) {
								if (!empty($mhs['finalScore']) && $mhs['finalScore'] > $topScore) {
									$topScore = $mhs['finalScore'];
								}
							}
							echo $topScore > 0 ? $topScore : 'N/A';
						?>
					</p>
				</div>

				<!-- Cutoff Score -->
				<div class="bg-white/10 backdrop-blur rounded-xl p-3 border border-white/20">
					<p class="text-xs text-white/70 mb-1">Cutoff Score</p>
					<p class="text-2xl font-bold text-orange-300">
						<?php 
							$minScore = PHP_FLOAT_MAX;
							foreach ($mahasiswaPass as $mhs) {
								if (!empty($mhs['finalScore']) && $mhs['finalScore'] < $minScore) {
									$minScore = $mhs['finalScore'];
								}
							}
							echo $minScore < PHP_FLOAT_MAX ? $minScore : 'N/A';
						?>
					</p>
				</div>

				<!-- Selection Summary -->
				<div class="bg-gradient-to-r from-green-500/20 to-blue-500/20 backdrop-blur rounded-xl p-3 border border-white/20">
					<p class="text-xs text-white/70 mb-2">Selection Summary</p>
					<div class="flex items-end gap-2">
						<div>
							<p class="text-sm text-white/60">Selected</p>
							<p class="text-xl font-bold text-green-300"><?= $mahasiswaPassCount ?></p>
						</div>
						<span class="text-white/50 mb-1">of</span>
						<div>
							<p class="text-sm text-white/60">Total</p>
							<p class="text-xl font-bold text-blue-300"><?= $mahasiswaCount ?></p>
						</div>
					</div>
				</div>
			</div>

			<!-- Action Buttons -->
			<div class="mt-6 space-y-2">
				<a href="/admin/admissions" class="w-full flex items-center justify-between px-4 py-2.5 bg-white text-[#6b3a9d] font-semibold rounded-lg hover:bg-gray-100 transition">
					See Full Rankings
					<i class="bi bi-arrow-right"></i>
				</a>
			</div>
		</div>
	</div>

	<!-- Active Criteria -->
	<div class="grid grid-cols-1 gap-6">
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
	</div>
	</div>

		
</div>

<?= $this->endSection() ?>
