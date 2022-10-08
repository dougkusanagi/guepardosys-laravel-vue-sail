<template>
	<a
		type="submit"
		@click.prevent="goBack"
		class="btn btn-primary btn-outline btn-square"
	>
		<ChevronLeft />
	</a>
</template>

<script setup>
import ChevronLeft from "@/Icons/ChevronLeft.vue";
const goBack = () => window.history.back();
</script>
