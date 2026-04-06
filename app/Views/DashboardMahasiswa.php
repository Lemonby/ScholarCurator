<?= $this->extend('layout/MahasiswaLayout') ?>

<?= $this->section('content') ?>

<div class="p-8 bg-gray-50 min-h-screen">

	<!-- Main Content -->
	<div class="grid grid-cols-3 gap-8">
		<!-- Left Column -->
		<div class="col-span-2 space-y-6">
			<!-- Uploaded Documents -->
			<div class="bg-white rounded-2xl p-8 border border-gray-200">
				<div class="flex items-center gap-2 mb-6">
					<i class="bi bi-file-earmark-arrow-up text-[#6b3a9d] text-xl"></i>
					<h3 class="text-lg font-bold text-gray-900">Uploaded Documents</h3>
				</div>

				<div class="grid grid-cols-2 gap-4">
					<!-- Document 1 -->
					<div class="flex items-center gap-3 p-4 border border-gray-200 rounded-xl hover:border-[#6b3a9d] transition">
						<div class="p-3 bg-[#6b3a9d]/10 rounded-lg">
							<i class="bi bi-file-pdf text-[#6b3a9d] text-xl"></i>
						</div>
						<div class="flex-1 min-w-0">
							<p class="font-semibold text-gray-900 truncate">Personal_Statement.pdf</p>
							<p class="text-xs text-gray-500">2.4 MB • 4 pages</p>
						</div>
						<button class="p-2 text-gray-400 hover:text-[#6b3a9d] transition">
							<i class="bi bi-eye"></i>
						</button>
					</div>

					<!-- Document 2 -->
					<div class="flex items-center gap-3 p-4 border border-gray-200 rounded-xl hover:border-[#6b3a9d] transition">
						<div class="p-3 bg-[#6b3a9d]/10 rounded-lg">
							<i class="bi bi-file-pdf text-[#6b3a9d] text-xl"></i>
						</div>
						<div class="flex-1 min-w-0">
							<p class="font-semibold text-gray-900 truncate">Official_Transcript.pdf</p>
							<p class="text-xs text-gray-500">5.1 MB • 2 pages</p>
						</div>
						<button class="p-2 text-gray-400 hover:text-[#6b3a9d] transition">
							<i class="bi bi-eye"></i>
						</button>
					</div>

					<!-- Document 3 -->
					<div class="flex items-center gap-3 p-4 border border-gray-200 rounded-xl hover:border-[#6b3a9d] transition">
						<div class="p-3 bg-[#6b3a9d]/10 rounded-lg">
							<i class="bi bi-file-pdf text-[#6b3a9d] text-xl"></i>
						</div>
						<div class="flex-1 min-w-0">
							<p class="font-semibold text-gray-900 truncate">Letter_Rec_Smith.pdf</p>
							<p class="text-xs text-gray-500">1.1 MB • 1 page</p>
						</div>
						<button class="p-2 text-gray-400 hover:text-[#6b3a9d] transition">
							<i class="bi bi-eye"></i>
						</button>
					</div>

					<!-- Document 4 -->
					<div class="flex items-center gap-3 p-4 border border-gray-200 rounded-xl hover:border-[#6b3a9d] transition">
						<div class="p-3 bg-[#6b3a9d]/10 rounded-lg">
							<i class="bi bi-file-pdf text-[#6b3a9d] text-xl"></i>
						</div>
						<div class="flex-1 min-w-0">
							<p class="font-semibold text-gray-900 truncate">Resume_Tech_2024.pdf</p>
							<p class="text-xs text-gray-500">800 KB • 1 page</p>
						</div>
						<button class="p-2 text-gray-400 hover:text-[#6b3a9d] transition">
							<i class="bi bi-eye"></i>
						</button>
					</div>
				</div>
			</div>

            <!-- Review Criteria -->
			<div class="bg-white rounded-2xl p-8 border border-gray-200">
				<div class="flex items-center justify-between mb-6">
					<h3 class="text-lg font-bold text-gray-900">Review Criteria</h3>
					<span class="text-xs text-gray-500 font-semibold">4 Categories</span>
				</div>

				<div class="flex flex-row space-x-4">
					<!-- Criterion 1 -->
					<div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl border border-gray-100">
						<div>
							<p class="font-semibold text-gray-900">Academic Excellence</p>
							<p class="text-xs text-gray-500">GPA, Rigor of Coursework, Honors</p>
						</div>
						<span class="text-2xl font-bold text-[#6b3a9d]">9.5</span>
					</div>

					<!-- Criterion 2 -->
					<div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl border border-gray-100">
						<div>
							<p class="font-semibold text-gray-900">Leadership Potential</p>
							<p class="text-xs text-gray-500">Initiative, Influence, Teamwork</p>
						</div>
						<span class="text-2xl font-bold text-[#6b3a9d]">8.0</span>
					</div>

					<!-- Criterion 3 -->
					<div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl border border-gray-100">
						<div>
							<p class="font-semibold text-gray-900">Community Impact</p>
							<p class="text-xs text-gray-500">Volunteer work, Social Contribution</p>
						</div>
						<span class="text-2xl font-bold text-[#6b3a9d]">7.5</span>
					</div>

					<!-- Criterion 4 -->
					<div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl border border-gray-100">
						<div>
							<p class="font-semibold text-gray-900">Personal Vision</p>
							<p class="text-xs text-gray-500">Statement clarity, Long-term goals</p>
						</div>
						<span class="text-2xl font-bold text-[#6b3a9d]">8.5</span>
					</div>
				</div>
			</div>


		</div>

		<!-- Right Column -->
		<div class="space-y-6">
			<!-- Composite Score Card -->
			<div class="bg-gradient-to-br from-[#6b3a9d] to-[#4f2782] rounded-2xl p-8 text-white">
				<p class="text-sm font-semibold opacity-75 uppercase tracking-wide mb-4">selection results status</p>
				<div class="flex items-start justify-between mb-6">
					<div>
						<p class="text-5xl font-bold">graduate</p>
					</div>
					<button class="p-2 bg-white/20 rounded-lg hover:bg-white/30 transition">
						<i class="bi bi-plus text-xl"></i>
					</button>
				</div>
				<p class="text-sm opacity-90 leading-relaxed">Excellent candidate. Strong alignment with institutional values and leadership criteria.</p>
			</div>
			<!-- Internal Reviewer Notes -->
			<div class="bg-white rounded-2xl p-8 border border-gray-200">
				<h3 class="text-lg font-bold text-gray-900 mb-6">Internal Reviewer Notes</h3>
				<textarea placeholder="Add specific feedback for the committee..." class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#6b3a9d] focus:border-transparent resize-none" rows="5"></textarea>
			</div>
		</div>
	</div>
</div>
				
<?= $this->endSection() ?>
