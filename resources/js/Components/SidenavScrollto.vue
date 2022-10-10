<template>
	<div
		class="w-64 h-max hidden flex-col lg:flex rounded-lg space-y-1 sticky top-8"
	>
		<slot name="prepend" />
		<SidenavScrolltoLink v-for="link in links" :link="link" :key="link.route" />
		<slot name="append" />
	</div>
</template>

<script setup>
import SidenavScrolltoLink from "./SidenavScrolltoLink.vue";

const props = defineProps({ links: Array });
</script>
