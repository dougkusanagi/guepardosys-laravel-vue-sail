<template>
	<div
		class="w-80 h-max hidden flex-col lg:flex rounded-lg space-y-1 sticky top-0"
	>
		<SidenavScrolltoLink v-for="link in links" :link="link" :key="link.route" />
	</div>
</template>

<script setup>
import SidenavScrolltoLink from "./SidenavScrolltoLink.vue";

const props = defineProps({ links: Array });
</script>
