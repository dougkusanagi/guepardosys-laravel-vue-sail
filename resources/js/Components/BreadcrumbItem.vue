<template>
	<li
  class="inline-flex items-center text-sm font-medium text-slate-500"
  >
		<svg
			v-if="isHome"
			class="w-4 h-4 mr-2"
			fill="currentColor"
			viewBox="0 0 20 20"
			xmlns="http://www.w3.org/2000/svg"
		>
			<path
				d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"
			></path>
		</svg>

		<svg
			v-else
			class="w-6 h-6"
			fill="currentColor"
			viewBox="0 0 20 20"
			xmlns="http://www.w3.org/2000/svg"
		>
			<path
				fill-rule="evenodd"
				d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
				clip-rule="evenodd"
			></path>
		</svg>

		<Link
			v-if="link"
			:href="link"
			class="text-slate-500 hover:text-gray-700"
		>
			<slot />
		</Link>

		<div v-else>
			<span class="text-gray-400">
				<slot />
			</span>
		</div>
	</li>
</template>

<script setup>
defineProps({
	link: {
		type: String,
		default: "",
	},

	isHome: Boolean,
});
</script>
