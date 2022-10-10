<template>
	<component
		class="btn font-normal text-xs gap-2 border-2"
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
		<slot name="before" class="-ml-2" />
		<span :class="{
			'dark:text-white': variant === 'primary',
			'text-white': (variant === 'primary' && !outline),
		}">
			<slot />
		</span>
		<slot name="after" />
	</component>
</template>

<script setup>
import { computed } from "vue";

const props = defineProps({
	tag: {
		type: String,
		default: 'Link'
	},
	href: {
		type: String,
		default: ''
	},
	type: {
		type: String,
		default: ''
	},
	variant: {
		type: String,
		default: 'primary'
	},
	outline: {
		type: Boolean,
		default: false
	},
});

const tag = computed(() => props.tag)
</script>
