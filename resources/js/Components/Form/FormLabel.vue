<template>
	<label
		class="block font-bold mb-2"
		:class="
			(classes,
			{
				'text-slate-500': !variant.length,
				'text-emerald-700': variant === 'success',
				'text-rose-700': variant === 'danger',
			})
		"
		:for="id"
	>
		<slot />
	</label>
</template>

<script setup>
defineProps({
	text: String,
	id: String,
	classes: { type: String, default: "" },
	variant: {
		type: String,
		default: "",
		validator(value) {
			// The value must match one of these strings
			return ["", "success", "danger"].includes(value);
		},
	},
});
</script>
