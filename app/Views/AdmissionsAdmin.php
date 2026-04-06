<?= $this->extend('layout/AdminLayout') ?>

<?= $this->section('content') ?>

<div class="p-8 bg-gray-50 min-h-screen">
	<!-- Header -->
	<div class="mb-8">
		<div>
			<p class="text-3xl font-bold text-[#6b3a9d] mt-2">Applicant Final Rankings</p>
			<p class="text-gray-600 mt-2">Review composite scores and make final scholarship determinations.</p>
        </div>
	</div>

    <!-- Selection Overview -->
	<div class="mb-8 grid grid-cols-2 gap-6">
		<!-- Pass Card -->
		<div class="bg-white rounded-xl p-6 border border-gray-200">
			<div class="flex items-start justify-between mb-4">
				<div>
					<p class="text-xs font-semibold text-gray-600 uppercase tracking-wide">PASS</p>
					<p class="text-3xl font-bold text-[#6b3a9d] mt-2">42</p>
				</div>
				<div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
					<i class="bi bi-check-circle text-green-600 text-xl"></i>
				</div>
			</div>
			<p class="text-sm text-gray-600">students</p>
		</div>

		<!-- Did not qualify Card -->
		<div class="bg-white rounded-xl p-6 border border-gray-200">
			<div class="flex items-start justify-between mb-4">
				<div>
					<p class="text-xs font-semibold text-gray-600 uppercase tracking-wide">Did not qualify</p>
					<p class="text-3xl font-bold text-[#6b3a9d] mt-2">4</p>
				</div>
				<div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
					<i class="bi bi-x-circle text-red-600 text-xl"></i>
				</div>
			</div>
			<p class="text-sm text-gray-600">students</p>
		</div>
	</div>

	<!-- Filters Section -->
	<div class="bg-white rounded-xl p-6 mb-8 border border-gray-200">
		<div class="flex items-center gap-4 flex-wrap">
			<!-- Scholarship Program Filter -->
			<div class="flex-1 min-w-[200px]">
				<label class="block text-xs font-semibold text-gray-600 uppercase mb-2">SCHOLARSHIP PROGRAM</label>
				<select class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#6b3a9d] focus:border-transparent">
					<option>All Active Programs</option>
					<option>Global STEM Excellence</option>
					<option>Visionary Arts Grant</option>
					<option>Civic Leaders Fellowship</option>
				</select>
			</div>

			<!-- Minimum Score Filter -->
			<div class="flex-1 min-w-[200px]">
				<label class="block text-xs font-semibold text-gray-600 uppercase mb-2">MINIMUM SCORE</label>
				<select class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#6b3a9d] focus:border-transparent">
					<option>All Scores</option>
					<option>8.0+</option>
					<option>7.5+</option>
					<option>7.0+</option>
				</select>
			</div>
		</div>
	</div>

	<!-- Table Section -->
	<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
		<div class="overflow-x-auto">
			<table class="w-full">
				<!-- Table Header -->
				<thead class="bg-gray-50 border-b border-gray-200">
					<tr>
						<th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">STUDENT NAME</th>
						<th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">UNIVERSITY</th>
						<th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">APPLIED SCHOLARSHIP</th>
						<th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">COMPOSITE SCORE</th>
						<th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">STATUS</th>
						<th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">ACTION</th>
					</tr>
				</thead>

				<!-- Table Body -->
				<tbody class="divide-y divide-gray-200">
					<!-- Row 1: Elena Rodriguez -->
					<tr class="hover:bg-gray-50 transition">
						<td class="px-6 py-4">
							<div class="flex items-center gap-3">
								<div class="w-10 h-10 bg-purple-200 rounded-full flex items-center justify-center font-semibold text-[#6b3a9d]">E</div>
								<div>
									<p class="font-semibold text-gray-900">Elena Rodriguez</p>
								</div>
							</div>
						</td>
						<td class="px-6 py-4 text-gray-700">Stanford University</td>
						<td class="px-6 py-4 text-gray-700">Global STEM Excellence</td>
						<td class="px-6 py-4">
							<div class="flex items-center gap-2">
								<span class="text-2xl font-bold text-[#6b3a9d]">9.8</span>
							</div>
						</td>
						<td class="px-6 py-4">
							<span class="px-3 py-1.5 bg-purple-100 text-[#6b3a9d] text-xs font-semibold rounded-full">PENDING DECISION</span>
						</td>
						<td class="px-6 py-4">
							<div class="flex items-center gap-2">
								<button class="px-3 py-1.5 bg-green-100 text-green-700 text-xs font-semibold rounded-lg hover:bg-green-200 transition">Approved</button>
								<button class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-gray-600 transition rounded">
									<i class="bi bi-arrow-right"></i>
								</button>
							</div>
						</td>
					</tr>

					<!-- Row 2: Marcus Thorne -->
					<tr class="hover:bg-gray-50 transition">
						<td class="px-6 py-4">
							<div class="flex items-center gap-3">
								<div class="w-10 h-10 bg-blue-200 rounded-full flex items-center justify-center font-semibold text-blue-900">M</div>
								<div>
									<p class="font-semibold text-gray-900">Marcus Thorne</p>
								</div>
							</div>
						</td>
						<td class="px-6 py-4 text-gray-700">MIT</td>
						<td class="px-6 py-4 text-gray-700">Global STEM Excellence</td>
						<td class="px-6 py-4">
							<div class="flex items-center gap-2">
								<span class="text-2xl font-bold text-[#6b3a9d]">9.4</span>
							</div>
						</td>
						<td class="px-6 py-4">
							<span class="px-3 py-1.5 bg-green-100 text-green-700 text-xs font-semibold rounded-full">APPROVED</span>
						</td>
						<td class="px-6 py-4">
							<div class="flex items-center gap-2">
								<button class="px-3 py-1.5 border border-gray-300 text-gray-700 text-xs font-semibold rounded-lg hover:bg-gray-50 transition">Edit St.</button>
								<button class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-gray-600 transition rounded">
									<i class="bi bi-arrow-right"></i>
								</button>
							</div>
						</td>
					</tr>

					<!-- Row 3: Sarah Jenkins -->
					<tr class="hover:bg-gray-50 transition">
						<td class="px-6 py-4">
							<div class="flex items-center gap-3">
								<div class="w-10 h-10 bg-pink-200 rounded-full flex items-center justify-center font-semibold text-pink-900">S</div>
								<div>
									<p class="font-semibold text-gray-900">Sarah Jenkins</p>
								</div>
							</div>
						</td>
						<td class="px-6 py-4 text-gray-700">Yale University</td>
						<td class="px-6 py-4 text-gray-700">Visionary Arts Grant</td>
						<td class="px-6 py-4">
							<div class="flex items-center gap-2">
								<span class="text-2xl font-bold text-[#6b3a9d]">8.9</span>
							</div>
						</td>
						<td class="px-6 py-4">
							<span class="px-3 py-1.5 bg-yellow-100 text-yellow-700 text-xs font-semibold rounded-full">WAITLISTED</span>
						</td>
						<td class="px-6 py-4">
							<div class="flex items-center gap-2">
								<button class="px-3 py-1.5 bg-green-100 text-green-700 text-xs font-semibold rounded-lg hover:bg-green-200 transition">Approved</button>
								<button class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-gray-600 transition rounded">
									<i class="bi bi-arrow-right"></i>
								</button>
							</div>
						</td>
					</tr>

					<!-- Row 4: David Chen -->
					<tr class="hover:bg-gray-50 transition">
						<td class="px-6 py-4">
							<div class="flex items-center gap-3">
								<div class="w-10 h-10 bg-red-200 rounded-full flex items-center justify-center font-semibold text-red-900">D</div>
								<div>
									<p class="font-semibold text-gray-900">David Chen</p>
								</div>
							</div>
						</td>
						<td class="px-6 py-4 text-gray-700">UC Berkeley</td>
						<td class="px-6 py-4 text-gray-700">Civic Leaders Fellowship</td>
						<td class="px-6 py-4">
							<div class="flex items-center gap-2">
								<span class="text-2xl font-bold text-[#6b3a9d]">8.5</span>
							</div>
						</td>
						<td class="px-6 py-4">
							<span class="px-3 py-1.5 bg-purple-100 text-[#6b3a9d] text-xs font-semibold rounded-full">PENDING DECISION</span>
						</td>
						<td class="px-6 py-4">
							<div class="flex items-center gap-2">
								<button class="px-3 py-1.5 bg-green-100 text-green-700 text-xs font-semibold rounded-lg hover:bg-green-200 transition">Approved</button>
								<button class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-gray-600 transition rounded">
									<i class="bi bi-arrow-right"></i>
								</button>
							</div>
						</td>
					</tr>

					<!-- Row 5: Aisha Khan -->
					<tr class="hover:bg-gray-50 transition">
						<td class="px-6 py-4">
							<div class="flex items-center gap-3">
								<div class="w-10 h-10 bg-orange-200 rounded-full flex items-center justify-center font-semibold text-orange-900">A</div>
								<div>
									<p class="font-semibold text-gray-900">Aisha Khan</p>
								</div>
							</div>
						</td>
						<td class="px-6 py-4 text-gray-700">Oxford University</td>
						<td class="px-6 py-4 text-gray-700">Global STEM Excellence</td>
						<td class="px-6 py-4">
							<div class="flex items-center gap-2">
								<span class="text-2xl font-bold text-[#6b3a9d]">7.2</span>
							</div>
						</td>
						<td class="px-6 py-4">
							<span class="px-3 py-1.5 bg-red-100 text-red-700 text-xs font-semibold rounded-full">REJECTED</span>
						</td>
						<td class="px-6 py-4">
							<div class="flex items-center gap-2">
								<button class="px-3 py-1.5 border border-gray-300 text-gray-700 text-xs font-semibold rounded-lg hover:bg-gray-50 transition">Edit St.</button>
								<button class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-gray-600 transition rounded">
									<i class="bi bi-arrow-right"></i>
								</button>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>

		<!-- Pagination -->
		<div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
			<p class="text-sm text-gray-600">Showing <span class="font-semibold">1-5</span> of <span class="font-semibold">1,204 applicants</span></p>
			<div class="flex items-center gap-2">
				<button class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-[#6b3a9d] transition rounded">
					<i class="bi bi-chevron-left"></i>
				</button>
				<button class="w-8 h-8 flex items-center justify-center bg-[#6b3a9d] text-white font-semibold rounded">1</button>
				<button class="w-8 h-8 flex items-center justify-center text-gray-700 hover:bg-gray-100 transition rounded">2</button>
				<button class="w-8 h-8 flex items-center justify-center text-gray-700 hover:bg-gray-100 transition rounded">3</button>
				<button class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-[#6b3a9d] transition rounded">
					<i class="bi bi-chevron-right"></i>
				</button>
			</div>
		</div>
	</div>

	
</div>

<?= $this->endSection() ?>