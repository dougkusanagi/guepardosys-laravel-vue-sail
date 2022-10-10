<template>
	<Link
		:href="link"
		:title="label"
    class="w-12 md:w-[8rem] flex justify-center md:justify-start items-center"
		:class="
			active
				? 'md:bg-indigo-600 py-6 text-white rounded-l-xl'
				: 'py-4 rounded-l-md'
		"
	>
		<div
			class="absolute md:-ml-5 rounded-br-none"
			:class="
				active
					? 'bg-cyan-300 p-2 text-white rounded-lg'
					: 'p-2 rounded-md text-indigo-500'
			"
		>
			<slot />
		</div>

		<span class="hidden md:block" :class="active ? 'ml-7' : 'ml-5'">{{ label }}</span>
	</Link>
</template>

<script setup>
defineProps({
	label: String,
	link: {
		type: String,
		default: "#",
	},
	active: {
		type: Boolean,
		default: false,
	},
});
</script>
