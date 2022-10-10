<template>
	<a
		class="btn btn-primary btn-outline gap-2 justify-start font-normal text-xs"
		:href="link.route"
	>
		<component :is="link.icon"></component>
		<span class="dark:text-white">{{ link.name }}</span>
		<ChevronRight class="ml-auto" />
	</a>
</template>

<script setup>
import ChevronRight from "@/Icons/ChevronRight.vue";
const props = defineProps({
	link: Object,
});
</script>
