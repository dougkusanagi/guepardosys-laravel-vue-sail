<template>
	<Link
		:href="link"
    class="w-[8rem] flex items-center"
		:class="
			active
				? 'bg-indigo-600 py-6 text-white rounded-l-xl'
				: 'py-4 rounded-l-md'
		"
	>
		<div
			:class="
				active
					? 'bg-cyan-300 p-2 -ml-5 absolute text-white rounded-lg rounded-br-none'
					: 'p-2 -ml-5 absolute rounded-md rounded-br-none text-indigo-500'
			"
		>
			<slot />
		</div>

		<span :class="active ? 'ml-7' : 'ml-5'">{{ label }}</span>
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
