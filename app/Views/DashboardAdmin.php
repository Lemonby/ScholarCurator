<?= $this->extend('layout/AdminLayout') ?>

<?= $this->section('content') ?>

<?php	$userName = $userName ?? 'Admin';
	$userEmail = $userEmail ?? 'demo@scholarcurator.id';
?>

<div class="p-8 space-y-8">
	<!-- Quick Stats Row - Minimalist -->
	<div class="grid grid-cols-4 gap-4">
		<div class="bg-white/10 backdrop-blur-lg rounded-2xl p-6 border border-white/20 shadow-lg hover:shadow-xl transition">
			<div class="flex items-center justify-between mb-3">
				<p class="text-xs font-semibold text-[#6b3a9d] uppercase tracking-wide">Total Applications</p>
				<div class="w-10 h-10 bg-[#6b3a9d]/20 rounded-lg flex items-center justify-center">
					<i class="bi bi-file-text text-[#6b3a9d] text-lg"></i>
				</div>
			</div>
			<p class="text-4xl font-bold text-[#6b3a9d]"><?= $mahasiswaCount ?></p>
		</div>

		<div class="bg-green-500/10 backdrop-blur-lg rounded-2xl p-6 border border-green-400/30 shadow-lg hover:shadow-xl transition">
			<div class="flex items-center justify-between mb-3">
				<p class="text-xs font-semibold text-green-600 uppercase tracking-wide">Selected</p>
				<div class="w-10 h-10 bg-green-500/20 rounded-lg flex items-center justify-center">
					<i class="bi bi-check-circle text-green-500 text-lg"></i>
				</div>
			</div>
			<p class="text-4xl font-bold text-green-500"><?= $mahasiswaPassCount ?></p>
		</div>

		<div class="bg-red-500/10 backdrop-blur-lg rounded-2xl p-6 border border-red-400/30 shadow-lg hover:shadow-xl transition">
			<div class="flex items-center justify-between mb-3">
				<p class="text-xs font-semibold text-red-600 uppercase tracking-wide">Not Selected</p>
				<div class="w-10 h-10 bg-red-500/20 rounded-lg flex items-center justify-center">
					<i class="bi bi-x-circle text-red-500 text-lg"></i>
				</div>
			</div>
			<p class="text-4xl font-bold text-red-500"><?= $mahasiswaFailCount ?></p>
		</div>

		<div class="bg-blue-500/10 backdrop-blur-lg rounded-2xl p-6 border border-blue-400/30 shadow-lg hover:shadow-xl transition">
			<div class="flex items-center justify-between mb-3">
				<p class="text-xs font-semibold text-blue-600 uppercase tracking-wide">Selection Rate</p>
				<div class="w-10 h-10 bg-blue-500/20 rounded-lg flex items-center justify-center">
					<i class="bi bi-percent text-blue-500 text-lg"></i>
				</div>
			</div>
			<p class="text-4xl font-bold text-blue-500"><?php echo $mahasiswaCount > 0 ? round(($mahasiswaPassCount / $mahasiswaCount) * 100, 1) : 0; ?>%</p>
		</div>
	</div>

	<!-- Application Status & Active Criteria -->
	<div class="grid grid-cols-2 gap-6">
		<!-- Top Selections -->
		<div class="bg-white/10 backdrop-blur-lg rounded-2xl p-6 shadow-lg border border-white/20">
			<div class="flex items-center justify-between mb-6">
				<div>
					<h3 class="text-lg font-bold text-[#6b3a9d]">Top Selections</h3>
					<p class="text-xs text-[#6b3a9d]/60 mt-1">Leading candidates</p>
				</div>
				<a href="/admin/admissions" class="text-[#6b3a9d] font-semibold text-xs hover:text-[#4a2670] transition px-3 py-1.5 hover:bg-white/10 rounded-lg">View All</a>
			</div>
			<div class="space-y-3">
				<!-- Program 1 -->
				<?php 
					$count = 0;
					foreach ($mahasiswaPass as $mahasiswa): 
						if ($count >= 5) break;
						$count++;
				?>
					<div class="flex items-center justify-between p-4 border border-white/20 rounded-xl hover:bg-white/5 hover:border-[#6b3a9d]/50 transition backdrop-blur-sm">
						<div class="flex items-center gap-3">
							<div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#6b3a9d] to-[#4f2782] flex items-center justify-center text-white font-bold text-sm">
								<?= $count ?>
							</div>
							<div>
								<h4 class="font-semibold text-gray-900 text-sm"><?= $mahasiswa['name'] ?></h4>
								<p class="text-xs text-gray-500"><?= $mahasiswa['NIM'] ?></p>
							</div>
						</div>
						<div class="text-right">
							<p class="font-bold text-green-500 text-sm"><?= $mahasiswa['finalScore'] ?></p>
							<span class="text-xs bg-green-500/20 text-green-500 px-2 py-0.5 rounded-full font-semibold border border-green-400/50">SELECTED</span>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>

		<!-- Quick Performance Insights -->
		<div class="bg-gradient-to-br from-[#6b3a9d] to-[#4f2782] rounded-2xl p-6 text-white shadow-lg border border-purple-400/20">
			<div>
				<h3 class="text-lg font-bold mb-1">Selection Insights</h3>
				<p class="text-xs text-white/60 mb-6">Key performance metrics</p>
			</div>
			
			<!-- Stats Grid -->
			<div class="space-y-3">
				<!-- Top Score -->
				<div class="bg-white/10 backdrop-blur-lg rounded-xl p-4 border border-white/20 hover:bg-white/15 transition">
					<p class="text-xs text-white/60 mb-2">Highest Score</p>
					<p class="text-3xl font-bold text-white">
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
				<div class="bg-white/10 backdrop-blur-lg rounded-xl p-4 border border-white/20 hover:bg-white/15 transition">
					<p class="text-xs text-white/60 mb-2">Cutoff Score</p>
					<p class="text-3xl font-bold text-white">
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
				<div class="bg-gradient-to-r from-green-500/20 to-blue-500/20 backdrop-blur-lg rounded-xl p-4 border border-white/20 hover:from-green-500/30 hover:to-blue-500/30 transition">
					<p class="text-xs text-white/60 mb-3">Selection Summary</p>
					<div class="flex items-center justify-between">
						<div>
							<p class="text-xs text-white/60">Selected</p>
							<p class="text-2xl font-bold text-green-300"><?= $mahasiswaPassCount ?></p>
						</div>
						<div class="w-px h-12 bg-white/10"></div>
						<div>
							<p class="text-xs text-white/60">Total</p>
							<p class="text-2xl font-bold text-blue-300"><?= $mahasiswaCount ?></p>
						</div>
					</div>
				</div>
			</div>

			<!-- Action Button -->
			<div class="mt-6">
				<a href="/admin/admissions" class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-white text-[#6b3a9d] font-semibold rounded-lg hover:bg-gray-100 transition">
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
						? 'bg-yellow-400/20 text-yellow-600 border border-yellow-400/50' 
						: 'bg-red-500/20 text-red-600 border border-red-400/50';
					$iconBgClass = $type === 'benefit' 
						? 'bg-yellow-400/30' 
						: 'bg-red-500/30';
					$iconClass = $type === 'benefit' ? 'text-yellow-600' : 'text-red-600';
					$cardHoverClass = $type === 'benefit' ? 'hover:border-yellow-400/70' : 'hover:border-red-400/70';
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
