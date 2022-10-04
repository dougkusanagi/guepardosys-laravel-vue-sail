<template>
	<a
		href="#"
		class="flex text-xs leading-7 pb-4 mr-6"
		:class="
			status
				? 'border-b-4 border-indigo-600'
				: 'border-b-4 border-transparent text-[#969bba]'
		"
	>
		<span
			class="font-bold"
			:class="status ? 'text-indigo-600' : 'text-[#969bba]'"
		>
			{{ name }}
		</span>

		<span
			class="text-white px-2 ml-2 rounded-full"
			:class="status ? 'bg-indigo-600' : 'bg-[#969bba] text-white'"
		>
			{{ count }}
		</span>
	</a>
</template>

<script setup>
defineProps({
  name: {
    type: String,
    required: true,
  },
	status: {
		type: Boolean,
		default: false,
	},
	count: {
		type: Number,
		default: 0,
	},
});
</script>
