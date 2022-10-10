<template>
	<div class="bg-white dark:bg-[#11183C] rounded-lg p-4 mb-8">
		<div class="mb-6">
			<h2 class="text-lg font-bold">
				<slot name="header"></slot>
			</h2>
		</div>

		<slot />
	</div>
</template>
