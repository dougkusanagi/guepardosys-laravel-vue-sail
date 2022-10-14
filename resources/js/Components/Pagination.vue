<template>
	<div class="btn-group mb-4">
		<Component
			v-for="link in pages.links"
			:is="link.url ? 'Link' : 'span'"
			class="btn"
			:class="
				link.url && !link.active
					? 'btn-primary'
					: 'btn-disabled text-slate-500'
			"
			:href="link.url"
			v-html="link.label"
		>
		</Component>
	</div>
</template>

<script setup>
defineProps({
	pages: Object,
});
</script>
