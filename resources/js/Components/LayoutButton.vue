<template>
	<component
		class="btn text-xs gap-2 border-2 rounded-br-none"
		:class="{
			'btn-primary': variant === 'primary',
			'btn-secondary': variant === 'secondary',
			'btn-accent': variant === 'accent',
			'btn-neutral': variant === 'neutral',
			'btn-success': variant === 'success',
			'btn-warning': variant === 'warning',
			'btn-error': variant === 'error',
			'btn-outline': outline,
		}"
		:is="tag"
		:type="type"
		:href="href"
	>
		<div class="ml-[-0.2rem]">
			<slot name="before" />
		</div>

		<span
			:class="{
				'dark:text-white': variant === 'primary',
				'text-white': variant === 'primary' && !outline,
			}"
		>
			<slot />
		</span>

		<slot name="after" />
	</component>
</template>

<script setup>
import { computed } from "vue";

const props = defineProps({
	href: {
		type: String,
		default: "",
	},
	variant: {
		type: String,
		default: "primary",
	},
	outline: {
		type: Boolean,
		default: false,
	},
	submit: {
		type: Boolean,
		default: false
	}
});

const tag	= computed(() => props.submit ? "button" : "Link");
const type = computed(() => props.submit ? "submit" : "");
</script>
