<?= $this->extend('layout/AdminLayout') ?>

<?= $this->section('content') ?>

<div class="p-8 bg-gray-50 min-h-screen">
	<!-- Header -->
	<div class="mb-8">
		<p class="text-3xl font-bold text-[#6b3a9d] mt-2">Criteria & Weighting </p>
		<p class="text-gray-600 mt-4 max-w-2xl">Define how applications are evaluated by assigning relative importance to each qualifying factor.</p>
	</div>

	<div class="grid grid-cols-4 gap-8">
		<!-- Left Sidebar -->
		<div>
			<!-- Total Allocation Card -->
			<div class="bg-gradient-to-br from-[#f3e8ff] to-[#e9d5ff] rounded-2xl p-6 mb-6">
				<h3 class="text-sm font-semibold text-gray-900 mb-6">Total Allocation</h3>
				
				<!-- Circle Progress -->
				<div class="flex justify-center mb-8">
					<div class="relative w-32 h-32">
						<?php
							$benefitPercent = (int)($criteriaBenefits * 100);
							$costPercent = (int)($criteriaCosts * 100);
							$totalPercent = $benefitPercent + $costPercent;
							$circumference = 339.3;
							
							// Calculate offsets untuk donut chart
							$benefitLength = ($benefitPercent / 100) * $circumference;
							$costLength = ($costPercent / 100) * $circumference;
							$benefitOffset = $circumference - $benefitLength;
							$costOffset = $circumference - $benefitLength - $costLength;
						?>
						<svg class="w-full h-full transform -rotate-90" viewBox="0 0 120 120">
							<!-- Background circle -->
							<circle cx="60" cy="60" r="54" fill="none" stroke="#e9d5ff" stroke-width="8"/>
							<!-- Benefit Progress circle -->
							<circle cx="60" cy="60" r="54" fill="none" stroke="#6b3a9d" stroke-width="8" 
								stroke-dasharray="<?= $benefitLength ?> <?= $circumference - $benefitLength ?>" 
								stroke-dashoffset="0" stroke-linecap="round"/>
							<!-- Cost Progress circle -->
							<circle cx="60" cy="60" r="54" fill="none" stroke="#a78bfa" stroke-width="8" 
								stroke-dasharray="<?= $costLength ?> <?= $circumference - $costLength ?>" 
								stroke-dashoffset="-<?= $benefitLength ?>" stroke-linecap="round"/>
						</svg>
						<div class="absolute inset-0 flex flex-col items-center justify-center">
							<p class="text-3xl font-bold text-[#6b3a9d]"><?= $totalPercent ?>%</p>
							<p class="text-xs font-semibold text-gray-600 uppercase">Total</p>
						</div>
					</div>
				</div>

				<!-- Weight List -->
				<div class="space-y-4">
					<div>
						<p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Benefit Weight</p>
						<p class="text-2xl font-bold text-[#6b3a9d]"><?= $benefitPercent ?>%</p>
						<div class="mt-2 h-2 bg-gray-200 rounded-full overflow-hidden">
							<div class="h-full bg-[#6b3a9d]" style="width: <?= $benefitPercent ?>% !important;"></div>
						</div>
					</div>
					<div>
						<p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Cost Weight</p>
						<p class="text-2xl font-bold text-[#6b3a9d]"><?= $costPercent ?>%</p>
						<div class="mt-2 h-2 bg-gray-200 rounded-full overflow-hidden">
							<div class="h-full bg-[#a78bfa]" style="width: <?= $costPercent ?>% !important;"></div>
						</div>
					</div>
				</div>

				<!-- Info Box -->
				<div class="mt-6 p-4 bg-white/50 rounded-lg border border-[#6b3a9d]/20">
					<div class="flex gap-2">
						<i class="bi bi-info-circle flex-shrink-0 text-[#6b3a9d] mt-0.5"></i>
						<p class="text-xs text-gray-700 leading-relaxed">
							<?php 
								if ($benefitPercent + $costPercent == 100) {
									echo "✅ Perfectly balanced weights! Ready for evaluation.";
								} else {
									echo "⚠️ Total allocation is " . ($benefitPercent + $costPercent) . "%. Aim for 100% for optimal configuration.";
								}
							?>
						</p>
					</div>
				</div>
			</div>

			<!-- Preview & Configuration Buttons -->
			<div class="space-y-3">
				<button class="w-full flex items-center justify-center gap-2 px-4 py-2.5 border-2 border-[#6b3a9d] text-[#6b3a9d] font-semibold rounded-lg hover:bg-[#6b3a9d]/5 transition">
					<i class="bi bi-eye"></i>
					Preview Scoring
				</button>
				<button class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-[#6b3a9d] text-white font-semibold rounded-lg hover:bg-[#5a2d7f] transition">
					<i class="bi bi-check2"></i>
					Save Configuration
				</button>
			</div>
		</div>

		<!-- Main Content Area -->
		<div class="col-span-3 space-y-4">
			<!-- Criteria Items -->
			<!-- Cumulative GPA -->
			<div class="bg-white rounded-xl p-5 border border-gray-200 hover:border-[#6b3a9d] transition">
				<div class="flex items-start gap-4">
					<div class="p-3 bg-[#fbbf24]/20 rounded-lg flex-shrink-0">
						<i class="bi bi-graph-up text-yellow-400 text-xl"></i>
					</div>
					<div class="flex-1">
						<div class="flex items-center gap-2 mb-1">
							<h4 class="font-bold text-gray-900">Cumulative GPA</h4>
							<span class="px-2 py-1 bg-yellow-400 text-white text-xs font-semibold rounded">Benefit</span>
						</div>
						<p class="text-sm text-gray-600 mb-3">Selecting student with the highest GPA.</p>
						<div class="flex gap-3 items-center">
							<button class="p-2 text-gray-400 hover:text-red-500 transition" title="Delete">
								<i class="bi bi-trash"></i>
							</button>
							<p class="text-gray-300">|</p>
							<button class="edit-criteria-btn text-xs text-[#6b3a9d] font-semibold hover:text-[#5a2d7f] transition cursor-pointer flex items-center gap-1" data-criteria-name="Cumulative GPA" data-criteria-value="40">
								<i class="bi bi-pencil text-sm"></i>
								<span>Edit</span>
							</button>
						</div>
					</div>
					<div class="flex items-center gap-2 flex-shrink-0">
						<input type="number" value="40" class="criteria-weight-input w-12 text-right font-bold text-lg border-0 focus:ring-0 p-0 bg-transparent">
						<span class="text-gray-600 font-semibold">%</span>
					</div>
				</div>
			</div>

			<!-- Parent Income -->
			<div class="bg-white rounded-xl p-5 border border-gray-200 hover:border-[#6b3a9d] transition duration-200">
				<div class="flex items-start gap-4">
					<div class="p-3 bg-red-500/10 rounded-lg flex-shrink-0">
						<i class="bi bi-file-text text-red-500 text-xl"></i>
					</div>
					<div class="flex-1">
						<div class="flex items-center gap-2 mb-1">
							<h4 class="font-bold text-gray-900">Parent Income</h4>
							<span class="px-2 py-1 bg-red-500 text-white text-xs font-semibold rounded">Cost</span>
						</div>
						<p class="text-sm text-gray-600 mb-3">Admitting students whose parents have low average incomes.</p>
						<div class="flex gap-3 items-center">
							<button class="p-2 text-gray-400 hover:text-red-500 transition" title="Delete">
								<i class="bi bi-trash"></i>
							</button>
							<p class="text-gray-300">|</p>
							<button class="edit-criteria-btn text-xs text-[#6b3a9d] font-semibold hover:text-[#5a2d7f] transition cursor-pointer flex items-center gap-1" data-criteria-name="Parent Income" data-criteria-value="25">
								<i class="bi bi-pencil text-sm"></i>
								<span>Edit</span>
							</button>
						</div>
					</div>
					<div class="flex items-center gap-2 flex-shrink-0">
						<input type="number" value="25" class="criteria-weight-input w-12 text-right font-bold text-lg border-0 focus:ring-0 p-0 bg-transparent">
						<span class="text-gray-600 font-semibold">%</span>
					</div>
				</div>
			</div>

			<!-- Number of Dependent -->
			<div class="bg-white rounded-xl p-5 border border-gray-200 hover:border-[#6b3a9d] transition">
				<div class="flex items-start gap-4">
					<div class="p-3 bg-[#fbbf24]/20 rounded-lg flex-shrink-0">
						<i class="bi bi-people text-[#f59e0b] text-xl"></i>
					</div>
					<div class="flex-1">
						<div class="flex items-center gap-2 mb-1">
							<h4 class="font-bold text-gray-900">Number of Dependent</h4>
							<span class="px-2 py-1 bg-yellow-400 text-white text-xs font-semibold rounded">Benefit</span>
						</div>
						<p class="text-sm text-gray-600 mb-3">Volunteer hours and leadership roles in student organizations.</p>
						<div class="flex gap-3 items-center">
							<button class="p-2 text-gray-400 hover:text-red-500 transition" title="Delete">
								<i class="bi bi-trash"></i>
							</button>
							<p class="text-gray-300">|</p>
							<button class="edit-criteria-btn text-xs text-[#6b3a9d] font-semibold hover:text-[#5a2d7f] transition cursor-pointer flex items-center gap-1" data-criteria-name="Number of Dependent" data-criteria-value="15">
								<i class="bi bi-pencil text-sm"></i>
								<span>Edit</span>
							</button>
						</div>
					</div>
					<div class="flex items-center gap-2 flex-shrink-0">
						<input type="number" value="15" class="criteria-weight-input w-12 text-right font-bold text-lg border-0 focus:ring-0 p-0 bg-transparent">
						<span class="text-gray-600 font-semibold">%</span>
					</div>
				</div>
			</div>

			<!-- Non-Academic Achievement -->
			<div class="bg-white rounded-xl p-5 border border-gray-200 hover:border-[#6b3a9d] transition">
				<div class="flex items-start gap-4">
					<div class="p-3 bg-[#fbbf24]/20 rounded-lg flex-shrink-0">
						<i class="bi bi-cash-coin text-[#f59e0b] text-xl"></i>
					</div>
					<div class="flex-1">
						<div class="flex items-center gap-2 mb-1">
							<h4 class="font-bold text-gray-900">Non-Academic Achievement</h4>
							<span class="px-2 py-1 bg-yellow-400 text-white text-xs font-semibold rounded">Benefit</span>
						</div>
						<p class="text-sm text-gray-600 mb-3">Based on FAFSA or approved financial aid applications.</p>
						<div class="flex gap-3 items-center">
							<button class="p-2 text-gray-400 hover:text-red-500 transition" title="Delete">
								<i class="bi bi-trash"></i>
							</button>
							<p class="text-gray-300">|</p>
							<button class="edit-criteria-btn text-xs text-[#6b3a9d] font-semibold hover:text-[#5a2d7f] transition cursor-pointer flex items-center gap-1" data-criteria-name="Non-Academic Achievement" data-criteria-value="20">
								<i class="bi bi-pencil text-sm"></i>
								<span>Edit</span>
							</button>
						</div>
					</div>
					<div class="flex items-center gap-2 flex-shrink-0">
						<input type="number" value="20" class="criteria-weight-input w-12 text-right font-bold text-lg border-0 focus:ring-0 p-0 bg-transparent">
						<span class="text-gray-600 font-semibold">%</span>
					</div>
				</div>
			</div>

			<!-- Add Scoring Dimension -->
			<div class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-[#6b3a9d] transition cursor-pointer">
				<button class="flex items-center justify-center gap-2 mx-auto text-gray-600 hover:text-[#6b3a9d] transition font-semibold">
					<i class="bi bi-plus-circle text-xl"></i>
					Add Scoring Dimension
				</button>
				<p class="text-xs text-gray-500 mt-2">ESSAY, LETTER OF REC, ETC</p>
			</div>

			<!-- Bottom Actions -->
			<!-- <div class="flex items-center justify-between pt-4 mt-6 border-t border-gray-200">
				<div class="flex items-center gap-4">
					<div class="flex items-center gap-2">
						<i class="bi bi-check-circle text-green-500"></i>
						<span class="text-sm font-semibold text-gray-700">All criteria configured</span>
					</div>
					<span class="text-sm text-gray-600">Total Weight: <span class="font-bold">100%</span></span>
				</div>
				<div class="flex gap-3">
					<button class="px-6 py-2.5 text-gray-700 font-semibold border border-gray-300 rounded-lg hover:bg-gray-50 transition">
						Discard Changes
					</button>
					<button class="px-6 py-2.5 bg-[#6b3a9d] text-white font-semibold rounded-lg hover:bg-[#5a2d7f] transition">
						Finalize & Publish
					</button>
				</div>
			</div> -->
		</div>
	</div>
</div>

<!-- Edit Criteria Modal -->
<div id="editCriteriaModal" class="hidden fixed inset-0 flex items-center justify-center z-50 bg-black/20 backdrop-blur-sm">

	<div class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-md">
		<!-- Modal Header -->
		<div class="mb-6">
			<h2 class="text-2xl font-bold text-gray-900">Edit Weight</h2>
			<p class="text-sm text-gray-600 mt-1">Adjust the weighting percentage for <span id="modalCriteriaName" class="font-semibold text-[#6b3a9d]"></span></p>
		</div>

		<!-- Modal Form -->
		<form id="editCriteriaForm" class="space-y-6">
			<div>
				<label class="block text-xs uppercase tracking-wide font-bold text-gray-700 mb-3">Weight Percentage</label>
				<div class="flex items-center gap-3">
					<input type="number" id="modalWeightInput" min="0" max="100" class="flex-1 px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-[#6b3a9d] focus:ring-2 focus:ring-[#6b3a9d]/20 outline-none transition text-lg font-bold" placeholder="0">
					<span class="text-lg font-bold text-gray-600">%</span>
				</div>
				<p class="text-xs text-gray-500 mt-2">Enter a value between 0 and 100</p>
			</div>

			<!-- Info Box -->
			<div class="p-4 bg-blue-50 rounded-lg border border-blue-200">
				<div class="flex gap-2">
					<i class="bi bi-info-circle text-blue-600 flex-shrink-0 mt-0.5"></i>
					<p class="text-xs text-blue-800">Total weights across all criteria should equal 100% for balanced evaluation.</p>
				</div>
			</div>

			<!-- Modal Actions -->
			<div class="flex gap-3 pt-4">
				<button type="button" id="cancelModalBtn" class="flex-1 px-4 py-3 text-gray-700 font-semibold border border-gray-300 rounded-lg hover:bg-gray-50 transition">
					Cancel
				</button>
				<button type="submit" class="flex-1 px-4 py-3 bg-[#6b3a9d] text-white font-semibold rounded-lg hover:bg-[#5a2d7f] transition">
					Save Changes
				</button>
			</div>
		</form>
	</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
	const modal = document.getElementById('editCriteriaModal');
	const editBtns = document.querySelectorAll('.edit-criteria-btn');
	const cancelBtn = document.getElementById('cancelModalBtn');
	const form = document.getElementById('editCriteriaForm');
	const weightInput = document.getElementById('modalWeightInput');
	const modalCriteriaName = document.getElementById('modalCriteriaName');
	let currentEditBtn = null;

	// Open modal
	editBtns.forEach(btn => {
		btn.addEventListener('click', function(e) {
			e.preventDefault();
			currentEditBtn = this;
			const criteriaName = this.getAttribute('data-criteria-name');
			const criteriaValue = this.getAttribute('data-criteria-value');
			
			modalCriteriaName.textContent = criteriaName;
			weightInput.value = criteriaValue;
			
			modal.classList.remove('hidden');
			weightInput.focus();
			weightInput.select();
		});
	});

	// Close modal
	cancelBtn.addEventListener('click', function() {
		modal.classList.add('hidden');
	});

	// Close modal on background click
	modal.addEventListener('click', function(e) {
		if (e.target === modal) {
			modal.classList.add('hidden');
		}
	});

	// Handle form submission
	form.addEventListener('submit', function(e) {
		e.preventDefault();
		
		const newValue = weightInput.value;
		
		if (newValue === '' || newValue < 0 || newValue > 100) {
			alert('Please enter a valid number between 0 and 100');
			return;
		}

		// Update the input value in the criteria card
		if (currentEditBtn) {
			const weightInputField = currentEditBtn.closest('.flex').parentElement.querySelector('.criteria-weight-input');
			if (weightInputField) {
				weightInputField.value = newValue;
			}
		}

		modal.classList.add('hidden');
	});

	// Close modal on ESC key
	document.addEventListener('keydown', function(e) {
		if (e.key === 'Escape') {
			modal.classList.add('hidden');
		}
	});
});
</script>

<?= $this->endSection() ?>