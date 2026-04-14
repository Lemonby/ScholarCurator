<?= $this->extend('layout/AdminLayout') ?>

<?= $this->section('content') ?>

<div class="p-8 bg-gray-50 min-h-screen">
	<!-- Header -->
	<div class="mb-8">
		<p class="text-3xl font-bold text-[#6b3a9d] mt-2">Criteria & Weighting </p>
		<p class="text-gray-600 mt-4 max-w-2xl">This page is for you to change or adjust the weight of each criterion.</p>
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
			<?php if (!empty($criteriaList)): ?>
				<?php foreach ($criteriaList as $criteria): ?>
					<?php
						$criteriaType = strtolower($criteria['criteriaType'] ?? 'benefit');
						$iconClass = $criteriaType === 'benefit' ? 'bi-graph-up text-yellow-400' : 'bi-file-text text-red-500';
						$bgColorClass = $criteriaType === 'benefit' ? 'bg-[#fbbf24]/20' : 'bg-red-500/10';
						$badgeColor = $criteriaType === 'benefit' ? 'bg-yellow-400' : 'bg-red-500';
						$badgeText = ucfirst($criteriaType);
					?>
					<div class="bg-white rounded-xl p-5 border border-gray-200 hover:border-[#6b3a9d] transition">
						<div class="flex items-start gap-4">
							<div class="p-3 <?= $bgColorClass ?> rounded-lg flex-shrink-0">
								<i class="bi <?= $iconClass ?> text-xl"></i>
							</div>
							<div class="flex-1">
								<div class="flex items-center gap-2 mb-1">
									<h4 class="font-bold text-gray-900"><?= $criteria['criteriaName'] ?></h4>
									<span class="px-2 py-1 <?= $badgeColor ?> text-white text-xs font-semibold rounded"><?= $badgeText ?></span>
								</div>
								<p class="text-sm text-gray-600 mb-3">Evaluation criterion for scholarship selection</p>
								<div class="flex gap-3 items-center">
									<button class="p-2 text-gray-400 hover:text-red-500 transition" title="Delete">
										<i class="bi bi-trash"></i>
										
									</button>
									<p class="text-gray-300">|</p>
									<button class="edit-criteria-btn text-xs text-[#6b3a9d] font-semibold hover:text-[#5a2d7f] transition cursor-pointer flex items-center gap-1" data-criteria-id="<?= $criteria['idCriteria'] ?>" data-criteria-name="<?= $criteria['criteriaName'] ?>" data-criteria-value="<?= (int)($criteria['criteriaWeight'] * 100) ?>" data-criteria-type="<?= strtolower($criteria['criteriaType'] ?? 'benefit') ?>">
										<i class="bi bi-pencil text-sm"></i>
										<span>Edit</span>
									</button>
								</div>
							</div>
							<div class="flex items-center gap-2 flex-shrink-0">
								<input type="number" value="<?= (int)($criteria['criteriaWeight'] * 100) ?>" class="criteria-weight-input w-12 text-right font-bold text-lg border-0 focus:ring-0 p-0 bg-transparent" disabled>
								<span class="text-gray-600 font-semibold">%</span>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>

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
			<h2 class="text-2xl font-bold text-gray-900">Edit Criteria</h2>
			<p class="text-sm text-gray-600 mt-1">Update <span id="modalCriteriaName" class="font-semibold text-[#6b3a9d]"></span> details</p>
		</div>

		<!-- Modal Form -->
		<form id="editCriteriaForm" class="space-y-6">
			<input type="hidden" id="modalCriteriaId">
			
			<!-- Error Alert -->
			<div id="modalErrorAlert" class="hidden p-4 bg-red-50 rounded-lg border border-red-200">
				<div class="flex gap-2">
					<i class="bi bi-exclamation-circle text-red-600 flex-shrink-0 mt-0.5"></i>
					<p id="modalErrorText" class="text-xs text-red-800"></p>
				</div>
			</div>

			<!-- Success Alert -->
			<div id="modalSuccessAlert" class="hidden p-4 bg-green-50 rounded-lg border border-green-200">
				<div class="flex gap-2">
					<i class="bi bi-check-circle text-green-600 flex-shrink-0 mt-0.5"></i>
					<p id="modalSuccessText" class="text-xs text-green-800"></p>
				</div>
			</div>

			<!-- Criteria Type Selection -->
			<div>
				<label class="block text-xs uppercase tracking-wide font-bold text-gray-700 mb-3">Criteria Type</label>
				<div class="grid grid-cols-2 gap-3">
					<label class="relative flex items-center cursor-pointer">
						<input type="radio" id="typeBenefit" name="criteriaType" value="benefit" class="w-4 h-4 cursor-pointer accent-[#6b3a9d]">
						<span class="ml-2 text-sm font-medium text-gray-700">Benefit</span>
					</label>
					<label class="relative flex items-center cursor-pointer">
						<input type="radio" id="typeCost" name="criteriaType" value="cost" class="w-4 h-4 cursor-pointer accent-[#6b3a9d]">
						<span class="ml-2 text-sm font-medium text-gray-700">Cost</span>
					</label>
				</div>
				<p class="text-xs text-gray-500 mt-2">Benefit: Higher value is better | Cost: Lower value is better</p>
			</div>

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
				<button type="submit" id="submitModalBtn" class="flex-1 px-4 py-3 bg-[#6b3a9d] text-white font-semibold rounded-lg hover:bg-[#5a2d7f] transition" style="min-height: 48px;">
					<span id="submitBtnText">Save Changes</span>
					<i id="submitBtnSpinner" class="bi bi-hourglass-split ml-2 hidden animate-spin" style="display: inline-block;"></i>
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
	const modalCriteriaId = document.getElementById('modalCriteriaId');
	const submitBtn = document.getElementById('submitModalBtn');
	const submitBtnText = document.getElementById('submitBtnText');
	const submitBtnSpinner = document.getElementById('submitBtnSpinner');
	const errorAlert = document.getElementById('modalErrorAlert');
	const errorText = document.getElementById('modalErrorText');
	const successAlert = document.getElementById('modalSuccessAlert');
	const successText = document.getElementById('modalSuccessText');
	let currentEditBtn = null;

	// Open modal
	editBtns.forEach(btn => {
		btn.addEventListener('click', function(e) {
			e.preventDefault();
			currentEditBtn = this;
			const criteriaId = this.getAttribute('data-criteria-id');
			const criteriaName = this.getAttribute('data-criteria-name');
			const criteriaValue = this.getAttribute('data-criteria-value');
			const criteriaType = this.getAttribute('data-criteria-type');
			
			modalCriteriaId.value = criteriaId;
			modalCriteriaName.textContent = criteriaName;
			weightInput.value = criteriaValue;
			
			// Set criteria type radio button
			if (criteriaType === 'cost') {
				document.getElementById('typeCost').checked = true;
			} else {
				document.getElementById('typeBenefit').checked = true;
			}
			
			// Reset alerts
			errorAlert.classList.add('hidden');
			successAlert.classList.add('hidden');
			
			modal.classList.remove('hidden');
			weightInput.focus();
			weightInput.select();
		});
	});

	// Close modal
	cancelBtn.addEventListener('click', function() {
		modal.classList.add('hidden');
		form.reset();
		errorAlert.classList.add('hidden');
		successAlert.classList.add('hidden');
	});

	// Close modal on background click
	modal.addEventListener('click', function(e) {
		if (e.target === modal) {
			modal.classList.add('hidden');
			form.reset();
			errorAlert.classList.add('hidden');
			successAlert.classList.add('hidden');
		}
	});

	// Handle form submission
	form.addEventListener('submit', function(e) {
		e.preventDefault();
		
		const criteriaId = modalCriteriaId.value;
		const newValue = parseFloat(weightInput.value);
		const criteriaType = document.querySelector('input[name="criteriaType"]:checked').value;
		
		errorAlert.classList.add('hidden');
		successAlert.classList.add('hidden');

		// Frontend validation
		if (!criteriaId || criteriaId === '') {
			showError('Criteria ID is missing');
			return;
		}

		if (newValue === '' || isNaN(newValue) || newValue < 0 || newValue > 100) {
			showError('Please enter a valid number between 0 and 100');
			return;
		}

		if (!criteriaType) {
			showError('Please select a criteria type');
			return;
		}

		// Convert percentage to decimal (0.00 - 1.00)
		const weightDecimal = newValue / 100;

		// Show loading state
		submitBtn.disabled = true;
		submitBtnText.textContent = 'Saving...';
		submitBtnSpinner.style.display = 'inline-block';

		// Send AJAX request
		fetch('/admin/applications/update-criteria', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json',
				'X-Requested-With': 'XMLHttpRequest'
			},
			body: JSON.stringify({
				criteriaId: criteriaId,
				weight: weightDecimal,
				criteriaType: criteriaType
			})
		})
		.then(response => response.json())
		.then(data => {
			submitBtn.disabled = false;
			submitBtnText.textContent = 'Save Changes';
			submitBtnSpinner.style.display = 'none';

			if (data.success) {
				showSuccess(data.message || 'Criteria updated successfully!');
				
				// Update the criteria card display
				if (currentEditBtn) {
					const weightDisplay = currentEditBtn.closest('.flex').parentElement.querySelector('.criteria-weight-input');
					if (weightDisplay) {
						weightDisplay.value = newValue;
					}
					
					// Update the criteria type badge if changed
					const badgeElement = currentEditBtn.closest('.flex-1').querySelector('span[class*="bg-"]');
					if (badgeElement && badgeElement.classList.contains('px-2')) {
						const newBadgeColor = criteriaType === 'cost' ? 'bg-red-500' : 'bg-yellow-400';
						const oldBadgeColor = criteriaType === 'cost' ? 'bg-yellow-400' : 'bg-red-500';
						badgeElement.classList.remove(oldBadgeColor);
						badgeElement.classList.add(newBadgeColor);
						badgeElement.textContent = criteriaType.charAt(0).toUpperCase() + criteriaType.slice(1);
					}
				}

				// Close modal after 1.5 seconds
				setTimeout(() => {
					modal.classList.add('hidden');
					form.reset();
					errorAlert.classList.add('hidden');
					successAlert.classList.add('hidden');
				}, 1500);
			} else {
				showError(data.message || 'Failed to update criteria');
			}
		})
		.catch(error => {
			submitBtn.disabled = false;
			submitBtnText.textContent = 'Save Changes';
			submitBtnSpinner.style.display = 'none';
			console.error('Error:', error);
			showError('An error occurred while saving. Please try again.');
		});
	});

	// Helper functions
	function showError(message) {
		errorText.textContent = message;
		errorAlert.classList.remove('hidden');
	}

	function showSuccess(message) {
		successText.textContent = message;
		successAlert.classList.remove('hidden');
	}

	// Close modal on ESC key
	document.addEventListener('keydown', function(e) {
		if (e.key === 'Escape') {
			modal.classList.add('hidden');
			form.reset();
			errorAlert.classList.add('hidden');
			successAlert.classList.add('hidden');
		}
	});
});
</script>

<?= $this->endSection() ?>