<template>
	<a
		class="btn btn-primary gap-2 justify-start"
		:href="link.route"
	>
		<component :is="link.icon"></component>

		<span class="text-white font-normal text-xs">{{ link.name }}</span>
	</a>
</template>

<script setup>
const props = defineProps({
	link: Object,
});
</script>
